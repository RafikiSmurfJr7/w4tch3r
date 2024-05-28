# ![W4TCH3R](./assets/img/w4tc3r_logo.svg)

## Development environment configuration

### Requirements

In order to create the dev env you need to have a web stack such as:

- LAMP
- WAMP
- MAMP

In most cases you can use [XAMPP](https://www.apachefriends.org/), if you are in Linux you probably want to use a LAMP.

The software you need to have installed is:

- PHP (>=7.4)
- Apache
- MySQL or MariaDB
- Composer
- Git

### Configure Database

Import the SQL dump (`assets/sql_w4tch3r_pt_dump.sql`)

From the comand line you can do:

```
mariadb -u <username> -p sql_w4tch3r_pt < assets/sql_w4tch3r_pt_dump.sql
```

### Run server

You can use either PHP or Apache to run the dev server

PHP: `php -S localhost:<port>`
ex: `php -S localhost:8080`

With the comand above the server will run on port 8080 at the address http://localhost:8080

## Credentials

The dump contains the following credentials

| Users          | Username | Password |
| -------------- | -------- | -------- |
| Admininstrator | admin    | admin    |
