<?php 
class Router {
    public $subRoute = "";
    function __construct($subRoute) {
        $this->subRoute = $subRoute;
    }
    function router($httpMethods, $route, $classObject, $classfunction)
    {
        $route = '^/'.$this->subRoute.'/'.$route.'$';
        $route = str_replace('//', '/', $route) ;
        
        static $path = null;
        if ($path === null) {
            $path = parse_url($_SERVER['REQUEST_URI'])['path'];
            $scriptName = dirname(dirname($_SERVER['SCRIPT_NAME']));
            $scriptName = str_replace('\\', '/', $scriptName);
            $len = strlen($scriptName);
            if ($len > 0 && $scriptName !== '/') {
                $path = substr($path, $len);
            }
        }
        if(substr($path, -1) != '/') {
            $route = str_replace('/$', '$', $route) ;
        }
        
        if (!in_array($_SERVER['REQUEST_METHOD'], (array) $httpMethods)) {
            return;
        }

        $matches = null;
        $regex = '/' . str_replace('/', '\/', $route) . '/';
        if (!preg_match_all($regex, $path, $matches)) {
            return;
        }
        if (empty($matches)) {
            call_user_func(array($classObject, $classfunction));
        } else {
            $params = array();
            foreach ($matches as $k => $v) {
                if (!is_numeric($k) && !isset($v[1])) {
                    $params[$k] = $v[0];
                }
            }
            call_user_func(array($classObject, $classfunction),$params);
        }
        exit();
    }
}