# XiangFang

http://tonyyang924.tk:1337/

<img src="screenshots/output.gif" />

## Setup environment

### Build docker images

```
$ cd docker/apache-php5.6-postgres/
docker build -t php:5.06apache_postgres .

$ cd ../ubuntu14.04-postgres/
docker build -t ubuntu:14.04postgres .
```
### Run dockers

PostgreSQL
```
$ docker run -d -p 5432:5432 --name psql_xiangfang ubuntu:14.04postgres
```

Apache PHP5.6
```
$ docker run -p 1337:80 -v $PWD:/var/www/html -e DBUSER=docker -e DBPASS=docker -e DBPORT=5432 -e DBNAME=docker -e DBHOST=psql_xiangfang --link psql_xiangfang --name php_xiangfang -d php:5.06apache_postgres
```

### Insert SQL

```
$ docker cp xiangfang.sql psql_xiangfang:/xiangfang.sql
$ docker cp gb/20121109psql.sql psql_xiangfang:/20121109psql.sql
$ docker exec -it psql_xiangfang env LANG=C.UTF-8 /bin/bash
$ psql -d docker < xiangfang.sql
$ psql -d docker < 20121109psql.sql
```

### Open website in browser

[http://localhost:1337/](http://localhost:1337/)

### Reload

just stop and remove then run docker again.

```
$ docker stop psql_xiangfang && docker rm psql_xiangfang
$ docker run -d -p 5432:5432 --name psql_xiangfang ubuntu:14.04postgres

$ docker stop php_xiangfang && docker rm php_xiangfang
$ docker run -p 1337:80 -v $PWD:/var/www/html -e DBUSER=docker -e DBPASS=docker -e DBPORT=5432 -e DBNAME=docker -e DBHOST=psql_xiangfang --link psql_xiangfang --name php_xiangfang -d php:5.06apache_postgres
```

# References
https://qiita.com/cyclon2joker/items/39e620d3d16fa1f6edf0