# Docker+Wordpress
Dockerを利用して、Wordpress開発環境を構築します。
<br>SCSSコンパイラーは「npm sass」、また「tailwind css v3」を使用します。
<br>Browser Syncで、リロード機能を付けていますので、ポート番号を正確に設定する必要があります。
<br>
- [1. 初期設定・確認事項](#1-初期設定確認事項)
- [2. 環境構築](#2-環境構築)
- [3. 開発作業](#3-開発作業)
- [4. 作業終了](#4-作業終了)
<br><br>
- [★Dockerを使わずに「scssのコンパイルのみしたい」場合](#scssのコンパイルのみ使う)
- [★Dockerでメールを確認できる環境を構築する」場合](#dockerでメールを確認できる環境を構築する)
<br><br><br>


## 1. 初期設定・確認事項
### ▼インストールしておくもの
- Docker Desktop
- Node.js (v22.22.2)
<br>※Node.jsのバージョン管理は[Volta](https://volta.sh/)でできます。
<br>参考）[Node.jsのバージョン管理ツール「Volta」のインストール・導入方法・使い方を解説](https://fukulog.net/volta/)

### ▼DockerのWordpress Image設定／確認（Dockerfile）
初期設定はWordpress最新バージョン＋php8.2になりますので、
<br>違うバージョンで構築する場合は[【公式】Docker Wordpress Image](https://hub.docker.com/_/wordpress/tags)から検索して「Dockerfile」から変更してください。
```bash
# 初期設定（Wordpress最新バージョン＋php8.2）
FROM wordpress:php8.2-apache

# wordpressのバージョン指定（Wordpress6.8.1＋php8.2）
FROM wordpress:6.8.1-php8.2-apache

# php7.4はwordpress 6.1.1が最新（構築してからバージョンアップはできます）
FROM wordpress:php7.4-apache
```

### ▼プロジェクトに合わせて修正するところ
➀ポート番号：ports番号が揃っているのか確認（例：9999）
<br>※ポート番号は重複ができないので、案件ごとに変更する必要があります。
<br>
<br>②テーマ名：Wordpress themesのディレクトリー名（例：kbz-theme）
<br>※テーマ名名に変更がない場合、変更する必要はありません。
```bash
# docker-compose.yml
ports:
    - "{{ ポート番号 }}:80"

# package.json
"scripts": {
    "docker:up": "docker compose up -d",
    "docker:down": "docker compose down",

    "_sass": "sass wp-content/themes/{{ テーマ名 }}/assets/_scss:wp-content/themes/{{ テーマ名 }}/assets/css --style=expanded --no-source-map",
    "_sass-watch": "sass --watch wp-content/themes/{{ テーマ名 }}/assets/_scss:wp-content/themes/{{ テーマ名 }}/assets/css --style=expanded --no-source-map",
    "_postcss": "postcss wp-content/themes/{{ テーマ名 }}/assets/css/style.css -o wp-content/themes/{{ テーマ名 }}/assets/css/style.min.css",
    "_postcss-watch": "onchange \"wp-content/themes/{{ テーマ名 }}/assets/css/style.css\" -- npm run _postcss",
    "build": "npm-run-all _sass _postcss",

    "_watch:php": "onchange \"wp-content/themes/{{ テーマ名 }}/**/*.php\" -- npm run build",
    "_watch:scss": "onchange \"wp-content/themes/{{ テーマ名 }}/assets/_scss/**/*.scss\" -- npm run build",
    "watch": "npm-run-all --parallel _watch:php _watch:scss",

    "serve": "browser-sync start --proxy localhost:{{ ポート番号 }} --files \"wp-content/themes/{{ テーマ名 }}/assets/css/*.css, wp-content/themes/{{ テーマ名 }}/**/*.php\" --watch-options.usePolling=true",
    "dev": "npm-run-all docker:up build --parallel watch serve"
},

# tailwind.config.js
content: [
    "./wp-content/themes/{{ テーマ名 }}/**/*.php",
    "./wp-content/themes/{{ テーマ名 }}/**/*.js",
],
```
上記のsass設定では以下のようになります。
- `wp-content/{{ テーマ名 }}/assets/_scss`内のscssファイルを`wp-content/{{ テーマ名 }}/assets/css`にコンパイルされます。
- `wp-content/{{ テーマ名 }}/`内のファイルに変更があれば自動リロードします。
<br><br><br>



## 2. 環境構築
### ▼パッケージのインストール
```bash
npm install
```

### ▼DockerでWordPressを立ち上げる
```bash
npm run up
```
<br><br>


## 3. 開発・作業
1と2がが済んだら、次回からはここからでＯＫです。

### ▼開発環境の起動
Docker Desktopを立ち上げておき、
```bash
npm run dev
```
DockerでWordPressが起動します。
<br>ブラウザで `http://localhost:3000` にアクセスします。
<br>（3000ポートが既に使用中の場合は3001などに変更されます）

### ▼Wordpressにアクセスしてセットアップ
開かれたブラウザでWordpressの設定を行います。
<br>Migrationをする場合は適当に設定してからプラグインで設定してください。
<br><br>

### ★scssのコンパイルのみ使う
scssとtailwind cssのコンパイルのみ使う場合は下記のコマンドのみでOKです。
```bash
npm run watch
```
<br><br>



## 4. 作業終了
```bash
npm run down
```
Dockerのコンテナーから削除します。
<br>この作業をしないと同じポート番号を使っているコンテナー（プロジェクト）が起動できません。
<br>もし、複数のコンテナー（プロジェクト）を起動したい場合はポート番号をそれぞれ変更してください。
<br><br><br>


## ★Dockerでメールを確認できる環境を構築する
docker-compose.ymlにコメントアウトしているmailcatcherを解除してから設定を行う。
<br>SMTP設定などの説明：https://qiita.com/tegnike/items/44e9f328f082bb0952ad
```bash
#docker-compose.yml
mailcatcher:
    image: schickling/mailcatcher
    ports:
      - "0:1080"
      - "0:1025"
```