FROM php:8.2-cli

COPY . /app
WORKDIR /app

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN apt-get update && apt-get install -y \
    symfony-cli \
    unzip

RUN install-php-extensions pdo_mysql intl gd


EXPOSE 8000
CMD [ "symfony", "serve" , "--port=8000" ]
