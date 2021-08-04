# yii2-region-id

**Indonesia regional & postcode database as Yii2 Extension**

Database based on Minister of Home Affairs Regulation (Permendagri no 39 tahun 2015).


Installation
---------

    composer require fredyns/yii2-region-id:"@dev"

Config
-----------

in web.php or common.php to activate module
```php
    'modules' => [
        'region' => [
            'class' => 'fredyns\region\Module',
        ],
    ],
```

in console.php
```php
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'fredyns\region\migrations',
            ],
        ],
    ],
```

Migration
----------

```
yii migrate
```
if you config console.php properly in latest yii, it will detect migration inside vendor folder

Usage
----------

Open address `/region`

Try address form, new region will be added automatically.


Thanks
----------
[database daerah by cahyadsn](https://github.com/cahyadsn/daerah)
[kodepos by edwinkun](https://github.com/edwinkun/database-kodepos-seluruh-indonesia)


created by [fredyns](http://fredyns.net)
