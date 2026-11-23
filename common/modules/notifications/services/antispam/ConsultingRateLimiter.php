<?php

declare(strict_types=1);

namespace common\modules\notifications\services\antispam;

use Yii;
use yii\caching\CacheInterface;

/**
 * Ограничение частоты отправки заявок на консультацию с одного IP.
 * Обычный IP может отправлять заявки с небольшим интервалом,
 * IP, с которого пришёл спам, на час переводится в строгий режим.
 * Хранится в кеше, а не в сессии: боты куки не сохраняют
 */
final class ConsultingRateLimiter
{
    private const ATTEMPTS_KEY_PREFIX = 'consulting_rate_limit_';
    private const SPAMMER_KEY_PREFIX = 'consulting_spammer_';
    private const WINDOW_SECONDS = 3600;

    private const MIN_INTERVAL_SECONDS = 15;

    private const SPAMMER_MIN_INTERVAL_SECONDS = 300;
    private const SPAMMER_MAX_ATTEMPTS_PER_WINDOW = 3;

    private CacheInterface $cache;

    public function __construct()
    {
        $this->cache = Yii::$app->getCache();
    }

    /**
     * Регистрирует попытку отправки. Возвращает false, если лимит для IP исчерпан
     */
    public function attempt(string $ip): bool
    {
        $key = self::ATTEMPTS_KEY_PREFIX . $ip;
        $now = time();

        $attempts = array_values(array_filter(
            (array)($this->cache->get($key) ?: []),
            static fn(int $time): bool => $now - $time < self::WINDOW_SECONDS
        ));
        $sinceLastAttempt = $attempts === [] ? PHP_INT_MAX : $now - max($attempts);

        if ($this->cache->exists(self::SPAMMER_KEY_PREFIX . $ip)) {
            if (count($attempts) >= self::SPAMMER_MAX_ATTEMPTS_PER_WINDOW
                || $sinceLastAttempt < self::SPAMMER_MIN_INTERVAL_SECONDS
            ) {
                return false;
            }
        } elseif ($sinceLastAttempt < self::MIN_INTERVAL_SECONDS) {
            return false;
        }

        $attempts[] = $now;
        $this->cache->set($key, $attempts, self::WINDOW_SECONDS);

        return true;
    }

    /**
     * Переводит IP в строгий режим на час
     */
    public function markAsSpammer(string $ip): void
    {
        $this->cache->set(self::SPAMMER_KEY_PREFIX . $ip, time(), self::WINDOW_SECONDS);
    }
}
