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

```
Não sei kkkk
```

Then run this command to turn on the dev env:

For the first time

```
docker compose up --build -d
```

All the other times

```
docker compose up -d
```
