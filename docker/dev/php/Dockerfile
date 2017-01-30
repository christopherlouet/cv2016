FROM php:7-fpm

RUN apt-get update

############################
# PHP Core Extensions      #
############################

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libicu-dev \
        libpq-dev \
        libbz2-dev \
        git \
    && docker-php-ext-install -j$(nproc) iconv intl mcrypt opcache pdo_pgsql mbstring bz2 json zip exif \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

############################
# PECL extensions          #
############################

# distributed memory caching system : more than one web-server for the site
#RUN apt-get update && apt-get install -y libmemcached-dev \
#    && pecl install memcached \
#    && docker-php-ext-enable memcached

# debug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

############################
# Tools                    #
############################

# install gosu
ENV GOSU_VERSION 1.9
RUN set -x \
    && apt-get update && apt-get install -y --no-install-recommends ca-certificates wget && rm -rf /var/lib/apt/lists/* \
    && dpkgArch="$(dpkg --print-architecture | awk -F- '{ print $NF }')" \
    && wget -O /usr/local/bin/gosu "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch" \
    && wget -O /usr/local/bin/gosu.asc "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch.asc" \
    && export GNUPGHOME="$(mktemp -d)" \
    && gpg --keyserver ha.pool.sks-keyservers.net --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4 \
    && gpg --batch --verify /usr/local/bin/gosu.asc /usr/local/bin/gosu \
    && rm -r "$GNUPGHOME" /usr/local/bin/gosu.asc \
    && chmod +x /usr/local/bin/gosu \
    && gosu nobody true \
    && apt-get purge -y --auto-remove ca-certificates wget

############################
# Local User               #
############################

ARG UID
ARG GID
ARG USERNAME
ARG GROUPNAME

ENV GROUP_NAME php
ENV USER_NAME php
RUN groupadd $GROUP_NAME -g $GID \
    && useradd -g $GID -u $UID --create-home $USER_NAME

############################
# Project directory        #
############################

ENV SYMFONY_DIR /var/www/docker-symfony
WORKDIR ${SYMFONY_DIR}
