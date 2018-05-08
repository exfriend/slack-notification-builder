# slack-notification-builder
Fluent notification builder for Laravel

## Installation on Laravel 5.5+

Install package:

`composer require exfriend/slack-notification-builder`

Publish configuration:

`php artisan vendor:publish`

Edit `config/slack-notification-builder.php`

## Usage

```php

    slack( '#payday' )
        ->from( 'Cashier' )
        ->image( 'http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Cashier-2-icon.png' )
        ->send( 'Testing this' );

```

Work in progress

