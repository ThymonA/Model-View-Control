<?php

class application
{
    private static $apps = [];

    public function registerApp($name) {
        if(isset(application::$apps[$name])) {
            return false;
        } else if(file_exists(ROOT_DIR . 'apps' . DS . strtolower($name) . DS)) {
            application::$apps[$name] = [];
            application::$apps[$name]['path'] = ROOT_DIR . 'apps' . DS . $name . DS;
            application::$apps[$name]['routes'] = [];
            return true;
        } else {
            return false;
        }
    }

    public function setDescription($name, $description) {
        if(isset(application::$apps[$name])) {
            application::$apps[$name]['description'] = $description;
            return true;
        } else {
            return false;
        }
    }

    public function setTitle($name, $title) {
        if(isset(application::$apps[$name])) {
            application::$apps[$name]['title'] = $title;
            return true;
        } else {
            return false;
        }
    }

    public function setTheme($name, $theme) {
        if(isset(application::$apps[$name]) && file_exists(APP_DIR . 'layout' . DS . strtolower($theme) . DS)) {
            application::$apps[$name]['theme'] = $theme;
            return true;
        } else {
            application::$apps[$name]['theme'] = 'default';
            return false;
        }
    }

    public function setRoute($name, $route, $function, $default = []) {
        if(isset(application::$apps[$name])) {
            $arguments = UrlToArguments($route);
            $argumentsCount = 0;
            $defaultArguments = [];
            $_function = UrlToArguments($function);
            foreach ($arguments as $argument) {
                if(substr($argument, 0, 1) == ':') {
                    $argumentsCount += 1;
                    $argument = str_replace(':', '', $argument);
                    if(isset($default[':' . $argument])) {
                        $defaultArguments[$argument] = $default[':' . $argument];
                    } else if(isset($default[$argument])) {
                        $defaultArguments[$argument] = $default[$argument];
                    }
                }
            }
            switch(count($_function)) {
                case 1:
                    if(file_exists(APPS . $name . DS . 'model' . DS . 'index.php')) {
                        require_once APPS . $name . DS . 'model' . DS . 'index.php';
                        $app = new $name();
                        if (method_exists($app, $_function[0])) {
                            array_push(application::$apps[$name]['routes'], [
                                'route' => strtolower($route),
                                'CountArguments' => $argumentsCount,
                                'DefaultArguments' => $defaultArguments,
                                'model' => 'index.php',
                                'function' => $_function[0] ?? 'index'
                            ]);
                            return true;
                        } else return false;
                    } else return false;
                    break;
                case 2:
                    if(file_exists(APPS . $name . DS . 'model' . DS . strtolower($_function[0] ?? '') . '.php')) {
                        require_once APPS . $name . DS . 'model' . DS . strtolower($_function[0] ?? '') . '.php';
                        $app = new $_function[0]();
                        if (method_exists($app, $_function[1])) {
                            array_push(application::$apps[$name]['routes'], [
                                'route' => strtolower($route),
                                'CountArguments' => $argumentsCount,
                                'DefaultArguments' => $defaultArguments,
                                'model' => strtolower($_function[0] ?? '') . '.php',
                                'function' => $_function[1] ?? 'index'
                            ]);
                            return true;
                        } else return false;
                    } else return false;
                    break;
                default:
                    return false;
                    break;
            }
        } else return false;
    }

    public function getAllApps() {
        return application::$apps;
    }

    public function render() {
        if((config::development_mode ?? false) == true) {

        }
    }
}