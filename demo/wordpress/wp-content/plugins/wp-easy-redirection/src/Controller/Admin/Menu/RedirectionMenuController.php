<?php

namespace WpEasyRedirection\Controller\Admin\Menu;

use WpEasyRedirection\Controller\Controller;
use WpEasyRedirection\Model\Menu;

class RedirectionMenuController extends Controller
{

    public function add(string $parentSlug): void
    {
        $menu = new Menu('wp_easy_redirection_manage', 'Wp Easy Redirections');
        add_action('admin_menu', function () use ($menu, $parentSlug) {
            add_submenu_page(
                $parentSlug,
                $menu->getPageTitle(),
                $menu->getMenuTitle(),
                Menu::CAPABILITY,
                $menu->getSlug(),
                function () use ($menu) {
                    $this->show($menu);
                }
            );
        });
        $redirectionSection = new RedirectionSectionController();
        $redirectionSection->add($menu->getPageTitle());
    }

    public function show(Menu $menu)
    {
        echo $this->render('admin/menu/redirection_menu/show.html.php', [
            'title' => $menu->getPageTitle(),
        ]);
    }
}
