FROM alpine:edge

RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/main" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
    apk add --no-cache bash \
        php7 \
        php7-mysqli \
        php7-session \
        ca-certificates \
        php7-pear \
        php7-dev \
        autoconf \
        build-base && \
    rm -rf /var/cache/apk/*

RUN pecl install xdebug

RUN echo "zend_extension=/usr/lib/php7/modules/xdebug.so" > /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=1" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_cookie_expire_time=86400" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_host=172.17.0.1" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=1" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.profiler_enable=0" >> /etc/php7/conf.d/xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /etc/php7/conf.d/xdebug.ini

RUN apk del php7-pear php7-dev autoconf build-base

EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "/simple-login/public"]
