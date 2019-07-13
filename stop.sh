#!/usr/bin/env bash

docker rm -f $(docker ps -aq)

docker volume rm $(docker volume ls -q)

docker system prune -f

echo 'Docker system is clear ;) ;)'
