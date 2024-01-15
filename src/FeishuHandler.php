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
use Monolog\LogRecord;

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

    protected function write(LogRecord $record): void
    {
        $record = $record->toArray();
        $title = $record['message'];
        unset($record['message'], $record['formatted']);

        $traces = $record['context'];
        $contents = [];
        foreach ($traces as $item) {
            $contents[] = [
                'tag' => 'text',
                'text' => json_encode($item, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES),
            ];
        }
        $data = [
            'msg_type' => 'post',
            'content' => [
                'post' => [
                    'zh_cn' => [
                        'title' => $title,
                        'content' => [
                            $contents,
                        ],
                    ],
                ],
            ],
        ];

        $res = (new Client())->post($this->webhook, [
            'http_errors' => false,
            'headers' => ['Content-Type: application/json']，
            'body' => json_encode($data),
        ]);
    }
}
