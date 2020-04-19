## S3 downloader

### Installation
```
composer require alaaelgndy/s3-fucker
```

### Usage
- Run php artisan vendor:publish then publish(Elgndy\S3Fucker\S3FuckerServiceProvider)
- Configure the urls and the folder path in the storage directory using (config/elgndy_s3_fucker).
- Run php artisan elgndy:s3-fucker

### Hint
it can be used for any public files even if not on s3.