# Online FTP / Amazon S3 Filebrowser 
[![Build Status](https://travis-ci.org/OFFLINE-GmbH/Online-FTP.svg?branch=master)](https://travis-ci.org/OFFLINE-GmbH/Online-FTP)

Simple file browser built with Laravel and Vue.

## Installation

1. Clone this repository to your machine.
1. `composer install`
1. `yarn` or `npm install`
1. `gulp` or `gulp --production`

### Max upload size

Make sure to restrict the maximum upload size in your php config as well as in the `.env` file.

### Filesystem cleanup
Setup a cronjob to remove old files from your filesystem or trigger it manually.

```
php artisan onlineftp:cleanup
```

See https://laravel.com/docs/5.3/scheduling#introduction on how to setup the task scheduler cronjob.
