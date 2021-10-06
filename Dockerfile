FROM php:7.3-apache
WORKDIR  /webServeur
CMD [ "php", "-S", "0.0.0.0:3000", "/webServeur/public" ]