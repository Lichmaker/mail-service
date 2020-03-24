# 简单的邮件推送服务（非异步） mail-service

## 注意事项
1. 使用 `lumen` 框架，尽量轻便的同时可以快速二次开发
2. 使用 `mailGun` 邮件推送服务商，免费账户一个月5k条，可自行注册

## 安装

1.fork 本仓库后(可选)，`git clone` 到本地中

```
git clone https://github.com/Lichmaker/mail-service.git
```
2.安装框架
```
cd mail-service

# composer.json 中已经配置使用阿里云镜像服务
composer install
```
3.修改配置
```
cp .env.example .env

vim .env
# 注意修改环境和DEBUG模式
APP_ENV=product
APP_DEBUG=false

# 在 mailGun 中注册后，填写 domain 和 api key 到以下配置中
MAILGUN_DOMAIN=
MAILGUN_SECRET=

```
4.(可选，仅供参考)nginx配置
```
server {
    # 监听 HTTP 协议默认的 [80] 端口。
    listen 80;
    # 绑定主机名 [example.com]。
    server_name mail-service.wuguozhang.com;
    # 服务器站点根目录 [/example.com/public]。
    root 您的项目根目录绝对路径/public;

    # 添加几条有关安全的响应头；与 Google+ 的配置类似，详情参见文末。
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    # 站点默认页面；可指定多个，将顺序查找。
    # 例如，访问 http://example.com/ Nginx 将首先尝试「站点根目录/index.html」是否存在，不存在则继续尝试「站点根目录/index.htm」，以此类推...
    index index.html index.htm index.php;

    # 指定字符集为 UTF-8
    charset utf-8;

    # Laravel 默认重写规则；删除将导致 Laravel 路由失效且 Nginx 响应 404。
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # 关闭 [/favicon.ico] 和 [/robots.txt] 的访问日志。
    # 并且即使它们不存在，也不写入错误日志。
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    # （可选）指定 log 路径
    access_log /var/log/nginx/mail_service_access.log;
    error_log  /var/log/nginx/mail_service_error.log error;

    # 将 [404] 错误交给 [/index.php] 处理，表示由 Laravel 渲染美观的错误页面。
    error_page 404 /index.php;

    # URI 符合正则表达式 [\.php$] 的请求将进入此段配置
    location ~ \.php$ {
        # 配置 FastCGI 服务地址，可以为 IP:端口，也可以为 Unix socket。
#       fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
	    fastcgi_pass   127.0.0.1:9000;
        # 配置 FastCGI 的主页为 index.php。
        fastcgi_index index.php;
        # 配置 FastCGI 参数 SCRIPT_FILENAME 为 $realpath_root$fastcgi_script_name。
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        # 引用更多默认的 FastCGI 参数。
        include fastcgi_params;
    }
    # 通俗地说，以上配置将所有 URI 以 .php 结尾的请求，全部交给 PHP-FPM 处理。

    # 除符合正则表达式 [/\.(?!well-known).*] 之外的 URI，全部拒绝访问
    # 也就是说，拒绝公开以 [.] 开头的目录，[.well-known] 除外
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 使用

`laravel` 官方的邮件使用文档十分详细，可以结合代码中已有的 example 和文档，自由发挥吧！

> 文档传送 https://learnku.com/docs/laravel/7.x/mail/7488
