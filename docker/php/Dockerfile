FROM php:8.2-fpm

RUN apt-get update && apt install bash \
	vim -y

RUN apt-get install -y libpq-dev  \
    zip \
    unzip && \
    docker-php-ext-install pdo pdo_pgsql pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer

#RUN pecl install xdebug \
#    && docker-php-ext-enable xdebug
#
#RUN pecl install xhprof \
#    && docker-php-ext-enable xhprof

WORKDIR ${PROJECT_DIR}
