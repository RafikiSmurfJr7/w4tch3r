FROM php:8.2-cli

COPY . /app
WORKDIR /app

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash

RUN apt-get update && apt-get install -y \
    symfony-cli

EXPOSE 8000
CMD [ "symfony", "serve" , "--port=8000" ]
