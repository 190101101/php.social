<?php 
namespace core;

class app
{
    protected $now_path;
    protected $now_method;
    protected static $routes = [];
    protected static $midd;
    protected $home;
    protected $middleware;
    protected $data = [];

    public function __construct($config)
    {
        $this->now_path = $_SERVER['REQUEST_URI'];
        $this->now_method = $_SERVER['REQUEST_METHOD'];
        $this->home = $config->route;
        $this->middleware = $config->middleware;
        $this->run();
    }

    public static function get($link, $path, $area='main', $midd = [])
    {        
        self::$routes[] = ['GET', $link, $path, $area, $midd];
    }

    public static function post($link, $path, $area='main', $midd = [])
    {
        self::$routes[] = ['POST', $link, $path, $area, $midd];
    }

    public function run()
    {
        foreach (self::$routes as $routes)
        {
            list($method, $link, $path, $area, $midd) = $routes;
            $method_check = $this->now_method == $method;
            $path_check = preg_match("@^{$link}$@", $this->now_path, $params);


            if($method_check && $path_check)
            {
                $uri = explode('/', $path);
                array_shift($uri);
                list($active_modul, $active_method) = $uri;

                if($this->now_path == '/')
                {
                    $module     = $this->home['modul'];
                    $controller = $this->home['modul'].'Controller';
                    $method     = $this->home['method'];
                    $area       = $this->home['area'];
                }
                else
                {
                    $module     = $active_modul;
                    $controller = $active_modul.'Controller';
                    $method     = $active_method;
                }

                if(file_exists($file = "../modulus/{$area}/{$module}/controller/{$controller}.php"))
                {
                    if(class_exists('modulus\\'.$area.'\\'.$module.'\\controller\\'.$controller))
                    {
                        $call_class = "modulus\\".$area."\\{$module}\\controller\\{$controller}";
                        $class = new $call_class;

                        if(method_exists($class, $method))
                        {
                            if(count($midd) != 0)
                            {
                                foreach($midd as $key => $value)
                                {
                                    \library\middleware::call($this->middleware[$value], function($return){
                                        return $return;
                                    });
                                }
                            }

                            array_shift($params);
                            return call_user_func_array([$class, $method], array_values($params));
                        }
                        else
                        {
                            REDIRECT('error/type/method');
                        }
                    }
                    else
                    {
                        REDIRECT('error/type/class');
                    }
                }
                else
                {
                    REDIRECT('error/type/controller');
                }
            }
        }
        REDIRECT('404');
    }
}

