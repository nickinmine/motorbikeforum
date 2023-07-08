docker build --rm -t motorbikeforum-php .
docker run --rm --detach --name=motorbikeforum-php --publish 8080:80 motorbikeforum-php

