<?php

// Default Variables //
$app = new app();
$rootURL = getCurrentHost();

function getCurrentHost() {
    $subfolder = str_replace(DOC_ROOT, '', ROOT_DIR);
    if(substr($subfolder, -1) !== '/' || substr($subfolder, -1) !== '\\') {
        $subfolder = substr($subfolder, 0, -1);
    }
    return (getCurrentProtocol() ?? 'http://') . $_SERVER['HTTP_HOST'] . $subfolder . '/';
}

function getCurrentURI() {
    return preg_replace("/\?.+/", "", (getCurrentProtocol() ?? 'http://') . $_SERVER['HTTP_HOST'] . str_replace(ROOT_DIR, '', ($_SERVER['REQUEST_URI'] ?? '/')));
}

function getCurrentProtocol() {
    if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
        return 'https://';
    } else {
        return 'http://';
    }
}

function UrlToArguments($url) {
    $currentURI = preg_replace("/\?.+/", "", str_replace(getCurrentHost(), '', $url));
    $URIParts = explode("/", $currentURI);
    $URIParts = array_filter($URIParts,function($v){ return strlen($v) > 0; });
    $URIParts = array_values($URIParts);
    return $URIParts ?? [];
}

function AllArguments() {
    $currentURI = preg_replace("/\?.+/", "", str_replace(getCurrentHost(), '', getCurrentURI()));
    $URIParts = explode("/", $currentURI);
    $URIParts = array_filter($URIParts,function($v){ return strlen($v) > 0; });
    if(isset($URIParts[0])) unset($URIParts[0]);
    $URIParts = array_values($URIParts);
    return $URIParts ?? [];
}

function Argument($number = 0) {
    $currentURI = preg_replace("/\?.+/", "", str_replace(getCurrentHost(), '', getCurrentURI()));
    $URIParts = explode("/", $currentURI);
    $URIParts = array_filter($URIParts,function($v){ return strlen($v) > 0; });
    if(isset($URIParts[0])) unset($URIParts[0]);
    $URIParts = array_values($URIParts);
    return $URIParts[$number] ?? false;
}

function ArgumentCount() {
    $currentURI = preg_replace("/\?.+/", "", str_replace(getCurrentHost(), '', getCurrentURI()));
    $URIParts = explode("/", $currentURI);
    $URIParts = array_filter($URIParts,function($v){ return strlen($v) > 0; });
    if(isset($URIParts[0])) unset($URIParts[0]);
    $URIParts = array_values($URIParts);
    return count($URIParts ?? []);
}

function GetBetween($content,$start,$end)
{
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0] ?? '';
    }
    return '';
}