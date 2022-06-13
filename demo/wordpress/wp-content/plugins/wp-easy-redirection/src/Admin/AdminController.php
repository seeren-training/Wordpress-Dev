<?php

namespace WpEasyRedirection\Admin;

use WpEasyRedirection\Admin\Register\RegisterController;
use WpEasyRedirection\Controller;

class AdminController extends Controller
{

    public function show(string $filename): void
    {
        $register = new RegisterController($filename);
        $register->register();
    }

}
