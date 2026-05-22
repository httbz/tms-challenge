FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mysqli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

CMD ["tail", "-f", "/dev/null"]
