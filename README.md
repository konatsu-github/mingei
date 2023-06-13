# docker 起動
docker compose up -d

# Laravelアプリの生成（初期設定）
composer create-project --prefer-dist laravel/laravel mingei "8.*"

# コンテナ内に入る
docker compose exec mingei_app bash
↓
cd mingei

# storageパーミッション変更
chown www-data storage/ -R
chown www-data storage/logs/ -R

# アクセス先
http://localhost:8000/


# --------------------------------------------
# DB操作
# --------------------------------------------

# シーダーの作成
php artisan make:seeder TestsTableSeeder

# マイグレーションファイルの作成
php artisan make:migration create_tests_table

# マイグレーション実行
php artisan migrate

# modelファイルの作成（テーブル名を単数形で）
php artisan make:model Test

# シーダー実行
php artisan db:seed

# シーダー実行（クラス名指定）
php artisan db:seed --class TestsTableSeeder

# --------------------------------------------
# APP系
# --------------------------------------------

# コントローラ生成（resource付き）
php artisan make:controller TestController --resource


# --------------------------------------------
# npm系
# --------------------------------------------

# tailwindコンパイルウォッチ
npm run watch
