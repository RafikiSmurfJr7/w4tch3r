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
