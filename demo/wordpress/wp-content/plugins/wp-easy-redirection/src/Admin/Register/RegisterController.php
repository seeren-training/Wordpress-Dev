<?php

namespace WpEasyRedirection\Admin\Register;

use WpEasyRedirection\Controller;

class RegisterController extends Controller
{

    public function __construct(private string $filename)
    {
    }

    public function register(): void
    {
        register_activation_hook($this->filename, [$this, 'activate']);
        register_deactivation_hook($this->filename, [$this, 'deactivate']);
    }

    public function activate(): void
    {
        $phpversion = phpversion();
        if ((int) $phpversion < 8) {
            wp_die($this->render('admin/activate.html.php', [
                'phpversion' => $phpversion
            ]));
        }
        flush_rewrite_rules();
    }

    public function deactivate(): void
    {
        flush_rewrite_rules();
    }
}
