# Biagini Migration

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat)](https://php.net/)

A library to handle migrations of data from your database. It uses and provides migrations with instances of doctrine dbal, giving greater flexibility to the developer. It uses the symfony console, which enables friendly and iterative help. 

## Setting.

1) Create a file in your personal project with whatever name you prefer:

Ex: example.php

```php
<?php

declare(strict_types=1);

use AliceMigration\Management\Configuration\Configuration;
use AliceMigration\Migration\Migration;

#Path where your migration classes will be created
$pathMigrations = "/path/";

#Namespace that your migration classes meet, use the path namespace that you previously defined.
$namespace = 'PathNamespace';

#Here it can be customized because the configuration class expects an instance of the PDO
$pdo = new PDO('mysql:host=your_hostname;dbname=your_db;charset=UTF-8', $user, $pass);

#Creating the migration command console
$migration = new Migration(new Configuration($pdo, $pathMigrations, $namespace));
$migration->run();
```

2) Now your newly created file has become a central data migration command, to access the terminal type:

```shell
php example.php
```

## Creating a Data Migration.

This migration command offers the possibility to add commands and sql statements using Doctrine's Dbal. To generate a class of data migration you must enter the following command in the terminal:

```shell
php example.php migrate:create
```

After you run the command, a class is created in the path that you have defined in the settings. Now edit the created class and add the instructions you need for your data migration.

## Running the migrations that were created.

To run your migration classes, you need to run the following command on your terminal:

```shell
php example.php migrate:run
```

For more information on the optional parameters of this command, run the command with the --help end on your terminal. Ex:

```shell
php example.php migrate:run --help
```

## Reverting a migration.

To roll back a migration or roll the rollback that you set, run the following command on your terminal:

```shell
php example.php migrate:revert <filename>
```

* filename is the class name of your data migration.

Ex: 

```shell
php example.php migrate:revert MigrateVersion1546978382.php
```

For more information on the optional parameters of this command, run the command with the --help end on your terminal. Ex:

```shell
php example.php migrate:revert --help
```

Author:
* [@matheusbiagini](https://github.com/matheusbiagini)

Enjoy it :)