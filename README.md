# お問い合わせフォーム

##　環境構築
Dockerビルド
1.git clone git@github.com:coachtech-material/laravel-docker-template.git
2.docker-compse up -d -build

Laravel環境構築
1.docker-compose exec php bash
2.composer install
3..env.exampleファイルから.envを作成し、環境変数を変更
4.php artisan key:generate
5.php artisan migrate
6.php artisan db:seed --class=ContactsSeeder

## 使用技術(提出前に要確認)
・ PHP 8.4.2
・ Laravel 8.83.8
・ MySQL 8.0.42

## ER図
[ER図](index.png)

## URL
・ 開発環境 : http://localhost/
・ phpMyAdmin : http://localhost:8080/

