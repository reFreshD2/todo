FROM php:7.4-fpm-alpine3.12

ARG XDEBUG_VERSION=2.9.8
ARG PHP_EXTENSIONS="dom exif gd iconv intl json mysqli opcache pdo_mysql pdo_sqlite soap xsl zip"

RUN apk add --update \
		acl \
		apk-cron \
		augeas-dev \
		autoconf \
		bash \
		curl \
		ca-certificates \
		dialog \
		freetype-dev \
		gomplate \
		git \
		gcc \
		icu-dev \
		libcurl \
		libffi-dev \
		libgcrypt-dev \
		libjpeg-turbo-dev \
		libmcrypt-dev \
		libpng-dev \
		libpq \
		libressl-dev \
		libxslt-dev \
		libzip-dev \
		linux-headers \
		make \
		musl-dev \
		mysql-client \
		nginx \
		openssh-client \
		ssmtp \
		sqlite-dev \
		supervisor \
		su-exec \
		wget \
		gnu-libiconv \
		&& \
	docker-php-ext-configure gd \
		--with-gd \
		--with-freetype-dir=/usr/include/ \
		--with-png-dir=/usr/include/ \
		--with-jpeg-dir=/usr/include/ \
		--enable-option-checking \
		--with-freetype \
		--with-jpeg && \
	docker-php-ext-install $PHP_EXTENSIONS && \
	git clone -b $XDEBUG_VERSION https://github.com/xdebug/xdebug.git /tmp/xdebug && \
	cd /tmp/xdebug && phpize && ./configure --enable-xdebug && make && make install && cd - && \
	rm -rf /tmp/xdebug && \
	docker-php-source delete && \
	apk del gcc musl-dev linux-headers libffi-dev augeas-dev make autoconf && \
	rm -rf /var/cache/apk/*

COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer

VOLUME /srv/todo
WORKDIR /srv/todo

CMD ["php-fpm"]

