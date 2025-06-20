FROM php:8.2.28-fpm

ARG WWWGROUP=1000
ARG WWWUSER=wwwuser

RUN apt-get update \
    && apt-get install -y \
    openssl \
    curl \
    vim \
    git \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    && docker-php-ext-install pdo_pgsql pgsql mbstring opcache \
    && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g $WWWGROUP $WWWGROUP || true \
    && useradd -u 1000 -g $WWWGROUP -m $WWWUSER || true

WORKDIR /var/www

COPY . /var/www

RUN chown -R $WWWUSER:$WWWGROUP /var/www \
    && find /var/www -type f -exec chmod 664 {} \; \
    && find /var/www -type d -exec chmod 775 {} \; \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && chown -R $WWWUSER:$WWWGROUP /var/www/storage /var/www/bootstrap/cache