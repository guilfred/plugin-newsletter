<?php

require_once dirname(__DIR__). DIRECTORY_SEPARATOR.'App.php';
use App\App;

echo App::subscribe($_POST);
