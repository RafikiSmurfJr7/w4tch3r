# ![W4TCH3R](./public/img/w4tc3r_logo.svg)

## Development environment configuration

### Requirements

In order to create the dev env you need to have docker engine installed:

First we need to setup the `.env` file, to do so you need to copy the information from the example, like:

Linux

```
cp .env.example .env
```

Windows

    In CMD:

```
copy .env.example .env
```

    In PowerShell:

```
Copy-Item .env.example .env
```

Then run this command to turn on the dev env:

```
docker compose up --watch
```

To run commands inside the docker container run:

```
docker compose exec <container_name> <command>
```

example:

```
docker compose exec web ls
```

a command that is necessary to install all dependencies is:

```
docker compose exec symfony composer update
```

it is important to use the `symfony-cli` for this to work. Default composer is not installed on the container.

The web server will run on port `8000`, you can access it by going to the address `http://127.0.0.1:8000`

## phpMyAdmin

There is also a phpMyAdmin service running on port `8888` to access it you need to go to the address `http://127.0.0.1:8888` and login with the following credentials

> Server: `<leave_empty>`  
> Usename: user  
> Password: pass

After that you can manage the database for the project, the default name is `database`.
