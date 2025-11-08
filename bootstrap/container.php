<?php

use DI\Container;
use FreightQuote\Carrier\CarrierRepository;
use FreightQuote\Carrier\FlatFileCarrierRepository;
use FreightQuote\User\FlatFileUserRepository;
use FreightQuote\User\UserRepository;
use DI;

$container = new Container([
    UserRepository::class => DI\create(FlatFileUserRepository::class),
    CarrierRepository::class => DI\create(FlatFileCarrierRepository::class),
]);

return $container;
