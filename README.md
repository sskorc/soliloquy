# Soliloquy

Yet another PHP pet project

## Running

You have to have Docker and docker-compose installed.

1. Run the environment
```
docker-compose up -d
```

2. Get into the bash
```
docker exec -it soliloquy_web_1 bash
```

3. Install dependencies
```
composer install -n
```
