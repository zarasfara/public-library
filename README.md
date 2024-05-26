# Public library

## deployment

Clone the repo locally:

```shell
git clone git@github.com:zarasfara/public-library.git
```

run this command

```shell
make init
```

Set credentials in .env

Run this command to build containers:

```shell
docker compose up -d --build
```

next you have to run this command and copy container id with php-fpm:

```shell
docker ps
```

then run:

```shell
docker exec -it <container-id> make run
```

the server is available at http://localhost:50000/

Admin user:
1. name - eugene
2. email - oev2001@gmail.com
3. password - password
