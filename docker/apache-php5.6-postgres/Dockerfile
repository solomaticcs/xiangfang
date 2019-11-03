FROM php:5.6-apache
RUN set -ex apk --no-cache add postgresql-dev libpq-dev
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql mbstring
