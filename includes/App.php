<?php

namespace App;

class App
{
    /**
     * @var App
     */
    private static ?App $instance = null;

    private function __construct()
    {
        $this->autoloading();
    }

    /**
     * @return App
     */
    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return bool
     */
    private function autoloading(): bool
    {
        require_once 'Autoload.php';

        return Autoload::load();
    }
}
