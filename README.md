## 環境設定

### Docker Desktopのインストール
* Windowsの場合：事前にWSL2、Ubuntuをインストール

### PHPをインストール
* バージョン8.02以上

### Composerをインストール

### clone

```bash
git clone git@github.com:tc-kishimoto/fullstack-backend.git
```

### ライブラリインストール

```php
composer install
```

### コンテナ起動

Macの場合はTerminalから、Windowsの場合はUbuntuから以下を実行
```bash
./vendor/bin/sail up -d
```

### マイグレーション

```bash
./vendor/bin/sail artisan migrate
```

または

```bash
php artisan migrate
```

### シーディング

```bash
./vendor/bin/sail db:seed
```

または

```bash
php artisan db:seed
```
