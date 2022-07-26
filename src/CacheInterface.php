<?php

declare(strict_types=1);

namespace Webclient\Cache\Contract;

use Webclient\Cache\Contract\Exception\CacheError;

interface CacheInterface
{
    /**
     * @param string $key
     * @return string|null
     */
    public function get(string $key): ?string;

    /**
     * @param string $key
     * @param string $data
     * @param int|null $ttl
     * @return void
     * @throws CacheError
     */
    public function set(string $key, string $data, ?int $ttl = null): void;
}
