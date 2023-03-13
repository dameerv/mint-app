<?php

namespace App\Command;

use App\Websocket\Websocket;
use Ratchet\Http\HttpServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class StartWebsocketServerAdminsCommand extends Command
{
    protected static $defaultName = 'app:websockets:start';
    protected static $defaultDescription = 'Запуск вебсокет сервера';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Старт websocket сервера.');
        $output->writeln('Для остановки нажмите CRL+C');
        $output->writeln('-----------------------------------');
        $output->writeln('');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Websocket()
                )
            ),
            10000
        );

        $output->writeln('Порт ' . $server->socket->getAddress()) . PHP_EOL;
        $server->run();
        return self::SUCCESS;
    }

}
