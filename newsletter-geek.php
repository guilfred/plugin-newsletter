<?php

/**
 * Plugin Name:       Newsletter api geek
 * Plugin URI:        https://github.com/guilfred/plugin-newsletter
 * Description:       Register email subscribe on api.
 * Version:           1.0
 * Requires PHP:      7.4
 * Author:            Guillaume - Alfred
 * Text Domain:       my-basics-plugin
 */

require_once 'src'.DIRECTORY_SEPARATOR.'App.php';
require_once 'src'.DIRECTORY_SEPARATOR.'Autoload.php';

use App\App;
use App\Autoload;
use App\ConfigPlg;

// Autoload
Autoload::load();

$app = App::getInstance(ConfigPlg::getInstance());

