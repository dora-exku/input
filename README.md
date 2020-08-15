## 表单录入

1、克隆项目 `git clone git@github.com:dora-exku/input.git`

2、进去项目目录执行 `composer install` 安装所需拓展 下载慢把`composer`换国内源 自行百度

3、复制 `.env.example`  为 `.env` 修改其中
```$xslt
DB_HOST=127.0.0.1        数据库链接
DB_PORT=3306             数据库端口
DB_DATABASE=input        数据库名
DB_USERNAME=homestead    数据库用户名
DB_PASSWORD=secret       数据库密码
```

4、执行 `php artisan migrate` 迁移数据库

5、访问 `域名/admin` 进入后台 默认账号密码为`admin`

6、nginx项目运行目录指向`public`
