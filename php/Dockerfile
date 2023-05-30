FROM php:8.2-rc-fpm-alpine
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de PDO
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && apk add --no-cache \
        mariadb-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && apk del .build-deps