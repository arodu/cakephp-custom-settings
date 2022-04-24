<?php

return [
    'CustomSettings' => [
        \CustomSettings\CustomSettings::TYPE_STRING => [
            'label' => __('String'),
            'class' => \CustomSettings\Types\StringType::class,
        ],
        \CustomSettings\CustomSettings::TYPE_JSON => [
            'label' => __('JSON'),
            'class' => \CustomSettings\Types\JsonType::class,
        ],
    ],
];