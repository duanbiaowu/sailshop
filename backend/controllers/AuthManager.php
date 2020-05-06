<?php
/**
 * Created by PhpStorm.
 * User: duanbiaowu
 * Date: 16/12/10
 * Time: 下午4:03
 */

namespace backend\controllers;

use backend\models\system\AuthMenu;
use backend\models\system\AuthRole;
use backend\models\system\MenuPermission;
use backend\models\system\RoleMenuPermission;
use backend\models\system\User;
use backend\models\system\UserOperateLog;
use Yii;
use yii\base\Component;
use yii\console\controllers\HelpController;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\web\BadRequestHttpException;

class AuthManager extends Component
{
    /**
     * 公共权限配置
     * 登录和退出无需验证权限
     * @return array
     */
    public function ignores()
    {
        return [
            'route' => [
                '/site/login',
                '/site/logout',
            ]
        ];
    }

    /**
     * 系统初始化工作
     * 1. 根据登录用户角色信息验证操作权限
     * 2. 根据登录用户角色信息初始化菜单
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function init()
    {
        // 公共权限功能无需验证，直接操作
        if (in_array(Yii::$app->request->url, $this->ignores()['route'])) {
            return parent::init();
        }

        // 未登录用户跳转到登录页面
        if (Yii::$app->user->isGuest) {
            return Yii::$app->response->redirect('/site/login');
        }

        // 超级管理员不验证权限，获取所有菜单
        if (Yii::$app->user->id == User::ROOT_ID) {
            // 默认跳转到系统首页
            if (Yii::$app->request->url == Yii::$app->homeUrl) {
                Yii::$app->request->url = '/system/index';
            }
            $menus = AuthMenu::getAllMenus();
        } else {
            // 获取当前用户所角色信息
            $roles = Yii::$app->user->identity
                ->getRoles()
                ->indexBy('role_id')
                ->all();

            // 检测用户是否具有对应操作权限
            $permission = AuthMenu::findPermissionByRoute(Yii::$app->request->url);
            if ($permission) {
                $hasPermission = (boolean)$permission->getRoleMenuPermissions()
                    ->andWhere(['in', 'role_id', array_keys($roles)])
                    ->one();

                // 记录用户当前操作到日志
                $log = new UserOperateLog();
                $log->user_id = Yii::$app->user->id;
                $log->username = Yii::$app->user->identity->nickname;
                $log->menu_name = $permission->getMenu()->one()->name;
                $log->permission = $permission->name;
                $log->query = parse_url(Yii::$app->request->url, PHP_URL_QUERY);
                $log->save();
            } else {
                $hasPermission = true;
            }

            // 如果用户不具有权限，跳转到异常提示页面
            if (!$hasPermission) {
                throw new BadRequestHttpException('您不具有当前功能操作权限');
            }

            // 获取用户角色权限
            $permissions = RoleMenuPermission::find()
                ->andWhere(['in', 'role_id', array_keys($roles)])
                ->indexBy('permission_id')
                ->asArray()
                ->all();

            // 获取用户角色权限关联菜单
            $roleMenus = MenuPermission::find()
                ->andWhere(['in', 'id', array_keys($permissions)])
                ->indexBy('menu_id')
                ->asArray()
                ->all();

            $systemMenus = AuthMenu::getAllMenus();

            // 默认跳转到用户首个菜单
            if (Yii::$app->request->url == Yii::$app->homeUrl) {
                $firstMenu = array_shift($roleMenus);
                Yii::$app->request->url = $systemMenus[$firstMenu['menu_id']]['route'];
                array_unshift($roleMenus, $firstMenu);
            }

            $menus = $parentIds = [];
            foreach ($roleMenus as $roleMenu) {
                $menus[$roleMenu['menu_id']] = $systemMenus[$roleMenu['menu_id']];
                $parentIds[] = $systemMenus[$roleMenu['menu_id']]['parent_id'];
            }
            foreach ($parentIds as $parentId) {
                $menus[$parentId] = $systemMenus[$parentId];
                $menus[$systemMenus[$parentId]['parent_id']] = $systemMenus[$systemMenus[$parentId]['parent_id']];
            }
        }

        // 计算当前请求页面所在模块
        $module = explode('/', Yii::$app->request->url)[1];
        $currentIndex = 0;
        $menus = ArrayHelper::toTreeStructure($menus);
        foreach ($menus as $index => $menu) {
            if (strpos($menu['route'], $module) !== false) {
                $currentIndex = $index;
                break;
            }
        }

        // 用户所有菜单信息
        Yii::$app->params['menus'] = [
            'module' => explode('/', Yii::$app->request->url)[1],
            'index' => $currentIndex,
            'values' => $menus,
        ];
    }
}