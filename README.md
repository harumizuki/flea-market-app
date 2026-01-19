# フリマアプリ（fleamarket-app）

## アプリ概要
フリマアプリを想定したWebアプリです。
商品一覧（おすすめ / マイリスト）、商品詳細、いいね、コメント、出品、購入、送付先住所変更、マイページ機能を実装しています。

---

## 環境構築（Docker）

### 1. リポジトリをクローン
git clone <このリポジトリURL>
cd fleamarket-app

### 2. Dockerを起動
docker compose up -d --build

### 3. Laravel初期設定
docker compose exec php composer install
docker compose exec php cp .env.example .env
docker compose exec php php artisan key:generate

### 4. マイグレーション & シーディング
docker compose exec php php artisan migrate --seed

### 5. 画像表示用のシンボリックリンク作成
docker compose exec php php artisan storage:link

---

## 動作確認URL
アプリ: http://localhost:8080
phpMyAdmin: http://localhost:8081

---

## 使用技術（実行環境）
PHP 8.2  
Laravel 12.x  
MySQL 5.7  
nginx  
Docker / Docker Compose  

---

## 実装機能
商品一覧（おすすめ / マイリスト切替、検索）
商品詳細
いいね機能（追加 / 解除、いいね数表示）
コメント投稿
商品出品（画像アップロード）
商品購入
送付先住所変更
マイページ
ログイン / 会員登録（Laravel Fortify）

---

## 画像アップロードについて
画像は storage/app/public/ 配下に保存されます。
php artisan storage:link を実行し、public/storage 経由で表示しています。

---

## ER図
erd.png を参照してください。

---

## テストユーザー

【テストユーザー（メル）】
メール：test100@example.com
パスワード：password123

【テストユーザー（メル2）】
メール：test200@example.com
パスワード：password123
