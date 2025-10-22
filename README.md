# mogitate

## 環境構築
cd coachtech/laravel

git clone git@github.com:Estra-Coachtech/laravel-docker-template.git

mv laravel-docker-template mogitate

cd mogitate

git remote set-url origin git@github.com:yushiro46/mogitate.git

git remote -v

git add .

git commit -m "リモートリポジトリの変更"

git push origin main

docker-compose up -d --build

docker-compose exec php bash

composer install

php artisan make:migration create_products_table

php artisan make:migration create_seasons_table

php artisan make:migration create_product_season_table


php artisan migrate

php artisan make:seeder ProductsTableSeeder

php artisan make:seeder SeasonsTableSeeder

php artisan make:seeder Product_SeasonTableSeeder

php artisan db:seed

php artisan key:generate

## 使用技術
PHP8.x/Laravel8.75

## ER図
![ER図][def]
[def]: er-diagram.png

## URL
ローカル環境　http://localhost/products

