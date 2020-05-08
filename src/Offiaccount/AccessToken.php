<?php
namespace Rwechat\Offiaccount;
use Rhttp\Get;


/**
 * 获取access_token
 * access_token是公众号的全局唯一接口调用凭据
 */
class AccessToken {


    public function __construct(array $params)
    {
        $appid = isset($params['appid'])? $params['appid']: '';
        $secret = isset($params['appsecret'])? $params['appsecret']: '';
        $this->set_appid($appid);
        $this->set_secret($secret);
    }


    public function send()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&';
        $url .= 'appid=' . $this->get_appid();
        $url .= '&secret=' . $this->get_secret();

        $ret = Get::send($url);
        return json_decode($ret, true);
    }


    public function set_appid($appid)
    {
        $this->appid = $appid;
        return $this;
    }


    public function set_secret($secret)
    {
        $this->secret = $secret;
        return $this;
    }


    private function get_appid()
    {
        return $this->appid;
    }

    private function get_secret()
    {
        return $this->secret;
    }

}