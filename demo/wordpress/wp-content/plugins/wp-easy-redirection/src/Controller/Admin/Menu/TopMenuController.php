<?php

namespace WpEasyRedirection\Controller\Admin\Menu;

use WpEasyRedirection\Controller\Controller;
use WpEasyRedirection\Model\Menu;

class TopMenuController extends Controller
{

    public function add(): void
    {
        $menu = new Menu('wp_easy_redirection', 'Wp Easy Redirection');
        add_action('admin_menu', function () use ($menu) {
            add_menu_page(
                $menu->getPageTitle(),
                $menu->getMenuTitle(),
                Menu::CAPABILITY,
                $menu->getSlug(),
                function () use ($menu) {
                    $this->show($menu);
                }
            );
        });
        $redirectionMenu = new RedirectionMenuController();
        $redirectionMenu->add($menu->getSlug());
    }

    public function show(Menu $menu)
    {
        echo $this->render('admin/menu/top_menu/show.html.php', [
            'title' => $menu->getPageTitle(),
            'redirection_slug' =>  $menu->getSlug(),
        ]);
    }
}
