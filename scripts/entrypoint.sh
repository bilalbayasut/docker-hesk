#!/bin/bash
apt update && apt install php php-mysql mariadb-server -y
service mariadb start
mariadb --user=root --execute="CREATE DATABASE hesk;"
php -S 0.0.0.0:8000
