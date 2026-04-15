<?php

declare(strict_types=1);

namespace common\modules\notifications\services\notifiers;

use Yii;
use yii\httpclient\Client;

final class TelegramNotifier implements NotifierInterface
{
    private string $botToken;
    /** @var int[] */
    private array $chatIds;

    /**
     * @param string $botToken  токен бота без "bot" в начале URL
     * @param int[]  $chatIds   список chat_id
     */
    public function __construct(string $botToken, array $chatIds)
    {
        $this->botToken = $botToken;
        $this->chatIds  = $chatIds;
    }

    public function notify(string $message): void
    {
        if ($this->botToken === '' || empty($this->chatIds)) {
            Yii::warning('Telegram notifier misconfigured: token or chatIds empty', __METHOD__);
            return;
        }

        $client = new Client([
            'baseUrl' => 'https://api.telegram.org',
        ]);

        foreach ($this->chatIds as $chatId) {
            try {
                $response = $client->post("bot{$this->botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text'    => $message,
                ])->send();

                if (!$response->isOk) {
                    Yii::warning('Telegram sendMessage failed: ' . $response->content, __METHOD__);
                }
            } catch (\Throwable $e) {
                Yii::warning('Telegram exception: ' . $e->getMessage(), __METHOD__);
            }
        }
    }
}
