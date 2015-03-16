FROM sskorc/php-mongo-apache

ADD docker/vhost.conf /etc/apache2/sites-enabled/000-default.conf

