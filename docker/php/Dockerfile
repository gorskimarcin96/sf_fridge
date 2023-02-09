FROM php:8.2-apache

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
      git \
      unzip \
      libzip-dev \
      libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install \
      pgsql \
      pdo \
      pdo_pgsql \
    && rm -rf /tmp/* \
    && rm -rf /var/list/apt/* \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

#git
RUN apt-get update && apt-get upgrade -y && apt-get install -y git

#composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
