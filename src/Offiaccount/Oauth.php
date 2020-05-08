<?php
namespace Rwechat\Offiaccount;


/**
 * 微信网页授权授权
 * 第一步
 * 用户同意授权，获取code
 */
class Oauth {

    private $config;


    /**
     * @param array('appid'=>6666666)
     */
    public function __construct(array $params)
    {
        $this->config = $params;
        $this->set_appid();
        $this->set_scope();
        $this->set_state();
    }


    public function send()
    {
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?';
        $url .= 'appid=' . $this->get_appid();
        $url .= '&redirect_uri=' . $this->get_callback_url();
        $url .= '&response_type=code&scope=' . $this->get_scope();
        $url .= '&state='.$this->get_state().'#wechat_redirect';

        header("location: {$url}");
    }


    /**
     * 授权后重定向的回调链接地址
     * 不用 urlEncode 对链接进行处理
     */
    public function set_callback_url($callback)
    {
        $this->redirect_uri = $callback;
        return $this;
    }


    /**
     * 应用授权作用域
     * snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid）
     * snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
     */
    public function set_scope($scope='snsapi_base')
    {
        $this->scope = $scope;
        return $this;
    }


    /**
     * 重定向后会带上state参数，开发者可以填写a-zA-Z0-9的参数值，最多128字节
     */
    public function set_state($state='')
    {
        $this->state = $state;
        return $this;
    }


    // set_appid
    private function set_appid()
    {
        $this->appid = $this->config['appid'];
        return $this;
    }



    // get_scope
    private function get_scope()
    {
        return $this->scope;
    }


    // get_callback_url
    private function get_callback_url()
    {
        return urlencode($this->redirect_uri);
    }


    // get_state
    private function get_state()
    {
        return $this->state;
    }


    // get_appid
    private function get_appid()
    {
        return $this->appid;
    }

}