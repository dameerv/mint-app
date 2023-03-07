FROM php:7.4-fpm

RUN apt update \
    && apt-get install -y libpq-dev wget git unzip \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip  \
    && docker-php-ext-install intl opcache pdo pdo_pgsql  pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

ARG PUID=1000
ARG PGUID=1000
ARG WORKDIR=/var/www

WORKDIR ${WORKDIR}
RUN groupadd ${PGUID}
RUN usermod -a -G ${PGUID} www-data

RUN chown -R ${PUID}:${PGUID} ../

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl https://deb.nodesource.com/setup_16.x | bash
RUN curl https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install -y nodejs yarn build-essential gcc make libpng-dev
RUN git config --global core.filemode false
