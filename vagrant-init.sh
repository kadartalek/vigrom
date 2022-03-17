#!/usr/bin/env bash

if [ -z "$1" ]; then
  echo "Server is unset. Must me like  192.168.56.2"
  exit;
fi

scp -r "${HOME}/.ssh" "root@${1}:/root/.ssh"
