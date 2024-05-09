# Public library

## deployment

Clone the repo locally:

```shell
git clone git@github.com:zarasfara/public-library.git
```

Run command:
```shell
make init
```

Set credentials in .env

Run this command to build containers:

```shell
docker compose up -d --build
```

In container with app run:

```shell
make run
```
```shell
php artisan migrate --seed
```

Admin user:
1. name - eugene
2. email - oev2001@gmail.com
3. password - password
