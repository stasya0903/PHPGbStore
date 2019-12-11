<?php

namespace App\services\renders;

class TwigRender implements IRender
{
    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return  $this->renderTmpl(
            'layouts/main',
            ['content' => $content]
        );
    }

    /**
     * @param $template
     * @param array $params ["users" => 123, "tr" => [1,5,6]]
     * @return false|string
     */
    public function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(dirname(__DIR__)) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}