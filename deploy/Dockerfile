FROM php:8.3-apache

ENV PORT=8000

RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    git \
    curl \
    nodejs \
    npm && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    docker-php-ext-install pdo mbstring pdo_mysql gd

WORKDIR /app

COPY . /app

RUN composer install --ignore-platform-reqs && \
    npm install && \
    npm run build && \
    php artisan key:generate

EXPOSE $PORT

CMD php artisan serve --host=0.0.0.0 --port=$PORT
