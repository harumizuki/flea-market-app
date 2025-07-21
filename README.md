# FleaMarket App

Laravelを用いて開発したフリマアプリです。  
ユーザーは商品を出品・閲覧・購入でき、コメントやいいね機能を通じて他ユーザーと交流できます。

## 使用技術

- PHP 8.x
- Laravel 10.x
- MySQL 8.x
- Docker（任意、ローカル環境で使用する場合）
- Node.js（Tailwind CSS ビルド管理用に使用）

## セットアップ手順

1. リポジトリをクローン
git clone https://github.com/harumizuki/fleamarket-app.git


2. .envファイルを作成
cp .env.example .env


3. 依存パッケージをインストール
composer install
npm install


4. アプリケーションキーを生成
php artisan key:generate


5. データベースを作成・マイグレーション・シーディング
php artisan migrate --seed


6. ストレージリンク作成（画像アップロードを使用する場合）
php artisan storage:link


7. サーバーを起動
php artisan serve


## テストユーザー

- メールアドレス: test@example.com
- パスワード: password

## 注意事項

- 画像アップロード機能を使用する場合は `storage` ディレクトリのパーミッションに注意してください。
- Docker環境を使用する場合は、`.env` 内のDB接続設定を適宜変更してください。