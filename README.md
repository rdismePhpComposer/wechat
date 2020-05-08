# wechat

> 微信相关操作类

## 微信公众号


[获取access_token](#token)

[网页授权](#wysq)

[1、第一步：用户同意授权，获取code](#wysq-1)

[2、第二步：通过code换取网页授权access_token](#wysq-2)

[用户管理](#yhgl)

[1、获取用户基本信息(UnionID机制)](#yhgl-1)



### <span id='token'>获取access_token</span>

```
use Rwechat\Offiaccount\AccessToken;

$wxconfig = array(
    'appid' => '22222',
    'appsecret' => '3333'
);

$token = new AccessToken($wxconfig);
$token = $token->send();

var_dump($token);
```


### <span id='wysq'>网页授权</span>

- <span id='wysq-1'>授权第一步：用户同意授权，获取code</span>

```
use Rwechat\Offiaccount\Oauth;

$wxconfig = array(
    'appid' => '222222'
);
$oauth = new Oauth($wxconfig);

/**
 * 必须传值
 * 授权后重定向的回调链接地址
 * 不用 urlEncode 对链接进行处理
 */
$oauth->set_callback_url($callback_url)

/**
 * 可不传，默认snsapi_base
 * 应用授权作用域
 * snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid）
 * snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
 */
        ->set_scope($scope)

/**
 * 可不传，默认空
 * 重定向后会带上state参数，开发者可以填写a-zA-Z0-9的参数值，最多128字节
 */
        ->set_state($state)

## 开始授权
        ->send();
```

- <span id='wysq-2'>第二步：通过code换取网页授权access_token</span>

```
use Rwechat\Offiaccount\OauthAcceccToken;

$wxconfig = array(
    'appid' => '22222',
    'appsecret' => '3333'
);

// 授权第一步回跳带过来的code参数
$code = 'eeeeee';

$oauth = new OauthAcceccToken($wxconfig);
$access_token = $oauth->set_code($code)->send();

var_dump($access_token);
```

### <span id='yhgl'>用户管理</span>

- <span id='yhgl-1'>获取用户基本信息(UnionID机制)</span>

```
use Rwechat\Offiaccount\UserInfo;

$token = '27_yPUlqMZwnBDDE8iuYZ_lXGsfjvM1oDOKDF6TQm13Fj5WdKPIUAx1l8J54bRoxjtDSoMNdX7vIZAqGOrrPSi4_Gaa0HV5v1EQKuRq0ua_EvwbS9fD-aJT2OHb-fqMNX5yfZ6iKtF7j0dFs4JWJKCaADAUVN';
$openid = 'oUCzdt94RI5zuZcCwMeRjswX_UqM';

$user = new UserInfo();
$info = $user->set_token($token)
        ->set_openid($openid)->send();

var_dump($info);
```