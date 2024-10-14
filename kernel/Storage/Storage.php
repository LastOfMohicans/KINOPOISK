<?php

namespace App\Kernel\Storage;

use App\Kernel\Interfaces\ConfigInterface;
use App\Kernel\Interfaces\StorageInterface;

class Storage implements StorageInterface
{
    public function __construct(
        private ConfigInterface $config,
    ) {
    }

    public function url(string $path): string
    {
        $url = $this->config->getAuth('app.url');

        return "$url/storage/$path";
    }

    public function get(string $path): string
    {
        return file_get_contents($this->storagePath($path));
    }

    private function storagePath(string $path): string
    {
        return APP_PATH . "/storage/$path";
    }
}
