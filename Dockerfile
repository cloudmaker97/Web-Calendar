FROM webdevops/php-nginx:7.3
COPY ./public_html/ /app
RUN composer install -d /app
RUN composer dump-autoload