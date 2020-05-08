<?php
namespace Rwechat\Offiaccount;
use Rhttp\Get;


/**
 * 获取用户基本信息(UnionID机制)
 */
class UserInfo {


    public function send()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?';
        $url .= 'access_token=' . $this->get_token();
        $url .= '&openid=' . $this->get_openid() . '&lang=zh_CN';

        $ret = Get::send($url);
        return json_decode($ret, true);
    }


    public function set_token($token)
    {
        $this->token = $token;
        return $this;
    }


    public function set_openid($openid)
    {
        $this->openid = $openid;
        return $this;
    }


    private function get_token()
    {
        return $this->token;
    }

    private function get_openid()
    {
        return $this->openid;
    }


}