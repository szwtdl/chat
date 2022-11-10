<?php

declare(strict_types=1);
/**
 * This file is part of szwtdl/chat
 * @link     https://www.szwtdl.cn
 * @contact  szpengjian@gmail.com
 * @license  https://github.com/szwtdl/chat/blob/master/LICENSE
 */
namespace Szwtdl\Chat\Server;

interface InterfaceServe
{
    public function check();

    public function stop();

    public function status();

    public function reload();

    public function restart();

    public function start();
}
