<?php

namespace Kernel;

use Kernel\HttpRequest\Request;
use Kernel\HttpRequest\RequestBag;

class Router
{

    /**
     * ex. [ 'method' => [ 'route' => [ class, method ] ]
     * @var array $routes
     */
    private $routes;

    /** @var array */
    private $params;

    // Метод для добавления маршрутов в массив
    private function add(string $route, array $action=[], string $method='GET'): void
    {
        // Избавляемся от слеша
        $route = preg_replace('/\//', '\\/', $route);
        $route = '/^'.$route.'$/i';

        $this->routes[$method][$route] = $action;

    }

    public function get(string $route, array $action=[]): void
    {
        $this->add($route, $action, Request::METHOD_GET);
    }

    public function post(string $route, array $action=[]): void
    {
        $this->add($route, $action, Request::METHOD_POST);
    }

    public function delete(string $route, array $action=[]): void
    {
        $this->add($route, $action, Request::METHOD_DELETE);
    }


    public function put(string $route, array $action=[]): void
    {
        $this->add($route, $action, Request::METHOD_PUT);
    }

    public function match(string $url): bool
    {
        $method = Request::getMethod();
        foreach ($this->routes[$method] as $route => $params) {
            if(preg_match($route, $url)) {
                $this->params = $params;
                return true;
            }
        }

        return false;

    }

    public function dispatch($url)
    {
        $url = $this->clear($url);
        Request::init();
        if($this->match($url)) {
            $controller = $this->params[0];

            $action = $this->params[1];

            if(class_exists($controller)) {
                try {
                    (new $controller())->$action();
                } catch (\Exception $e) {
                    $e->getMessage();
                }
            } else {
                throw new \Exception("Контроллер $controller не найден");
            }

        } else {
            View::render('404');
        }

    }

    /**
     * Очишаем из url query параметры
     * ex. url                      query           result
     * localhost/client?page=0      /client&page=1   /client
     *
     * @param string $url
     * @return string
     */
    protected function clear(string $url): string {
        if (!empty($url)) {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

}