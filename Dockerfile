FROM php:8.2-cli

COPY . /app
WORKDIR /app

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get update && apt-get install -y \
    symfony-cli \
    unzip \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev

RUN pecl config-set php_ini "${PHP_INI_DIR}/php.ini"

RUN docker-php-ext-configure pdo_mysql
RUN docker-php-ext-configure gd
RUN docker-php-ext-configure intl

RUN pecl install xdebug-3.2.1

RUN docker-php-ext-install pdo_mysql gd intl

RUN docker-php-ext-enable xdebug pdo_mysql gd intl

COPY xdebug/99-xdebug.ini "${PHP_INI_DIR}/conf.d"

EXPOSE 8000
CMD [ "symfony", "serve" , "--port=8000" ]
