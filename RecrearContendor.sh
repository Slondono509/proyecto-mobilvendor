docker-compose down
#docker image rm -f $(docker image ls -q)
docker-compose up -d
docker ps
docker exec proyecto-mobilvendor-php-1 composer dump
