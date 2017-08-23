<?php

class application
{
    private static $apps = [];
    private static $routeList = [];
    private static $routes = [];
    private static $default = false;

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

    public function routeExist($name, $route) {
        for($i = 0; $i < count(application::$apps[$name]['routes']); $i++) {
            if(application::$apps[$name]['routes'][$i]['route'] == $route) {

            }
        }
        return false;
    }

    public function setAsDefaultRoute($name, $route) {
        if(isset(application::$apps[$name])) {
            $arguments = UrlToArguments($route);
            $route = '';
            $argumentFount = false;
            $argumentsCount = 0;
            foreach ($arguments as $argument) {
                if(substr($argument, 0, 1) == ':') {
                    $argumentFount = true;
                    $argumentsCount += 1;
                } else if($argumentFount == false) {
                    if($route == '') {
                        $route .= '/' . $argument . '/';
                    } else {
                        $route .= $argument . '/';
                    }
                }
            }
            application::$default = [
                'route' => $route,
                'arguments' => $argumentsCount,
                'app' => $name
            ];
            return true;
        } else {
            return false;
        }
    }

    public function setRoute($name, $route, $function, $default = []) {
        if(isset(application::$apps[$name])) {
            $arguments = UrlToArguments($route);
            $route = '';
            $regexRoute = '';
            $argumentFount = false;
            $argumentList = [];
            $argumentsCount = 0;
            $defaultArguments = [];
            $_function = UrlToArguments($function);
            foreach ($arguments as $argument) {
                if(substr($argument, 0, 1) == ':') {
                    if($route != '') {
                        $regexRoute .= '([a-zA-Z0-9-_]+)/';
                        $argumentFount = true;
                        $argumentsCount += 1;
                        $argument = str_replace(':', '', $argument);
                        if (isset($default[':' . $argument])) {
                            $defaultArguments[$argument] = $default[':' . $argument];
                        } else if (isset($default[$argument])) {
                            $defaultArguments[$argument] = $default[$argument];
                        }
                        array_push($argumentList, $argument);
                    } else {
                        return false;
                    }
                } else if($argumentFount == false) {
                    if($route == '') {
                        $route .= '/' . $argument . '/';
                        $regexRoute .= '/' . $argument . '/';
                    } else {
                        $route .= $argument . '/';
                        $regexRoute .= $argument . '/';
                    }
                }
            }
            $regexRoute = '@^' . $regexRoute .= '?$@';
            switch(count($_function)) {
                case 1:
                    if(file_exists(APPS . $name . DS . 'model' . DS . 'index.php')) {
                        require_once APPS . $name . DS . 'model' . DS . 'index.php';
                        $app = new $name();
                        if (method_exists($app, $_function[0])) {
                            array_push(application::$routeList, [
                                'route' => strtolower($route),
                                'CountArguments' => $argumentsCount,
                                'ArgumentList' => $argumentList,
                                'DefaultArguments' => $defaultArguments,
                                'model' => 'index.php',
                                'function' => $_function[0] ?? 'index',
                                'app' => $name
                            ]);
                            array_push(application::$apps[$name]['routes'], $route);
                            array_push(application::$routes, $regexRoute);
                            return true;
                        } else return false;
                    } else return false;
                    break;
                case 2:
                    if(file_exists(APPS . $name . DS . 'model' . DS . strtolower($_function[0] ?? '') . '.php')) {
                        require_once APPS . $name . DS . 'model' . DS . strtolower($_function[0] ?? '') . '.php';
                        $app = new $_function[0]();
                        if (method_exists($app, $_function[1])) {
                            array_push(application::$routeList, [
                                'route' => strtolower($route),
                                'CountArguments' => $argumentsCount,
                                'ArgumentList' => $argumentList,
                                'DefaultArguments' => $defaultArguments,
                                'model' => strtolower($_function[0] ?? '') . '.php',
                                'function' => $_function[1] ?? 'index',
                                'app' => $name
                            ]);
                            array_push(application::$apps[$name]['routes'], $route);
                            array_push(application::$routes, $regexRoute);
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

    public function getAllRoutes() {
        return application::$routes;
    }

    public function getRouteList() {
        return application::$routeList;
    }

    public function getDefaultRoute() {
        return application::$default;
    }

    public function getRoute() {
        $return = false;
        foreach (application::$routes as $key => $route) {
            $currentRoute = str_replace(getCurrentHost(), '', getCurrentURI());
            if(substr($currentRoute, 0, 1) != '/') {
                $currentRoute = '/' . $currentRoute;
            }
            if(substr($currentRoute, -1) != '/') {
                $currentRoute = $currentRoute . '/';
            }
            if($route == '@^?$@') {
                $route = '@^/?$@';
            }
            preg_match($route, $currentRoute, $matches);
            if(count($matches) > 0) {
                unset($matches[0]);
                $matches = array_values($matches);
                $return = [
                    'params' => $matches,
                    'route' => application::$routeList[$key],
                    'app' => application::$apps[application::$routeList[$key]['app']]
                    ];
            }
        }
        return $return;
    }

    public function render() {
        if((config::development_mode ?? false) == true) {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
            define('URL_PROTOCOL', 'http://');
        }
        $route = $this->getRoute();
        if($route == false) {
            $route = $this->getDefaultRoute();
            if($route == false) {
                header("HTTP/1.0 500 Internal Server Error");
                echo '<center><br><hr><br><h1>ERROR 500</h1><br><p><b>Message: </b>Internal Server Error<br><b>Status: </b>500<br><br><hr><br>Please contact the server administrator <a href="mailto:' . $_SERVER['SERVER_ADMIN'] . '">' . $_SERVER['SERVER_ADMIN'] . '</a></p></center>';
            } else {
                $route = $route['route'];
                if(substr($route, 0, 1) == '/') {
                    $route = substr($route, 1);
                }
                header('Location: ' . getCurrentHost() . $route);
            }
        } else {
            if(file_exists($route['app']['path'] . 'model' . DS . $route['route']['model'])) {
                require_once $route['app']['path'] . 'model' . DS . $route['route']['model'];
                if($route['route']['model'] == 'index.php') {
                    $app = new $route['route']['app']();
                } else {
                    $class = str_replace('.php', '', $route['route']['model']);
                    $app = new $class();
                }
                if(count($route['params']) > 0) {
                    call_user_func_array([$app, $route['route']['function']], $route['params']);
                } else {
                    $app->{$route['route']['function']}();
                }
            }
        }
    }
}