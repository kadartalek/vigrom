#!/usr/bin/env bash

if [ -z "$1" ]; then
  echo "Network is unset. Must me like \"192.168.56.0/24\""
  exit;
fi

sudo -iu postgres psql <<<"ALTER SYSTEM SET listen_addresses = '0.0.0.0'"
sudo -iu postgres psql <<<"SELECT pg_reload_conf()"

echo "host    all             all             $1         md5" >> /etc/postgresql/14/main/pg_hba.conf
