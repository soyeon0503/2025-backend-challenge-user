FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd

# Composer 설치
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 소스 코드 복사
COPY . .

# 의존성 설치
RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]
