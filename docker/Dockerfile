FROM php:5.6-fpm

RUN apt-get update

# git
RUN apt-get install -y git

# Install bz2
RUN apt-get install -y libbz2-dev
RUN docker-php-ext-install bz2

# Install GD
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng12-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd

# Install mbstring
RUN docker-php-ext-install mbstring

# Install mcrypt
RUN apt-get install -y libmcrypt-dev
RUN docker-php-ext-install mcrypt

# pdo pgsql
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pdo_pgsql

# Install intl
RUN apt-get install -y libicu-dev
RUN pecl install intl
RUN docker-php-ext-install intl

# install xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# opcache
RUN docker-php-ext-install opcache

# set recommended PHP.ini settings
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=60'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# libraries divers
RUN docker-php-ext-install json zip exif

# install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# install npm et node
RUN apt-get install -y wget xz-utils && \
    wget https://nodejs.org/dist/v4.4.3/node-v4.4.3-linux-x64.tar.xz && \
    tar xvf node-v4.4.3-linux-x64.tar.xz && \
    cp -rf node-v4.4.3-linux-x64 /opt/node && \
    rm -rf node-v4.4.3-linux-x64* && \
    ln -s /opt/node/bin/node /usr/local/bin/node && \
    ln -s /opt/node/bin/npm /usr/local/bin/npm && \
    npm install -g npm

# for wkhtmltopdf dependancies
#sudo apt-get install wkhtmltopdf

RUN npm install
RUN ln -s /var/www/docker-symfony/node_modules/gulp/bin/gulp.js /usr/local/bin/gulp
RUN ln -s /opt/node/lib/node_modules/bower/bin/bower /usr/local/bin/bower
RUN alias bower='bower --allow-root'
RUN bower update

WORKDIR /var/www/docker-symfony
