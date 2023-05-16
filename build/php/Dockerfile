FROM php:8.1-apache
RUN a2enmod rewrite
WORKDIR /var/www
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get install -y \
        make


RUN apt-get update && apt-get install -y \
    software-properties-common \
    npm
RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip








CMD ["apache2-foreground"]
