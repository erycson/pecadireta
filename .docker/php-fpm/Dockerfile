FROM bref/extra-redis-php-81 as redisextra
FROM bref/extra-gd-php-81 as gdextra
FROM bref/extra-sqlsrv-php-81 as sqlsrvextra
FROM bref/php-81-console as console
FROM bref/php-81-fpm-dev
WORKDIR "/var/task"

COPY --from=gdextra /opt /opt
COPY --from=redisextra /opt /opt
COPY --from=sqlsrvextra /opt /opt
COPY --from=sqlsrvextra /opt/microsoft/conf/odbcinst.ini /etc/odbcinst.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

COPY vendor /var/task/vendor
