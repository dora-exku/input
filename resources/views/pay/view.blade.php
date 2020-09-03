<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>支付</title>
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
</head>
<body>
<div>
    <div class="container">
        <div class="content" style="margin-top:20px;text-align: center">
            <span>订单金额</span>
        </div>
        <div class="content" style="text-align: center">
            <h2>{{ $order->total_amount }}</h2>
        </div>
        <button class="btn btn-block btn-success" style="margin-top:30px;">立即支付</button>
    </div>
</div>
</body>
</html>
<script>
    wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '{{ $config['appid'] }}', // 必填，公众号的唯一标识
        timestamp: {{ $config['timestamp'] }}, // 必填，生成签名的时间戳
        nonceStr: '{{ $config['noncestr'] }}', // 必填，生成签名的随机串
        signature: '{{ $config['signature'] }}',// 必填，签名
        jsApiList: ['chooseWXPay'] // 必填，需要使用的JS接口列表
    });

    wx.ready(function () {
        console.log('ok');
    });

    wx.error(function(err) {
        console.log(err);
    });
</script>
