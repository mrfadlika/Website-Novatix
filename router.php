<?php

$uri = trim($_SERVER['REQUEST_URI'], '/');

if (preg_match('/\.(css|js|png|jpg|gif|ico|svg|min.js|min.css)$/i', $_SERVER['REQUEST_URI'])) {
    return false;
}

$uri = strtok($uri, '?');

if ($uri == '') {
    require 'index.php';
}
elseif (file_exists($uri . '.php')) {
    require $uri . '.php';
}
else {
    require '404.php';
}
?>
