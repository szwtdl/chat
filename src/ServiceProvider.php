<?php

declare(strict_types=1);
/**
 * This file is part of szwtdl/chat
 * @link     https://www.szwtdl.cn
 * @contact  szpengjian@gmail.com
 * @license  https://github.com/szwtdl/chat/blob/master/LICENSE
 */
namespace Szwtdl\Chat;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Szwtdl\Chat\Server\Websocket;

class ServiceProvider extends BaseServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->setupConfig();
        $this->app->singleton(Application::class, function () {
            $options = config('chat');
            return (new Application())->setOptions($options)->run(Websocket::class);
        });
        $this->app->alias(Application::class, 'chat');
    }

    public function provides()
    {
        return [Application::class, 'chat'];
    }

    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/chat.php');
        if ($this->app->runningInConsole()) {
            $this->publishes([$source => \config_path('chat.php')], 'chat');
        }
        $this->mergeConfigFrom($source, 'chat');
    }
}
