<?php
declare(strict_types=1);

namespace CustomSettings\SettingTypes;


/**
 * @property string $name
 */
interface SettingTypeInterface
{
    /**
     * @return string
     */
    public function getTypeName(): string;
    
    /**
     * Value to save into database
     * 
     * @param mixed $input_value
     * @return string
     * @throws \CustomSettings\Exception\InvalidSettingTypeException
     */
    public function saveValue(mixed $input_value): ?string;
    
    /**
     * Value return from database and formatted
     * 
     * @param string $raw_value
     * @return mixed
     */
    public function getValue(string $raw_value): mixed;
    
    /**
     * Value to print like a string
     * 
     * @param string $raw_value
     * @return string
     */
    public function stringValue(?string $raw_value): string;
    
}
