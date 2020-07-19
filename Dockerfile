FROM registry.xing99.net/base-php:v.1.2 as test-trade-api-php
RUN mkdir -p /var/www/html
COPY . /var/www/html
RUN chmod -R 777 /var/www/html/storage

FROM nginx:stable-alpine as test-trade-api-nginx
RUN mkdir -p /var/www/html
COPY . /var/www/html 
RUN chmod -R 777 /var/www/html/storage

FROM registry.xing99.net/base-php:v.1.2 as rc-trade-api-php
RUN mkdir -p /var/www/html
COPY . /var/www/html
RUN chmod -R 777 /var/www/html/storage

FROM nginx:stable-alpine as rc-trade-api-nginx
RUN mkdir -p /var/www/html
COPY . /var/www/html 
RUN chmod -R 777 /var/www/html/storage

FROM registry.xing99.net/base-php:v.1.2 as stable-trade-api-php
RUN mkdir -p /var/www/html
COPY . /var/www/html
RUN chmod -R 777 /var/www/html/storage

FROM nginx:stable-alpine as stable-trade-api-nginx
RUN mkdir -p /var/www/html
COPY . /var/www/html 
RUN chmod -R 777 /var/www/html/storage 
