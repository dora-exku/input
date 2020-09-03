<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use mysql_xdevapi\Exception;

class WechatService
{
    protected $option = [];

    protected $client;

    const MP_ACCESS_TONEN_KEY = 'wechat:mp_access_token';
    const MP_JSSDK_TICKET_KEY = 'wechat:mp_jssdk_ticket';

    public function __construct()
    {
        $this->option = config('wechat');
        $this->client = new Client();
    }

    public function getAccessToken()
    {
        $accessToken = Cache::remember(self::MP_ACCESS_TONEN_KEY, 7000, function () {
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->option['appid'] . '&secret=' . $this->option['secret'];
            $result = $this->client->get($url)->getBody()->getContents();
            $result_arr = json_decode($result, true);
            if (isset($result_arr['access_token'])) {
                return $result_arr['access_token'];
            } else {
                throw new \Exception('获取access token失败' . $result);
            }
        });
        return $accessToken;
    }

    public function getUserAccessToken($code)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='
            . $this->option['appid']
            . '&secret=' . $this->option['secret'] . '&code='.$code.'&grant_type=authorization_code';

        $result = $this->client->get($url)->getBody()->getContents();
        $result_arr = json_decode($result, true);
        if (isset($result_arr['access_token'])) {
            return [
                'openid' => $result_arr['openid'],
                'access_token' => $result_arr['access_token']
            ];
        } else {
            throw new \Exception('获取access_token失败' . $result);
        }
    }

    public function getAuthUrl($callurl = null)
    {
        $callurl = is_null($callurl) ? request()->url() : $callurl;
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='
            . $this->option['appid']
            . '&redirect_uri=' . urlencode($callurl) . '&response_type=code&scope=snsapi_base&state=code#wechat_redirect';
        redirect($url)->send();
    }

    public function getJsapiTicket()
    {
        return Cache::remember(self::MP_JSSDK_TICKET_KEY, 7000, function () {
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $this->getAccessToken() . '&type=jsapi';
            $result = $this->client->get($url)->getBody()->getContents();
            $result_arr = json_decode($result, true);
            if (isset($result_arr['ticket'])) {
                return $result_arr['ticket'];
            } else {
                throw new \Exception('获取ticket失败' . $result);
            }
        });
    }

    public function getJssdkConfig()
    {
        $param = [
            'noncestr' => uniqid(),
            'jsapi_ticket' => $this->getJsapiTicket(),
            'timestamp' => time(),
            'url' => request()->fullUrl()
        ];
        sort($param);
        $param['signature'] = sha1(urldecode(http_build_query($param)));
        $param['appid'] = $this->option['appid'];
        return $param;
    }
}
