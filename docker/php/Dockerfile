# phpバージョン1.4.9のインストール
FROM php:7.4.9-fpm

# 別途作成されたphp.iniをコンテナ内の/usr/local/etc/php/にコピー
COPY php.ini /usr/local/etc/php/

# 起動時に必要なコマンドの実行
# ①MySQLの設定
RUN apt update \
    && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
    && docker-php-ext-install pdo_mysql zip

# ②composerの設定
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

# ユーザーをrootではなく一般ユーザーで使用するための設定
RUN useradd -m ai2525desu

# /var/wwwをワーキングディレクトリに設定
WORKDIR /var/www
