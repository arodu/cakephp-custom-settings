<?php
declare(strict_types=1);

namespace CustomSettings\Types;

use CustomSettings\Exception\InvalidSettingTypeException;

class JsonType extends AbstractSettingType
{
    protected $_lastError = null;

    public function saveValue(mixed $input_value): string
    {
        if (empty($input_value)) {
            return json_encode([]);
        }

        if ($this->isJson($input_value)) {
            return $input_value;
        }

        throw new InvalidSettingTypeException($this->errorMessage());
    }

    public function getValue(string $raw_value): mixed
    {
        if (empty($raw_value)) {
            return null;
        }

        return json_decode($raw_value, true);
    }

    public function stringValue(?string $raw_value): string
    {
        return json_encode($this->getValue($raw_value), JSON_PRETTY_PRINT) ?? '';
    }


    protected function isJson(string $string): bool
    {
        json_decode($string);
        $this->_lastError = json_last_error();

        return $this->_lastError === JSON_ERROR_NONE;
    }

    protected function errorMessage(): ?string
    {
        $errors = [
            JSON_ERROR_NONE => null, // No error
            JSON_ERROR_DEPTH => __('The maximum stack depth has been exceeded.'),
            JSON_ERROR_STATE_MISMATCH => __('Invalid or malformed JSON.'),
            JSON_ERROR_CTRL_CHAR => __('Control character error, possibly incorrectly encoded.'),
            JSON_ERROR_SYNTAX => __('Syntax error, malformed JSON.'),
            JSON_ERROR_UTF8 => __('Malformed UTF-8 characters, possibly incorrectly encoded.'),
            JSON_ERROR_RECURSION => __('One or more recursive references in the value to be encoded.'),
            JSON_ERROR_INF_OR_NAN => __('One or more NAN or INF values in the value to be encoded.'),
            JSON_ERROR_UNSUPPORTED_TYPE => __('A value of a type that cannot be encoded was given.'),
        ];

        if (in_array($this->_lastError, array_keys($errors))) {
            return $errors[$this->_lastError];
        }

        return __('Unknown JSON error occured.');
    }
}
