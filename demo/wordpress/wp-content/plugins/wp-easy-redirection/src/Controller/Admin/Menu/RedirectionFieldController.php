<?php

namespace WpEasyRedirection\Controller\Admin\Menu;

use WpEasyRedirection\Controller\Controller;
use WpEasyRedirection\Model\Field;

class RedirectionFieldController extends Controller
{

    public function add(
        string $pageTitle,
        string $sectionId
    ): void {
        $field = new Field(
            'wp_easy_redirection_manage_redirection_field',
            'wp_easy_redirection_manage_redirection_setting',
            'Redirections actives',
        );
        add_action('admin_init', function () use ($field, $pageTitle, $sectionId) {
            register_setting($pageTitle, $field->getSettingId());
            add_settings_field(
                $field->getId(),
                $field->getFieldTitle(),
                function () use ($field) {
                    $this->show($field);
                },
                $pageTitle,
                $sectionId
            );
        });
    }

    public function show(Field $field)
    {
        if (filter_input(INPUT_GET, 'settings-updated')) {
            set_transient( 'last_redirection_visit', date('H:i:s'), 60*60*24 );
        }
        $redirectionList = get_option($field->getSettingId());
        echo $this->render('admin/menu/redirection_field/show.html.php', [
            'title' => $field->getFieldTitle(),
            'redirectionList' => $redirectionList,
            'setting_id' => $field->getSettingId(),
        ]);
    }
}
