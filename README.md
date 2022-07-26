[![Latest Stable Version](https://img.shields.io/packagist/v/webclient/cache-contract.svg?style=flat-square)](https://packagist.org/packages/webclient/cache-contract)
[![Total Downloads](https://img.shields.io/packagist/dt/webclient/cache-contract.svg?style=flat-square)](https://packagist.org/packages/webclient/cache-contract/stats)
[![License](https://img.shields.io/packagist/l/webclient/cache-contract.svg?style=flat-square)](https://github.com/phpwebclient/cache-contract/blob/master/LICENSE)
[![PHP](https://img.shields.io/packagist/php-v/webclient/cache-contract.svg?style=flat-square)](https://php.net)

# webclient/cache-contract

Cache interface for [webclient/ext-cache](https://packagist.org/packages/webclient/ext-cache#v2.0.0)

# Install

```bash
composer require webclient/cache-contract:^1.0
```
# Tips and tricks

## Split cache storage for settings and responses

You may split cache storage for settings and responses.

implements cache-contract, like it:

```php
<?php

use Webclient\Cache\Contract\CacheInterface;

class SplitCache implements CacheInterface
{
    private CacheInterface $settingsCache;
    private CacheInterface $responsesCache;
    public function __construct(CacheInterface $settingsCache, CacheInterface $responsesCache)
    {
        $this->settingsCache = $settingsCache;
        $this->responsesCache = $responsesCache;
    }

    public function get(string $key) : ?string
    {
        $this->getStorage($key)->get($key);
    }

    public function set(string $key,string $data,?int $ttl = null) : void
    {
        $this->getStorage($key)->get($key, $data, $ttl);
    }

    private function getStorage(string $key): CacheInterface
    {
        if (strpos($key, 'http.settings.') === 0) {
            return $this->settingsCache;
        }
        if (strpos($key, 'http.response.') === 0) {
            return $this->responsesCache;
        }
        throw new InvalidArgumentException('can not define storage');
    }
}

```
