<?php

// Default Defines //
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(dirname(__FILE__)) . DS);
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PUB_DIR', ROOT_DIR . 'public' . DS);
define('APP_DIR', ROOT_DIR . 'application' . DS);
define('APPS', ROOT_DIR . 'apps' . DS);

// Load all libraries and configs
require_once APP_DIR . '__load__.php';

$application = new application();
$test = json_encode($application->getAllApps());

?>
<?=$test ?>
