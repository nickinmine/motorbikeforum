# Test run commands
docker build --rm -t motorbikeforum-mysql .
docker run --rm --detach --name=motorbikeforum-mysql --publish 3307:3306 motorbikeforum-mysql

