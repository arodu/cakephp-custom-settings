<?php

return [
    'CustomSettings' => [
        'table' => 'custom_settings',
        'settingTypesMap' => [
            \CustomSettings\CustomSettings::TYPE_STRING => [
                'label' => __('String'),
                'class' => \CustomSettings\SettingTypes\StringType::class,
            ],
            \CustomSettings\CustomSettings::TYPE_JSON => [
                'label' => __('JSON'),
                'class' => \CustomSettings\SettingTypes\JsonType::class,
            ],
        ]
    ],
];