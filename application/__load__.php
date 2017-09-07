<?php

require_once 'secret' . DS . 'config.php';
require_once 'library' . DS . 'BladeOne' . DS . 'BladeOne.php';
require_once 'library' . DS . 'application.php';
require_once 'library' . DS . 'app.php';
require_once 'library' . DS . 'core.php';
require_once 'library' . DS . 'database.php';
require_once 'library' . DS . 'hash.php';
require_once 'library' . DS . 'model.php';
require_once ROOT_DIR . 'apps' . DS . 'routes.php';

use eftec\bladeone\BladeOne as blade;

$views = APPS . 'views' . DS;
$cache = APPS . 'cache' . DS;
define("BLADEONE_MODE",1);
$blade = new blade($views, $cache);

