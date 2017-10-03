FROM alpine:edge

RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/main" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
    apk add --no-cache bash \
        curl \
        php7 \
        php7-mysqli \
        ca-certificates && \
    rm -rf /var/cache/apk/*

EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "/simple-login/public"]
