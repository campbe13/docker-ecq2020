#!/usr/bin/env bash

# https://github.com/docker-library/wordpress/issues/293
# EXPOSE does not work for heroku
# $PORT used instead 

sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf
