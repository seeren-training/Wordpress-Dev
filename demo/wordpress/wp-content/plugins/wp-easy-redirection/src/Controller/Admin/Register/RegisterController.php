<?php

namespace WpEasyRedirection\Controller\Admin\Register;

use WpEasyRedirection\Controller\Controller;

class RegisterController extends Controller
{

    public function register(): void
    {
        register_activation_hook(WP_EASY_REDIRECTION_FILE, [$this, 'activate']);
        register_deactivation_hook(WP_EASY_REDIRECTION_FILE, [$this, 'deactivate']);
    }

    public function activate(): void
    {
        $phpversion = phpversion();
        if ((int) $phpversion < 8) {
            wp_die($this->render('admin/register/register.html.php', [
                'phpversion' => $phpversion
            ]));
        }
        foreach (['mo', 'po'] as $extension) {
            $source = __DIR__ . '/../../../../languages/wp-easy-redirection-fr_FR.' . $extension;
            $destination = __DIR__ . '/../../../../../../languages/plugins/wp-easy-redirection-fr_FR.'  . $extension;
            copy($source, $destination);
        }
        flush_rewrite_rules();
    }

    public function deactivate(): void
    {
        flush_rewrite_rules();
    }
}
