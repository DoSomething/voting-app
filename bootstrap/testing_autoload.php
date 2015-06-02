<?php

/**
 * We want to migrate and seed the testing database when
 * bootstrapping the testing environment. We do that here,
 * before starting our test suite.
 */
passthru("php artisan --env='testing' migrate --seed");

/**
 * Pass control to the standard autoload script.
 */
require __DIR__ . '/autoload.php';
