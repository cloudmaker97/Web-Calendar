FROM webdevops/php-apache:8.0
COPY ./public_html/ /app
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer install -d /app
RUN composer dump-autoload  -d /app