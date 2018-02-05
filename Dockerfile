FROM wordpress:4-php7.1-apache

COPY --chown=www-data:www-data ./dist /var/www/html/wp-content/themes/ifrs-ps-theme
