<?php

use DI\Container;
use FreightQuote\User\FlatFileUserRepository;
use FreightQuote\User\UserRepository;

$container = new Container([
    UserRepository::class => FlatFileUserRepository::class,
]);

return $container;
