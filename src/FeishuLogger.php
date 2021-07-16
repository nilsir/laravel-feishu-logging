<?php

/*
 * This file is part of the nilsir/laravel-feishu-logging.
 *
 * (c) nilsir <nilsir@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Nilsir\LaravelFeishuLogging;

use Monolog\Formatter\NormalizerFormatter;
use Monolog\Logger;

/**
 * Class FeishuLogger.
 */
class FeishuLogger
{
    /**
     * Create a custom Monolog instance.
     */
    public function __invoke(array $config): Logger
    {
        $feishuHandler = new FeishuHandler();
        $feishuHandler->setBubble($config['bubble'] ?? true);
        $feishuHandler->setLevel($config['level'] ?? 'debug');
        $dateFormat = $config['date_format'] ?? config('feishu-logger.date_format');
        $feishuHandler->setFormatter(
            new NormalizerFormatter($dateFormat)
        );
        $token = $config['token'] ?? config('feishu-logger.token');
        $feishuHandler->setWebhook('https://open.feishu.cn/open-apis/bot/v2/hook/'.$token);

        return new Logger(config('app.name'),
            [$feishuHandler]
        );
    }
}
