FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip   

RUN curl -sS https://getcomposer.org/installer/php -- --install-dir