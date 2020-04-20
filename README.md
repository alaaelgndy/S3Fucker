# S3 downloader

## Installation

You can install it via composer:
```bash
composer require alaaelgndy/s3-fucker
```
and the package will automatically register itself.

Then publish config files
```bash
php artisan vendor:publish --provider="Elgndy\S3Fucker\S3FuckerServiceProvider"
```

The content of the published config file:
```php
<?php

return [
    'folder_name' => 'course/', // that means you will find the dowloads in storage/app/downloads/course
    'urls' => [
      // urls to download
    ],
];
```
Add your links in `urls` to be downloaded.


## Usage
Run the `s3-fucker`:
```bash
php artisan elgndy:s3-fucker
```

## Hint
it can be used for any public files even if not on s3.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
