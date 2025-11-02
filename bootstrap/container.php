<?php

use DI\Container;
use FreightQuote\User\FlatFileUserRepository;
use FreightQuote\User\UserRepository;
use DI;

$container = new Container([
    UserRepository::class => DI\create(FlatFileUserRepository::class),
]);

return $container;
