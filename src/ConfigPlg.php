<?php
declare(strict_types=1);

namespace App;

class ConfigPlg
{
    private const VERSION_ASSET = '1.0';
    private const HANDLE_STYLE_NAME = 'newslt-css';
    private const HANDLE_SCRIPT_NAME = 'newslt-js';
    const SRC_ROBOTO_FONT = 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500&display=swap';
    const HANDLE_ROBOTO_FONT = 'roboto-newslt';

    /**
     * @var ConfigPlg|null $instance
     */
    private static ?ConfigPlg $instance = null;

    private function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'registerAssets']);
    }

    /**
     * @return ConfigPlg
     */
    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function registerAssets(): void
    {
        wp_register_style(self::HANDLE_STYLE_NAME, $this->assetCssPath(), [], self::VERSION_ASSET);
         wp_register_style(self::HANDLE_ROBOTO_FONT, self::SRC_ROBOTO_FONT, [], self::VERSION_ASSET);
        wp_register_script(self::HANDLE_SCRIPT_NAME, $this->assetJsPath(), [], self::VERSION_ASSET, true);
        wp_enqueue_style( self::HANDLE_STYLE_NAME);
         wp_enqueue_style( self::HANDLE_ROBOTO_FONT);
        wp_enqueue_script(self::HANDLE_SCRIPT_NAME);
    }


    /**
     * @return string
     */
    private function assetCssPath(): string
    {
        return App::pluginPath().'assets/css/style.css';
    }

    /**
     * @return string
     */
    private function assetJsPath(): string
    {
        return App::pluginPath().'assets/js/app.js';
    }

}

