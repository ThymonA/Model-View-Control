<?php

/**
 * Class app
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class app
{
    private $application;
    private $app = '';
    private $fail = false;
    private $route = '';

    public function __construct() {
        $this->application = new application();
    }

    public function register($name) {
        $this->app = '';
        $this->fail = false;
        $this->route = '';
        $this->application = new application();
        if(is_string(strtolower($name)) && $this->fail == false && $this->application->registerApp(strtolower($name)) == true) {
            $this->app = strtolower($name);
            return $this;
        } else {
            $this->fail = true;
            return $this;
        }
    }

    public function setTitle($title) {
        if(isset($this->app) && $this->app != '' && $this->fail == false && $this->application->setTitle($this->app, $title) == true) {
            return $this;
        } else {
            $this->fail = true;
            return $this;
        }
    }

    public function setDescription($description) {
        if(isset($this->app) && $this->app != '' && $this->fail == false && $this->application->setDescription($this->app, $description) == true) {
            return $this;
        } else {
            $this->fail = true;
            return $this;
        }
    }

    public function addRoute($route, $function, $defaultArguments = []) {
        if(isset($this->app) && $this->app != '' && is_array($defaultArguments) && is_string($route) && is_string($function) && $this->fail == false && $this->application->setRoute($this->app, $route, $function, $defaultArguments) == true) {
            $this->route = $route;
            return $this;
        } else {
            $this->fail = true;
            return $this;
        }
    }

    public function setAsDefault() {
        if(isset($this->app) && $this->app != '' && $this->fail == false && is_string($this->route) && $this->route != '' && $this->application->setAsDefaultRoute($this->app, $this->route) == true) {
            return $this;
        } else {
            $this->fail = true;
            return $this;
        }
    }

    public function setTheme($theme) {
        if(isset($this->app) && $this->app != '' && $this->fail == false && $this->application->setTheme($this->app, $theme) == true) {
            return $this;
        } else {
            $this->fail = true;
            return $this;
        }
    }
}