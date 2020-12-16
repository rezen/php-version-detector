FROM php:8.0-cli
RUN apt-get update && apt-get install -y \
    && pecl install ast \
    && docker-php-ext-enable ast \
    && mkdir /app

COPY . /app
WORKDIR /app
ENTRYPOINT ["/app/php-version-detector" ]