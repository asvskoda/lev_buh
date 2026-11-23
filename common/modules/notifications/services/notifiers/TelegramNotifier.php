<?php

declare(strict_types=1);

namespace common\modules\notifications\services\notifiers;

use Psr\Log\LoggerInterface;
use yii\httpclient\Client;
use yii\httpclient\CurlTransport;

/**
 * Отправка уведомлений в чаты Telegram через Bot API
 */
final class TelegramNotifier implements NotifierInterface
{
    private const API_BASE_URL = 'https://api.telegram.org';
    /** Лимит Bot API на длину текста сообщения, в единицах UTF-16 */
    private const MAX_MESSAGE_LENGTH = 4096;
    private const TRUNCATION_MARK = '…';
    /** Отправка идёт синхронно внутри запроса пользователя, поэтому долго не ждём */
    private const CONNECT_TIMEOUT_SECONDS = 3;
    private const REQUEST_TIMEOUT_SECONDS = 5;
    private const MASKED_TOKEN = '***';

    private string $botToken;
    /** @var int[] */
    private array $chatIds;
    private LoggerInterface $logger;

    /**
     * @param string            $botToken токен бота без префикса "bot"
     * @param array<int|string> $chatIds  идентификаторы чатов; пустые, нечисловые и повторяющиеся отбрасываются
     */
    public function __construct(
        string $botToken,
        array $chatIds,
        LoggerInterface $logger
    ) {
        $this->botToken = $botToken;
        $this->chatIds  = array_values(array_unique(array_filter(array_map('intval', $chatIds))));
        $this->logger   = $logger;
    }

    public function notify(string $message): bool
    {
        if ($this->botToken === '' || $this->chatIds === []) {
            $this->logger->warning('Telegram notifier misconfigured: token or chatIds empty');
            return false;
        }

        $client = new Client([
            'baseUrl'   => self::API_BASE_URL,
            'transport' => CurlTransport::class,
        ]);
        $text      = $this->truncate($message);
        $delivered = false;

        foreach ($this->chatIds as $chatId) {
            try {
                $response = $client
                    ->post(
                        "bot{$this->botToken}/sendMessage",
                        [
                            'chat_id' => $chatId,
                            'text'    => $text,
                        ],
                    )
                    ->setOptions([
                        'connectTimeout' => self::CONNECT_TIMEOUT_SECONDS,
                        'timeout'        => self::REQUEST_TIMEOUT_SECONDS,
                    ])
                    ->send();

                if (!$response->isOk) {
                    $this->logger->warning("Telegram sendMessage failed, chat_id {$chatId}: {$response->content}");
                    continue;
                }

                $delivered = true;
                $this->logger->info(
                    "Telegram message sent, chat_id {$chatId}, message_id " . ($response->data['result']['message_id'] ?? '?'),
                );
            } catch (\Throwable $exception) {
                $this->logger->warning(
                    "Telegram sendMessage exception, chat_id {$chatId}: " . $this->maskToken($exception->getMessage()),
                );
            }
        }

        return $delivered;
    }

    /**
     * Обрезает текст под лимит Bot API
     */
    private function truncate(string $message): string
    {
        if ($this->utf16Length($message) <= self::MAX_MESSAGE_LENGTH) {
            return $message;
        }

        $limit  = self::MAX_MESSAGE_LENGTH - $this->utf16Length(self::TRUNCATION_MARK);
        $length = 0;
        $result = '';

        foreach (mb_str_split($message) as $char) {
            $length += $this->utf16Length($char);

            if ($length > $limit) {
                break;
            }

            $result .= $char;
        }

        return $result . self::TRUNCATION_MARK;
    }

    /**
     * Длина в единицах UTF-16: так считает Telegram, символы вне BMP (эмодзи) занимают две единицы
     */
    private function utf16Length(string $text): int
    {
        return intdiv(strlen(mb_convert_encoding($text, 'UTF-16LE', 'UTF-8')), 2);
    }

    /**
     * Тексты ошибок транспорта могут содержать URL запроса, а в нём токен бота
     */
    private function maskToken(string $text): string
    {
        return str_replace($this->botToken, self::MASKED_TOKEN, $text);
    }
}
