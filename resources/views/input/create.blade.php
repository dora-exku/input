<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学生意外险登记</title>
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="content" style="margin-top:20px;">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <h4>有错误发生：</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         <form class="form-horizontal" role="form" action="{{ route('input.store') }}" method="post">
             {{ csrf_field() }}
             <input type="hidden" name="input_ip" value="{{ $input_ip }}">
             <input type="hidden" name="no" value="{{ $no }}">
             <input type="hidden" name="payment_method" value="wechat">
             <input type="hidden" name="total_amount" value="300">
             <div class="form-group">
                 <label for="firstname" class="col-sm-2 control-label">学生姓名</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" name="fullname" placeholder="请输入学生姓名" requiredd>
                 </div>
             </div>
             <div class="form-group">
                 <label for="lastname" class="col-sm-2 control-label">学生身份证号</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" name="id_card" placeholder="请输入正确的学生身份证号" requiredd>
                 </div>
             </div>
             <div class="form-group">
                 <label class="col-sm-2 control-label">家长手机号码</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" name="phone" placeholder="请输入正确的家长手机号码" requiredd>
                 </div>
             </div>
             <div class="form-group">
                 <label class="col-sm-2 control-label">学生年级</label>
                 <div class="col-sm-10">
                     <select name="class_number_parent" id="class_number_parent" class="form-control">
                         @foreach($class_number_parent as $k => $v)
                             <option value="{{ $k }}">{{ $v }}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
             <div class="form-group">
                 <label class="col-sm-2 control-label">学生班级</label>
                 <div class="col-sm-10">
                     <select name="class_number_child" id="class_number_child" class="form-control">
                         @foreach($class_number_child as $k => $v)
                             <option value="{{ $k }}">{{ $v }}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
             <div class="form-group">
                 <label class="col-sm-2 control-label">备注</label>
                 <div class="col-sm-10">
                     <textarea name="remark" id="remark" cols="30" rows="2" class="form-control">请输入备注内容，没有可不填</textarea>
                 </div>
             </div>
{{--             <div class="form-group">--}}
{{--                 <label class="col-sm-2 control-label">支付方式</label>--}}
{{--                 <div class="col-sm-10">--}}
{{--                     <select name="payment_method" id="payment_method" class="form-control">--}}
{{--                         <option value="cash">现金</option>--}}
{{--                         <option value="wechat">微信支付</option>--}}
{{--                         <option value="alipay">支付宝支付</option>--}}
{{--                     </select>--}}
{{--                 </div>--}}
{{--             </div>--}}
             <div class="form-group">
                 <label class="col-sm-2"></label>
                 <div class="col-sm-10">
                     <button type="submit" class="btn btn-block btn-primary">提交</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
 </body>
 </html>
<script>
    var price = @json($price);

    $('#class_number_parent').on('change', function () {
        var $val = $(this).val();
        $('input[name="total_amount"]').val(price[$val]);
        console.log($val);
    });

    $('form').on('submit', function () {
        return confirm('请确认您输入的信息是否正确? ');
    });
</script>
