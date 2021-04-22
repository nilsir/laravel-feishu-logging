<?php

/*
 * This file is part of the nilsir/laravel-feishu-logging.
 *
 * (c) nilsir <nilsir@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Nilsir\LaravelFeishuLogging;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Class FeishuLoggerServiceProvider.
 */
class FeishuLoggerServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     */
    public function register()
    {
        $path = __DIR__ . '/config/feishu-logger.php';
        $this->mergeConfigFrom($path, 'feishu-logger');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $path = __DIR__ . '/config/feishu-logger.php';
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$path => config_path('feishu-logger.php')], 'feishu-logger.php');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('feishu-logger');
        }
        $this->mergeConfigFrom($path, 'feishu-logger');
    }
}
