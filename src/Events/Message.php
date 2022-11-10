<?php

declare(strict_types=1);
/**
 * This file is part of szwtdl/chat
 * @link     https://www.szwtdl.cn
 * @contact  szpengjian@gmail.com
 * @license  https://github.com/szwtdl/chat/blob/master/LICENSE
 */
namespace Szwtdl\Chat\Events;

use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class Message
{
    public static function open(Server $server, Request $request)
    {
        echo "server: handshake success with fd{$request->fd}\n";
    }

    public static function message(Server $server, Frame $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $server->push($frame->fd, 'this is server');
    }

    public static function close(Server $server, $fd)
    {
        echo "client {$fd} closed\n";
    }
}
