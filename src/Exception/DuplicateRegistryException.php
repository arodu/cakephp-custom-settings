<?php
declare(strict_types=1);

namespace CustomSettings\Exception;

use Cake\Core\Exception\CakeException;
use Throwable;

class DuplicateRegistryException extends CakeException
{
    protected $_defaultCode = 403;
}