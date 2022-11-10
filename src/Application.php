<?php

declare(strict_types=1);
/**
 * This file is part of szwtdl/chat
 * @link     https://www.szwtdl.cn
 * @contact  szpengjian@gmail.com
 * @license  https://github.com/szwtdl/chat/blob/master/LICENSE
 */
namespace Szwtdl\Chat;

use Szwtdl\Chat\Server\InterfaceServe;

class Application
{
    protected object $serve;

    protected array $options = [];

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function run($className): self
    {
        global $argv;
        if (! class_exists($className)) {
            throw new \Exception("className {$className} Error");
        }
        $this->serve = new $className($this->options);
        if ($this->serve instanceof InterfaceServe) {
            $cmd = $argv[1];
            if (isset($this->options['serve'])) {
                $cmd = $argv[2];
            }
            if (isset($cmd) && in_array($cmd, ['start', 'stop', 'status', 'restart', 'reload'])) {
                switch ($cmd) {
                    case 'stop':
                        $this->serve->stop();
                        break;
                    case 'reload':
                        $this->serve->reload();
                        break;
                    case 'restart':
                        $this->serve->restart();
                        break;
                    case 'status':
                        $this->serve->status();
                        break;
                    case 'start':
                        $this->serve->start();
                        break;
                }
            }
        }
        return $this;
    }
}
