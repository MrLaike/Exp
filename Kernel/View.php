<?php

namespace Kernel;

use Kernel\HttpRequest\Request;


class View implements ViewInterface
{

    // расширение шаблона
    protected $extension = 'php';


    public static function render(string $view, $data = []): void
    {
        $file = dirname(__DIR__) . "/App/Views/$view.".(new self)->getExtension();

        if($data instanceof Collection) $results['data'] = $data->toArray();
        $results['url'] = Request::getUrl();
        // Преобразуем ключи ассоциативного массива в переменные
        if(is_array($results)) extract($results, EXTR_OVERWRITE);



        // Подключаем шаблон
        if(file_exists($file)) {
            require_once $file;
        } else {
//            throw new \Exception('Файл не существует');
        }
    }


    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        return $this->extension = $extension;
    }

}