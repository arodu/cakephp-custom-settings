<?php
declare(strict_types=1);

namespace CustomSettings\Types;

interface SettingTypeInterface
{
    /**
     * @return string
     */
    public function getTypeName(): string;
    
    /**
     * @param mixed $input_value
     * @return string
     * @throws \CustomSettings\Exception\InvalidSettingTypeException
     */
    public function saveValue(mixed $input_value): ?string;
    
    /**
     * @param string $raw_value
     * @return mixed
     */
    public function getValue(string $raw_value): mixed;
    
    /**
     * @param string $raw_value
     * @return string
     */
    public function stringValue(?string $raw_value): string;
}
