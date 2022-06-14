<?php

namespace WpEasyRedirection\Controller\Admin\Menu;

class TopMenuController extends MenuController
{

    private RedirectionMenuController $redirectionMenu;

    public function __construct()
    {
        parent::__construct(
            'wp_easy_redirection',
            'Wp Easy Redirection',
        );
        $this->redirectionMenu = new RedirectionMenuController();
    }

    public function add(): void
    {
        add_action('admin_menu', function () {
            add_menu_page(
                $this->pageTitle,
                $this->menuTitle,
                self::CAPABILITY,
                $this->slug,
                function () {
                    $this->show();
                }
            );
        });
        $this->redirectionMenu->add($this->slug);
    }

    public function show()
    {
        echo $this->render('admin/menu/top_menu/show.html.php', [
            'title' => $this->pageTitle,
            'redirection_slug' =>  $this->redirectionMenu->getSlug(),
        ]);
    }
}
