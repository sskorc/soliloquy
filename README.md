# Soliloquy

Yet another PHP pet project

## Running

You have to have Docker installed.

1. Build the image
```
docker build -t sskorc/soliloquy .
```

2. Run the container
```
docker run -d -P --name slq -v $(pwd):/var/www/soliloquy sskorc/soliloquy
```

3. Check container's IP address
```
docker inspect --format '{{ .NetworkSettings.IPAddress }}' slq
```

4. Get into the bash
```
docker exec -i -t slq bash
```

5. Install dependencies
```
cd /var/www/soliloquy && composer install -n
```