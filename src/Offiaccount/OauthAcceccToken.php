<?php
namespace Rwechat\Offiaccount;
use Rhttp\Get;


/**
 * 微信网页授权授权
 * 第二步：通过code换取网页授权access_token
 * 首先请注意，这里通过code换取的是一个特殊的网页授权access_token,与基础支持中的access_token（该access_token用于调用其他接口）不同。公众号可通过下述接口来获取网页授权access_token。如果网页授权的作用域为snsapi_base，则本步骤中获取到网页授权access_token的同时，也获取到了openid，snsapi_base式的网页授权流程即到此为止。
 */
class OauthAcceccToken {

    private $config;


    public function __construct(array $params)
    {
        // 设置参数
        $this->config = $params;
        $this->set_appid();
        $this->set_secret();
    }


    public function send()
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?';
        $url .= 'appid=' . $this->get_appid();
        $url .= '&secret=' . $this->get_secret();
        $url .= '&code=' . $this->get_code();
        $url .= '&grant_type=authorization_code';

        $ret = Get::send($url);
        return json_decode($ret, true);
    }


    public function set_code($code)
    {
        $this->code = $code;
        return $this;
    }


    private function get_code()
    {
        return $this->code;
    }


    // set_secret
    private function set_secret()
    {
        $this->secret = $this->config['appsecret'];
        return $this;
    }


    // get_secret
    private function get_secret()
    {
        return $this->secret;
    }


    // set_appid
    private function set_appid()
    {
        $this->appid = $this->config['appid'];
        return $this;
    }


    // get_appid
    private function get_appid()
    {
        return $this->appid;
    }

}