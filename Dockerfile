FROM registry.gitlab.com/traderfour-devops/azpayz-core-base-image:main

ADD ./.ci/conf/laravel.ini /usr/local/etc/php/conf.d

WORKDIR /var/www/app
COPY ./composer.json ./composer.lock* ./

RUN composer install --no-scripts --no-autoloader --ansi --no-interaction

# copy nginx configuration
COPY ./.ci/conf/nginx.conf /etc/nginx/nginx.conf
COPY ./.ci/conf/default-nginx.conf /etc/nginx/conf.d/default.conf

# copy supervisord configuration
COPY ./.ci/conf/supervisord.conf /etc/supervisord.conf
COPY ./.ci/conf/docker-entrypoint.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/docker-entrypoint.sh
RUN ln -s /usr/local/bin/docker-entrypoint.sh /

COPY . .
RUN composer dump-autoload -o \
    && chown -R :www-data /var/www/app \
    && chmod -R 775 /var/www/app/storage /var/www/app/bootstrap/cache

RUN php artisan cache:clear

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
