FROM php:7-alpine
RUN apk add --update --no-cache bash php7-mysql
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "/simple-login/public"]
