# Test task for SOK

## Requirements
* Php 7.3
* Mysql or MariaDB, one of the last versions
* Composer

## Setup
* Set **public** folder as DocumentRoot and make sure that web-server redirects all requests to index.php, e.g. the following settings will work on Apache2:
    ```
    ServerName localhost
    DocumentRoot /var/www/html/sok/public
    DirectoryIndex /index.php
    <Directory /var/www/html/sok/public>
        AllowOverride None
        Order Allow,Deny
        Allow from All
        FallbackResource /index.php
    </Directory>
    ```
* Clone repo
* Run `composer install`
* Open [App/Config.php](App/Config.php) and enter your database configuration data.
* Run dump.sql in database console

## Run app
* http://localhost - start-up page
* test credentials - username "admin", password "admin"
