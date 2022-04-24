<?php
declare(strict_types=1);

namespace CustomSettings\Exception;

use Cake\Core\Exception\CakeException;

class InvalidSettingTypeException extends CakeException
{
    protected $_defaultCode = 403;
}