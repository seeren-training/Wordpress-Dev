<?php

namespace WpEasyRedirection;

use InvalidArgumentException;

class Controller
{

    public function render(string $template, array $data = []): string
    {
        $filename = __DIR__ . '/../templates/' . $template;
        if (!is_file($filename)) {
            throw new InvalidArgumentException('Template not found at:' . $filename);
        }
        ob_start();
        extract($data);
        include $filename;
        $content = ob_get_clean();
        return $content;
    }
}
