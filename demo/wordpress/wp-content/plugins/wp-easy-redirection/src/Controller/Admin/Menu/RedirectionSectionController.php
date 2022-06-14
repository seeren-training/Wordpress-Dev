<?php

namespace WpEasyRedirection\Controller\Admin\Menu;

use WpEasyRedirection\Controller\Controller;
use WpEasyRedirection\Model\Section;

class RedirectionSectionController extends Controller
{

    public function add(string $pageTitle): void
    {
        $section = new Section('wp_easy_redirection_manage_redirection_section', 'Liste des redirections');
        add_action('admin_init', function () use ($section, $pageTitle) {
            add_settings_section(
                $section->getId(),
                $section->getSectionTitle(),
                function () {
                    $this->show();
                },
                $pageTitle
            );
        });
        $redirectionField = new RedirectionFieldController();
        $redirectionField->add($pageTitle, $section->getId());
    }

    public function show()
    {
        echo $this->render('admin/menu/redirection_section/show.html.php');
    }
}
