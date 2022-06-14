<?php

namespace WpEasyRedirection\Model;

class Menu
{

    public const CAPABILITY = 'manage_options';

    private string $menuTitle;

    public function __construct(
        private string $slug,
        private string $pageTitle
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
