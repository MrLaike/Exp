<?php

namespace Kernel;

class Router
{

    /**
     * @var array [ 'route' => [ 'method' => 'get', 'action' => [ class, method ] ] ]
     */
    private $routes;

    /** @var array */
    private $params;

    // Метод для добавления маршрутов в массив
    private function add(string $route, array $action=[], string $method='get'): void
    {
        // Избавляемся от слеша
        $route = preg_replace('/\//', '\\/', $route);
        $route = '/'.$route.'$/i';

        $this->routes[$route] = [
            'method' => $method,
            'action' => $action
        ];

    }

    public function get(string $route, array $action=[]): void
    {
        $this->add($route, $action, Method::GET);
    }

    public function post(string $route, array $action=[]): void
    {
        $this->add($route, $action, Method::POST);
    }

    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if(is_string($key)) {
                        $params['action'][$key] = $match;
                    }
                }

                $this->params = $params;

                return true;
            }
        }

        return false;

    }

    public function dispatch($url)
    {
        $url = $this->clear($url);
        if($this->match($url)) {
            $controller = $this->params['action'][0];

            $action = $this->params['action'][1];

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
     * localhost/client?page=0      client&page=1   client
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