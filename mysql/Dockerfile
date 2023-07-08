FROM mysql:8.0
COPY . /docker-entrypoint-initdb.d
ENV MYSQL_ROOT_PASSWORD root
ENV allowPublicKeyRetrieval true
ENV TZ 'Europe/Moscow'
EXPOSE 3307

