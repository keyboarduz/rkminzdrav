<?php

$db_local = require __DIR__ . '/db_local.php';

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname='.$db_local['db_database'],
    'username' => $db_local['db_user'],
    'password' => $db_local['db_password'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
//    'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
