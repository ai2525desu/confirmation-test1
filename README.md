# お問い合わせフォーム：confirmation-test1

## 環境構築

**Dockerビルド**
1. git clone git@github.com:ai2525desu/confirmation-test1.git
2. docker compose up -d --build

**マイグレーション**
* php artisan migrate
* 自身で作成
    1. 2025_05_28_022233_create_categories_table.php
    2. 2025_05_28_022635_create_contacts_table.php

**シーディング**
* php artisan db:seed
* 上記コマンドでエラーが発生した場合、下記の順でシーディング
    1. CategoiesTableSeederからシーディング
        - php artisan db:seed --class=CategoiesTableSeeder
    2. ContactsTableSeederのジーディング
        - php artisan db:seed --class=ContactsTableSeeder

## 使用技術(実行環境)
- Docker version 28.1.1, build 4eba377
- Laravel Framework 8.83.29
- PHP 7.4.9 (cli) (built: Sep  1 2020 02:33:08)
- nginx:1.21.1
- mysql:8.0.26

## ER図
![ER図](/contact-form.png)

## URL
​- phpMyadmin：http://localhost:8080/
- お問い合わせ入力フォーム：http://localhost/
- ユーザー登録画面：http://localhost/register
- ログイン画面：http://localhost/login


