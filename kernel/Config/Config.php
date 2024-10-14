<?php

namespace App\Kernel\Config;
use App\Kernel\Interfaces\ConfigInterface;

class Config implements ConfigInterface
{
    public function get(): void
    {
        $file = APP_PATH . '/config/config.php';
        if (file_exists($file)) {
            require $file;
        } else {
            die('File Not Find!!!');
        }

    }

    public function getAuth(string $key, $default = null): mixed
    {
        [$file, $key] = explode('.', $key);

        $configPath = APP_PATH . "/config/$file.php";

        if (!file_exists($configPath)) {
            return $default;
        }

        $config = require $configPath;

        return $config[$key] ?? $default;
    }


}
