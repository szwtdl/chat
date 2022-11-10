<?php

declare(strict_types=1);
/**
 * This file is part of szwtdl/chat
 * @link     https://www.szwtdl.cn
 * @contact  szpengjian@gmail.com
 * @license  https://github.com/szwtdl/chat/blob/master/LICENSE
 */
namespace Szwtdl\Chat\Server;

use Swoole\WebSocket\Server;
use Szwtdl\Chat\Events\Message;

class Websocket implements InterfaceServe
{
    protected Server $serve;

    protected array $options = [
        'host' => '0.0.0.0',
        'port' => 9502,
        'event' => Message::class,
        'options' => [],
    ];

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->options, $options);
        $this->serve = new Server($this->options['host'], $this->options['port']);
        $this->serve->set($this->options['options']);
        $this->serve->on('open', [$this->options['event'], 'open']);
        $this->serve->on('message', [$this->options['event'], 'message']);
        $this->serve->on('close', [$this->options['event'], 'close']);
        return $this->serve;
    }

    public function check()
    {
        // TODO: Implement check() method.
    }

    public function start()
    {
        $this->serve->start();
    }

    public function stop()
    {
        // TODO: Implement stop() method.
    }

    public function status()
    {
        // TODO: Implement status() method.
    }

    public function reload()
    {
        // TODO: Implement reload() method.
    }

    public function restart()
    {
        // TODO: Implement restart() method.
    }
}
