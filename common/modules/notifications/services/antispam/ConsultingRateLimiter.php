<?php

declare(strict_types=1);

namespace common\modules\notifications\services\antispam;

use Yii;
use yii\caching\CacheInterface;

/**
 * Ограничение частоты отправки заявок на консультацию с одного IP.
 * Хранится в кеше, а не в сессии: боты куки не сохраняют
 */
final class ConsultingRateLimiter
{
    private const CACHE_KEY_PREFIX = 'consulting_rate_limit_';
    private const MIN_INTERVAL_SECONDS = 300;
    private const WINDOW_SECONDS = 3600;
    private const MAX_ATTEMPTS_PER_WINDOW = 3;

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
        $key = self::CACHE_KEY_PREFIX . $ip;
        $now = time();

        $attempts = array_values(array_filter(
            (array)($this->cache->get($key) ?: []),
            static fn(int $time): bool => $now - $time < self::WINDOW_SECONDS
        ));

        if (count($attempts) >= self::MAX_ATTEMPTS_PER_WINDOW) {
            return false;
        }

        if ($attempts !== [] && $now - max($attempts) < self::MIN_INTERVAL_SECONDS) {
            return false;
        }

        $attempts[] = $now;
        $this->cache->set($key, $attempts, self::WINDOW_SECONDS);

        return true;
    }
}
