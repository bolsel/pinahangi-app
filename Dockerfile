#syntax=docker/dockerfile:1.4
FROM alpine:3 AS base

# Fix iconv issue when generate pdf
RUN apk --no-cache add --repository http://dl-cdn.alpinelinux.org/alpine/v3.13/community/ gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

RUN apk --no-cache add \
    nginx \
    supervisor \
    curl

# Install PHP packages
RUN apk --no-cache add \
    php82 \
    php82-phar \
    php82-opcache \
    php82-ctype \
    php82-curl \
    php82-dom \
    php82-iconv \
    php82-intl \
    php82-mbstring \
    php82-pdo_mysql \
    php82-pdo_sqlite \
    php82-openssl \
    php82-redis \
    php82-session \
    php82-zip \
    php82-zlib \
    php82-sqlite3 \
    php82-gd \
    php82-xml \
    php82-xmlreader \
    php82-simplexml \
    php82-xmlwriter \
    php82-fileinfo \
    php82-tokenizer \
    php82-sockets \
    php82-pcntl \
    php82-sodium \
    php82-fpm

RUN ln -s /usr/bin/php82 /usr/bin/php
WORKDIR /srv

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --from=composer:2 --link /usr/bin/composer /usr/bin/composer

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.* ./
RUN set -eux; \
	composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress; \
	composer clear-cache

# copy sources
COPY --link . .

FROM node:18-alpine AS assets_build
WORKDIR /srv

COPY package.json .
COPY yarn.lock .

RUN yarn install
COPY --from=base /srv .
RUN yarn build


FROM base

# nginx
COPY --link docker/nginx.conf /etc/nginx/nginx.conf
# php
COPY --link docker/fpm-pool.conf /etc/php82/php-fpm.d/www.conf
COPY --link docker/php.ini /etc/php82/conf.d/custom.ini
# supervisord
COPY --link docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# docker
COPY --link docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD curl --silent --fail http://127.0.0.1/fpm-ping
ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

COPY --from=assets_build /srv/public/build ./public
RUN rm -Rf docker/

RUN set -eux; \
	composer dump-autoload --optimize --no-dev; \
	chmod +x artisan; sync

RUN chmod -R 777 bootstrap storage public

RUN chown -R nobody.nobody /run && \
    chown -R nobody.nobody /var/lib/nginx && \
    chown -R nobody.nobody /var/log/nginx

VOLUME /srv/storage
# Switch to use a non-root user from here on
USER nobody
