## 環境設定

### Docker Desktopのインストール
* Windowsの場合：事前にWSL2、Ubuntuをインストール

### PHPのインストール
* PHPバージョン8.02以上をインストール
* 環境変数にPATHを通しておく

### Composerをインストール
* composerコマンドがつけるようにしておく

### clone
リポジトリからクローンする

sshの場合

```bash
git clone git@github.com:tc-kishimoto/fullstack-backend.git
```

httpsの場合

```bash
https://github.com/tc-kishimoto/fullstack-backend.git
```

### ライブラリインストール

```bash
cd fullstack-backend
composer install
```

### .envの作成
.env.exampleをコピーして.envファイルを作成
MySQLのユーザー、データベース、パスワードを適当に設定

### コンテナ起動

Macの場合はターミナルから、Windowsの場合はUbuntuから実行

```bash
./vendor/bin/sail up -d
```

### アプリケーションキー作成

```bash
php artisan key:generate
```

### マイグレーション

```bash
php artisan migrate
```

※DB接続でエラーが出る場合

docker-compose.ymlのmysqlの項目を以下に変更する

```yml
mysql:
    image: 'mysql:8.0'
    ports:
        - '${FORWARD_DB_PORT:-3306}:3306'
    environment:
        MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
        MYSQL_DATABASE: '${DB_DATABASE}'
        MYSQL_USER: '${DB_USERNAME}'
        MYSQL_PASSWORD: '${DB_PASSWORD}'
        MYSQL_ALLOW_EMPTY_PASSWORD: 'yes'
    volumes:
        - 'sail-mysql:/var/lib/mysql'
    networks:
        - sail
    healthcheck:
        test: ["CMD", "mysqladmin", "ping", "-p${DB_PASSWORD}"]
        retries: 3
        timeout: 5s
```

docker-compose.ymlの設定を変更したあとコンテナの起動に失敗する場合、
Docker Desktopよりmysqlのコンテナとvolumeを一旦削除して再度コンテナを起動する。

.envのDB_HOSTは127.0.0.1に設定する

```text
DB_HOST=127.0.0.1
```

### シーディング

```bash
php artisan db:seed
```
