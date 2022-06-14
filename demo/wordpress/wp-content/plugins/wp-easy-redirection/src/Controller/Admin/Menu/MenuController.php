<?php

namespace WpEasyRedirection\Controller\Admin\Menu;

use WpEasyRedirection\Controller\Controller;

class MenuController extends Controller
{

    public const CAPABILITY = 'manage_options';

    public function __construct(
        protected string $slug,
        protected string $pageTitle
    ) {
        $this->menuTitle = $this->pageTitle;
    }

    public function getMenuTitle(): string
    {
        return $this->menuTitle;
    }

    public function setMenuTitle(string $menuTitle)
    {
        $this->menuTitle = $menuTitle;
    }

    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    public function setPageTitle(string $pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }
}
