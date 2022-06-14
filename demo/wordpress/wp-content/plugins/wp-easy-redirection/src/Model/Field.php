<?php

namespace WpEasyRedirection\Model;

class Field
{

    public function __construct(
        protected string $id,
        protected string $settingId,
        protected string $fieldTitle
    ) {
    }

    public function getFieldTitle(): string
    {
        return $this->fieldTitle;
    }

    public function setFieldTitle(string $fieldTitle)
    {
        $this->fieldTitle = $fieldTitle;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }


    public function getSettingId(): string
    {
        return $this->settingId;
    }


    public function setSettingId(string $settingId)
    {
        $this->settingId = $settingId;
    }
}
