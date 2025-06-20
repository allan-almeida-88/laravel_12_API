FROM php:8.2.28-fpm

ARG WWWUSER=wwwuser
ARG WWWGROUP=www-data
ARG WWWUID=1000
ARG WWWGID=1000

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

RUN groupadd -g ${WWWGID} ${WWWGROUP} || true && \
    useradd -m -u ${WWWUID} -g ${WWWGROUP} ${WWWUSER}

WORKDIR /var/www

COPY . /var/www

ARG WWWUSER
ARG WWWGROUP

RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && \
    chown -R ${WWWUSER}:${WWWGROUP} /var/www && \
    find /var/www -type f -exec chmod 664 {} \; && \
    find /var/www -type d -exec chmod 775 {} \; && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache && \
    chown -R ${WWWUSER}:${WWWGROUP} /var/www/storage /var/www/bootstrap/cache

USER ${WWWUSER}