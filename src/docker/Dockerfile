
FROM node:20 AS vite-builder
WORKDIR /app
COPY package*.json ./
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm install
RUN npm run build


FROM php:8.4-fpm-alpine AS php-fpm
WORKDIR /var/www
RUN apk add --no-cache icu-dev libzip-dev oniguruma-dev sqlite-dev
RUN docker-php-ext-install intl zip pdo pdo_sqlite mbstring
COPY . /var/www   
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist


FROM php:8.4-fpm-alpine
WORKDIR /var/www
RUN apk add --no-cache icu-dev libzip-dev oniguruma-dev sqlite-dev
RUN docker-php-ext-install intl zip pdo pdo_sqlite mbstring
COPY --from=php-fpm /var/www/vendor /var/www/vendor
COPY --from=vite-builder /app/public /var/www/public
COPY . /var/www
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
RUN chown -R www-data:www-data /var/www
USER www-data
EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]