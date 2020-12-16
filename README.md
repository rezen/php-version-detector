# php-version-detector
Detect PHP version code needs to run. Run code through ast and checks 
features/functions used.

## Requirements
- php7.x
- php extenion ast `github.com/nikic/php-ast`


```sh
docker build -t php-version-detector .
docker run -t --rm -v $(pwd):/app php-version-detector /app/tests/ast-feed.php
```


## 

## Resources
- https://blog.madewithlove.be/post/thread-carefully/
