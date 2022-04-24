<?php
declare(strict_types=1);

namespace CustomSettings\SettingTypes;

use CustomSettings\Model\Entity\CustomSetting;

abstract class AbstractSettingType implements SettingTypeInterface
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getTypeName(): string
    {
        return $this->name;
    }
}
