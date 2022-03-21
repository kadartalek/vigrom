#!/usr/bin/env bash

if [ -z "$1" ]; then
  echo "DATABASE Password is unset: required as parameter"
  exit;
fi

password=$1

add-apt-repository -y ppa:ondrej/php
apt-get -y update
apt-get install -y php8.1-fpm php8.1-cli php8.1-intl php8.1-curl php8.1-gd php8.1-mbstring php8.1-xml php8.1-bcmath unzip nginx php-xdebug

cat <<EOF >/etc/php/8.1/mods-available/xdebug.ini
zend_extension=xdebug.so
xdebug.remote_enable=1
xdebug.remote_connect_back=1
xdebug.remote_port=9000
xdebug.remote_autostart=1
EOF

rm /etc/nginx/sites-enabled/default
ln -s /app/vagrant/nginx/app.conf /etc/nginx/sites-enabled/app.conf

echo "deb http://apt.postgresql.org/pub/repos/apt $(lsb_release -cs)-pgdg main" >/etc/apt/sources.list.d/pgdg.list
wget --quiet -o - https://www.postgresql.org/media/keys/accc4cf8.asc | apt-key add -
apt-get -y update
apt-get -y install postgresql-14

sudo -iu postgres psql <<<"CREATE USER \"yii2_user\" WITH ENCRYPTED PASSWORD '$password'"
sudo -iu postgres psql <<<"CREATE USER \"yii2_user_test\" WITH ENCRYPTED PASSWORD '$password'"

sudo -iu postgres psql -a -f /app/databases.sql

sudo -iu postgres psql -d yii2 -a -f /app/UUID_v7_for_Postgres.sql
sudo -iu postgres psql -d yii2_test -a -f /app/UUID_v7_for_Postgres.sql

cd /
mkdir app
cd app || exit

touch env.php

echo '<?php' >> env.php
echo '' >> env.php
echo "defined('DB_HOST') || define('DB_HOST', '127.0.0.1');" >> env.php
echo "defined('DB_PASSWORD') || define('DB_PASSWORD', '$password');" >> env.php
echo '' >> env.php
echo "defined('DB_HOST') || define('DB_HOST', '127.0.0.1');" >> env.php
echo "defined('DB_HOST') || define('DB_HOST', '127.0.0.1');" >> env.php
