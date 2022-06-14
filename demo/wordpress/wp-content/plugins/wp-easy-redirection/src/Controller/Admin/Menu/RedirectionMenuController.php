<?php

namespace WpEasyRedirection\Controller\Admin\Menu;

class RedirectionMenuController extends MenuController
{

    public function __construct()
    {
        parent::__construct(
            'wp_easy_redirection_manage',
            'Redirections',
        );
    }

    public function add(string $parentSlug): void
    {
        add_action('admin_menu', function () use ($parentSlug) {
            add_submenu_page(
                $parentSlug,
                $this->pageTitle,
                $this->menuTitle,
                self::CAPABILITY,
                $this->slug,
                function () {
                    $this->show();
                }
            );
        });
    }

    public function show()
    {
        echo $this->render('admin/menu/redirection_menu/show.html.php', [
            'title' => $this->pageTitle,
        ]);
    }
}
