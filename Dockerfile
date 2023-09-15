FROM php:8.2.6-apache-bullseye

RUN apt-get update \
    && apt-get install -y wget \
    vim \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql

RUN a2enmod rewrite \
    && service apache2 restart

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

COPY docker/php/apache/vhost/default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html/paytabs
