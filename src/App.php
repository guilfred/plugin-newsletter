<?php
declare(strict_types=1);

namespace App;

class App {

    private const EMAIL_SHORTCODE = 'email-newsletter';
    private const ERROR_EMAIL_KEY = 'error';
    private const INVALID_EMAIL_KEY = 'invalid';
    private const SUCCESS_EMAIL_KEY = 'success';
    private const ERROR_EMAIL_MESS = 'Veuillez saisir votre email';
    private const INVALID_EMAIL_MESS = 'Votre email est invalide !';
    private const SUCCESS_EMAIL_MESS = 'Votre inscription a bien été effectuée';

    /**
     * @var App|null $instance
     */
    private static ?App $instance = null;

    /**
     * @var ConfigPlg
     */
    private ConfigPlg $config;

    private function __construct(ConfigPlg $config)
    {
        $this->config = $config;
        add_shortcode(self::EMAIL_SHORTCODE, [$this, 'renderFormEmail']);
    }

    /**
     * @param $config
     *
     * @return App
     */
    public static function getInstance(ConfigPlg $config): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    /**
     * @param array $post
     *
     * @return false|string
     */
    public static function subscribe(array $post)
    {
        if (!empty($post)) {
            $email = htmlentities($post['email']);

            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return json_encode(self::createResultMessage(self::INVALID_EMAIL_KEY, self::INVALID_EMAIL_MESS));
            }
            self::writeEmailOnFile($email.PHP_EOL);

            return json_encode(self::createResultMessage(self::SUCCESS_EMAIL_KEY, self::SUCCESS_EMAIL_MESS));
        }

        return json_encode(self::createResultMessage(self::ERROR_EMAIL_KEY, self::ERROR_EMAIL_MESS));
    }

    /**
     * @param string $email
     */
    private static function writeEmailOnFile(string $email)
    {
        $file = date('Y-m-d');
        if (!file_exists('data/'))
        {
            mkdir('data');
        }
        file_put_contents('data/'.$file, $email, FILE_APPEND);
    }

    /**
     * @param string $message
     * @param string $info
     *
     * @return string[]
     */
    private static function createResultMessage(string $message, string $info): array
    {
        return ['message' => $message, 'info' => $info];
    }

    public function renderFormEmail()
    {
        require 'views'.DIRECTORY_SEPARATOR.'email.php';
    }

    /**
     * @return string
     */
    public static function pluginPath(): string
    {
        return str_replace('src/', '', plugin_dir_url( __FILE__ ));
    }

    /**
     * @return string
     */
    public static function submitEmailButton(): string
    {
        return self::pluginPath().'assets/images/enveloppe.svg';
    }



}
