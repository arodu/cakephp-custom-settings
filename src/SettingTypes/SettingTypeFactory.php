<?php
declare(strict_types=1);

namespace CustomSettings\SettingTypes;

use Cake\Core\Configure;
use CustomSettings\CustomSettings;

class SettingTypeFactory
{
    protected static function map(string $name): string
    {
        return Configure::read('CustomSettings.' . $name . '.class');
    }

    public static function get(string $name): SettingTypeInterface
    {
        return new (static::map($name))($name);
    }
}