<?php
declare(strict_types=1);

namespace CustomSettings\Types;

use CustomSettings\Exception\InvalidSettingTypeException;

class StringType extends AbstractSettingType
{

    /**
     * @param mixed $input_value
     * @return string
     * @throws InvalidSettingTypeException
     */
    public function saveValue(mixed $input_value): ?string
    {
        if (is_string($input_value) || is_null($input_value)) {
            return $input_value;
        }

        throw new InvalidSettingTypeException(__('Value must be string type'));
    }

    public function getValue(string $raw_value): mixed
    {
        if (empty($raw_value)) {
            return null;
        }

        return $raw_value;
    }

    public function stringValue(?string $raw_value): string
    {
        return $this->getValue($raw_value) ?? '';
    }
}
