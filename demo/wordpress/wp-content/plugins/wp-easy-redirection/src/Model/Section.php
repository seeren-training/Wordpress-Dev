<?php

namespace WpEasyRedirection\Model;

class Section
{

    public function __construct(
        protected string $id,
        protected string $sectionTitle
    ) {
    }

    public function getSectionTitle(): string
    {
        return $this->sectionTitle;
    }

    public function setSectionTitle(string $sectionTitle)
    {
        $this->sectionTitle = $sectionTitle;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }
}
