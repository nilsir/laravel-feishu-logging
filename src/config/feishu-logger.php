<?php

/*
 * This file is part of the nilsir/laravel-feishu-logging.
 *
 * (c) nilsir <nilsir@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

return [
    /*
     * a part of Feishu Webhook url
     * if your Webhook is https://open.feishu.cn/open-apis/bot/hook/xxxxxxxxxxxxxxxxxxxxxxxxxxx
     * token : 'xxxxxxxxxxxxxxxxxxxxxxxxxxx'
     * @link https://getfeishu.cn/hc/zh-cn/articles/360024984973-%E6%9C%BA%E5%99%A8%E4%BA%BA-%E5%A6%82%E4%BD%95%E5%9C%A8%E7%BE%A4%E8%81%8A%E4%B8%AD%E4%BD%BF%E7%94%A8%E6%9C%BA%E5%99%A8%E4%BA%BA-#%E4%BD%BF%E7%94%A8%E6%9C%BA%E5%99%A8%E4%BA%BA
     *
     */
    'token' => env('FEISHU_LOGGER_BOT_TOKEN', 'YOUR-CUSTOM-BOT-TOKEN'),
    'date_format' => 'Y-m-d H:i:s.u',
];
