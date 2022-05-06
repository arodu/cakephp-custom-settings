<?php
declare(strict_types=1);

namespace CustomSettings\SettingTypes;

use Cake\Core\Configure;

class SettingTypeFactory
{
    protected static function className(string $name): string
    {
        return Configure::read('CustomSettings.settingTypesMap.' . $name . '.class');
    }

    public static function get(string $name): SettingTypeInterface
    {
        return new (static::className($name))($name);
    }
}