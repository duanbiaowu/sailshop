<?php
class LoginWidget extends Widget
{
    private $cookie_time = 31622400;
    
    public function loginform()
    {
        $model       = new Model('oauth');
        $oauths      = $model->where('status = 1 order by `sort` desc')->findAll();
        $oauth_login = array();
        foreach ($oauths as $oauth) {
            $tem                                 = new $oauth['class_name']();
            $oauth_login[$oauth['name']]['url']  = $tem->getRequestCodeURL();
            $oauth_login[$oauth['name']]['icon'] = $oauth['icon'];
            $this->assign('oauth_login', $oauth_login);

        }

        $className = $this->id;
        $this->renderFile("$className/loginform", $this->output);
    }
    public function login()
    {
        $safebox   = Safebox::getInstance();
        $account   = Filter::sql(Req::post('account'));
        $passWord  = Req::post('password');
        $autologin = Req::args("autologin");
        if ($autologin == null) {
            $autologin = 0;
        }

        $model = new Model("user as us");
        $obj   = $model->join("left join customer as cu on us.id = cu.user_id")->fields("us.*,cu.group_id,cu.user_id,cu.login_time,cu.mobile")->where("us.email='$account' or us.name='$account' or cu.mobile='$account'")->find();
        if ($obj) {
            if ($obj['status'] == 1) {
                if ($obj['password'] == CHash::md5($passWord, $obj['validcode'])) {
                    $cookie = new Cookie();
                    $cookie->setSafeCode(Tiny::app()->getSafeCode());
                    if ($autologin == 1) {
                        $safebox->set('user', $obj, $this->cookie_time);

                        $cookie->set('autologin', array('account' => $account, 'password' => $obj['password']), $this->cookie_time);
                    } else {
                        $cookie->set('autologin', null, 0);
                        $safebox->set('user', $obj, 1800);

                    }
                    $model->table("customer")->data(array('login_time' => date('Y-m-d H:i:s')))->where('user_id=' . $obj['id'])->update();
                    echo ("<script>parent.window.location.reload();</script>");
                    exit;
                } else {
                    $info = array('field' => 'password', 'msg' => '密码错误！');
                }
            } else if ($obj['status'] == 2) {
                $info = array('field' => 'account', 'msg' => '账号已经锁定，请联系管理人员！');
            } else {
                $info = array('field' => 'account', 'msg' => '账号还未激活，无法登录！');
            }

        } else {
            $info = array('field' => 'account', 'msg' => '账号不存在！');
        }
        $this->assign('invalid', $info);
        $this->loginform();

    }
}
