<?php

/**
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

// Default Defines //
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(dirname(__FILE__)) . DS);
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PUB_DIR', ROOT_DIR . 'public' . DS);
define('APP_DIR', ROOT_DIR . 'application' . DS);
define('APPS', ROOT_DIR . 'apps' . DS);

// Load all libraries and configs
require_once APP_DIR . '__load__.php';

// Start Session
session_start();

// Run Application
$application = new application();
$application->render();

?>
