<?php

/*
 * This file is part of the nilsir/laravel-feishu-logging.
 *
 * (c) nilsir <nilsir@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Nilsir\LaravelFeishuLogging;

use GuzzleHttp\Client;
use Monolog\Handler\AbstractProcessingHandler;

/**
 * Class FeishuHandler.
 */
class FeishuHandler extends AbstractProcessingHandler
{
    protected $webhook;

    public function setWebhook(string $webhook): void
    {
        $this->webhook = $webhook;
    }

    protected function write(array $record): void
    {
        $title = $record['message'];
        unset($record['message'], $record['formatted']);
        $text = json_encode($record, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);
        (new Client())->post($this->webhook, [
            'http_errors' => false,
            'headers' => ['Content-Type: application/json'],
            'body' => json_encode(['title' => $title, 'text' => $text]),
        ]);
    }
}
