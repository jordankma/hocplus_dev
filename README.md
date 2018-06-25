# VNEdutech CMS

Hệ thống quản lý tập trung VNEdutech

## Bắt đầu

Hướng dẫn này sẽ giúp bạn tạo một bản sao của dự án. Khởi chạy nó trên máy tính cá nhân nhằm triển khai và kiểm thử các chức năng.

### Điều kiện tiên quyết

Những thành phần cần thiết để cài đặt CMS

#### Yêu cầu server
```
PHP >= 7.2
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
XML PHP Extension
Ctype PHP Extension
JSON PHP Extension
```
#### Yêu cầu công cụ
```
Composer: https://getcomposer.org
```

### Cài đặt

Bước 1: Tải CMS từ Gitlab
```
https://gitlab.egroup.vn/laravel/core-cms.git
```

Bước 2: Chạy command để cài đặt các thành phần theo file composer.json
```
composer update
```

### Cấu hình

Bước 1: Tạo config cho domain (eg: dev.local.vn)
```
Config dự án được đặt tại: packages/adtech/application/src/configs/
Config chuẩn nằm trong folder: default.local.vn
Dev có thể sao chép từ default.local.vn để tạo config cho dự án.
```

Bước 2: Thư mục public - webroot
 ```
 Cấu hình web root: public.
 File index.php sẽ điều khiển request tới dự án.
 
 Đối với apache:
 Options +FollowSymLinks
 RewriteEngine On
 
 RewriteCond %{REQUEST_FILENAME} !-d
 RewriteCond %{REQUEST_FILENAME} !-f
 RewriteRule ^ index.php [L]
 
 Đối với nginx:
 location / {
     try_files $uri $uri/ /index.php?$query_string;
 }
 ```
 
 Bước 3: Cấp quyền thư mục
 ```
 Cấp full quyền tại /storage và /bootstrap/cache
 ```


## Khởi tạo database + dữ liệu
Bước 1: Tạo database và chỉnh config tại file database.php trong folder config domain.
Bước 2: Khởi tạo database + dữ liệu bằng cách sử dụng artisan
 ```
php artisan migrate --path="packages/adtech/core/src/database/migrations"
php artisan db:seed
 ```

## Chạy thử nghiệm
