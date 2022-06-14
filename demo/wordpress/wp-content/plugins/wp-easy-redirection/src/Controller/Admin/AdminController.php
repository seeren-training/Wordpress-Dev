<?php

namespace WpEasyRedirection\Controller\Admin;

use WpEasyRedirection\Controller\Admin\Menu\TopMenuController;
use WpEasyRedirection\Controller\Admin\Register\RegisterController;
use WpEasyRedirection\Controller\Controller;

class AdminController extends Controller
{

    public function show(): void
    {
        $register = new RegisterController();
        $menu = new TopMenuController();
        $register->register();
        $menu->add();
    }
}
