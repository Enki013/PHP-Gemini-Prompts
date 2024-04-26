FROM mysql:latest

ENV MYSQL_ROOT_PASSWORD=dtbspss

COPY init.sql /docker-entrypoint-initdb.d/