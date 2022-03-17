<?php

require __DIR__ . '/../init.php';
$config = \app\config\web\Web::cfg();

(new yii\web\Application($config))->run();
