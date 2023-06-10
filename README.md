# docker 起動
docker compose up -d

# Laravelアプリの生成（初期設定）
composer create-project --prefer-dist laravel/laravel mingei "8.*"

# コンテナ内に入る
docker compose exec mingei_app bash

# storage変更
chown www-data storage/ -R

