<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $logger->pushProcessor(new UidProcessor());

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        PDO::class => function(ContainerInterface $c) {
            $settings = $c->get('settings');

            $databaseSettings = $settings['database'];
            return new PDO(
                "{$databaseSettings['wording_cms']['driver']}:dbname={$databaseSettings['wording_cms']['database']};host={$databaseSettings['wording_cms']['host']};port={$databaseSettings['wording_cms']['port']}",
                $databaseSettings['wording_cms']['username'],
                $databaseSettings['wording_cms']['password']
            );
        },
    ]);
};
