<?php
namespace frontend\controllers;

use common\models\goods\Book;
use common\models\goods\Brand;
use common\models\Member;
use common\models\MemberBrowseRecord;
use common\models\MemberLoginForm;
use common\models\order\OrderDetail;
use Yii;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\data\Sort;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'register'],
                'rules' => [
                    [
                        'actions' => ['register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $newBooks = Book::getEnableBookQuery()
            ->orderBy(['create_time' => SORT_DESC])
            ->limit(10)
            ->all();

        $bookOrders = OrderDetail::find()
            ->select(['isbn', 'SUM(number) AS count'])
            ->groupBy('isbn')
            ->orderBy(['count' => SORT_DESC])
            ->asArray()
            ->indexBy('isbn')
            ->limit(10)
            ->all();
        $bestSellingBooks = Book::getEnableBookQuery()
            ->andWhere(['isbn' => array_keys($bookOrders)])
            ->all();

        $bookBrowses = MemberBrowseRecord::find()
            ->select(['isbn', 'SUM(views) AS count'])
            ->groupBy('isbn')
            ->orderBy(['count' => SORT_DESC])
            ->asArray()
            ->indexBy('isbn')
            ->limit(10)
            ->all();
        $hotBooks = Book::getEnableBookQuery()
            ->andWhere(['isbn' => array_keys($bookBrowses)])
            ->all();

        $recommendBooks = Book::getEnableBookQuery()
            ->andWhere(['recommend' => Book::ENABLE_STATUS])
            ->all();

        return $this->render('index', [
            'newBooks' => $newBooks,
            'bestSellingBooks' => $bestSellingBooks,
            'hotBooks' => $hotBooks,
            'recommendBooks' => $recommendBooks,
            'brands' => Brand::find()
                ->where(['available' => Brand::AVAILABLE])
                ->orderBy(['sort' => SORT_DESC])
                ->asArray()
                ->all(),
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new MemberLoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->redirect('index');
            }

            Yii::$app->session->setFlash('danger', '帐号或密码错误');
            return $this->render('login', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->removeFlash('danger');
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionRegister()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $code = Yii::$app->request->getBodyParam('verifyCode');
            if (!$this->createAction('captcha')->validate($code, false)) {
                Yii::$app->session->setFlash('danger', '验证码输入错误');
                return $this->goBack(Yii::$app->getRequest()->getReferrer());
            } else if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->render('registerResult');
                } else {
                    Yii::$app->session->setFlash('success', '您已完成注册，请登录');
                    return $this->render('login', [
                        'model' => $model,
                    ]);
                }
            } else {
                Yii::$app->session->setFlash('danger', '网络出现延迟，请稍后重试');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRegisterResult()
    {
        return $this->render('registerResult');
    }

    /**
     * 重置密码 - 填写账户信息
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $code = Yii::$app->request->getBodyParam('verifyCode');
            if (!$this->createAction('captcha')->validate($code, false)) {
                Yii::$app->session->setFlash('danger', '验证码输入错误');
                return $this->goBack(Yii::$app->getRequest()->getReferrer());
            }
            if ($testToken = $model->sendEmail()) {
                return $this->redirect(['message-password-reset',
                    'testToken' => $testToken,
                ]);
            } else {
                Yii::$app->session->setFlash('danger', '网络出现延迟，请稍后重试');
            }
        }

        Yii::$app->layout = 'resetPassword';
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionMessagePasswordReset()
    {
        Yii::$app->layout = 'resetPassword';

        return $this->render('messagePasswordReset', [
            'testToken' => Yii::$app->getRequest()->getQueryParam('testToken'),
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        Yii::$app->layout = 'resetPassword';

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            return $this->render('resetPasswordTokenError');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->resetPassword()) {
                return $this->redirect('reset-password-success');
            } else {
                return $this->redirect('reset-password-failure');
            }
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionResetPasswordSuccess()
    {
        Yii::$app->layout = 'resetPassword';
        return $this->render('resetPasswordSuccess');
    }

    public function actionResetPasswordFailure()
    {
        Yii::$app->layout = 'resetPassword';
        return $this->render('resetPasswordFailure');
    }

    public function actionTestCart()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [];
    }

    public function actionValidateUsername($username)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => !(boolean)Member::findByUsername($username),
        ];
    }

    public function actionValidateEmail($email)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => !(boolean)Member::findOne(['email' => $email]),
        ];
    }

    public function actionValidateCode($code)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => (boolean)$this->createAction('captcha')->validate($code, false),
        ];
    }
}
