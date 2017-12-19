#!/bin/bash

DOCKER=$(which docker)

echo -e "Building php image...";

( cd php-docker && $DOCKER build -t simple-crud:0.1 . )

echo -e "Starting Mysql Server...";

$DOCKER run --name db-server -d \
 -v $PWD/db-data:/var/lib/mysql -e 'DB_USER=homestead' -e 'DB_PASS=homestead' -e 'DB_NAME=homestead' \
  sameersbn/mysql:latest ;

 
echo -e "Starting PHP Server...";

$DOCKER run --rm -it --name php \
-p 80:8888 --link db-server:db-server  \
-v $(pwd)/src:/opt \
simple-crud:0.1 \
php -S 0.0.0.0:8888 -t /opt/public

