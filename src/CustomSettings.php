<?php
declare(strict_types=1);

namespace CustomSettings;

use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use CustomSettings\Exception\DuplicateRegistryException;
use InvalidArgumentException;

class CustomSettings
{
    public const TYPE_STRING = 'string';
    public const TYPE_NUMERIC = 'numeric';
    public const TYPE_BOOLEAN = 'bool';
    public const TYPE_LIST = 'list';
    public const TYPE_JSON = 'json';

    public const RETURN_TYPE_ARRAY = 'all';
    public const RETURN_TYPE_ENTITY = 'entity';
    public const RETURN_TYPE_VALUE = 'value';
    public const RETURN_TYPE_STRING_VALUE = 'string_value';
    public const RETURN_TYPE_RAW_VALUE = 'raw_value';

    protected const DEFAULT_DATA = [
        'category' => null,
        'name' => null,
        'type' => self::TYPE_STRING,
        'value' => null,
        'options' => [],
    ];

    /**
     * @return array
     */
    public static function getTypeLabels(): array
    {
        $list = Configure::read('CustomSettings.settingTypesMap');
        $output = [];
        foreach ($list as $key => $item) {
            $output[$key] = $item['label'];
        }

        return $output;
    }
    
    /**
     * @param string|null $name
     * @param string|null $category
     * @return EntityInterface|array|null
     */
    public static function read(
        ?string $name = null,
        ?string $category = null,
        string $returnType = self::RETURN_TYPE_VALUE
    ): mixed
    {
        if (empty($name)) {
            return static::readAll();
        }

        $CustomSettings = TableRegistry::getTableLocator()->get('CustomSettings.CustomSettings');
        $entity = $CustomSettings->find('byName', [
            'name' => $name,
            'category' => $category,
            ])
            ->first();

        switch ($returnType) {
            case self::RETURN_TYPE_ENTITY:
                return $entity;
            case self::RETURN_TYPE_ARRAY:
                return $entity->toArray();
            case self::RETURN_TYPE_VALUE:
            case self::RETURN_TYPE_STRING_VALUE:
            case self::RETURN_TYPE_RAW_VALUE:
                return $entity->{$returnType};
        }

        throw new NotFoundException();
    }


    /**
     * @param EntityInterface|array $entity
     * @return EntityInterface|boolean
     */
	public static function write(EntityInterface|array $entity, bool $merge = true): EntityInterface|bool
    {
        $CustomSettings = TableRegistry::getTableLocator()->get('CustomSettings.CustomSettings');
        if (is_array($entity)) {
            $entity = static::getEntity($entity);
        }

        if (!$entity->isNew() && !$merge) {
            throw new DuplicateRegistryException('A record with the same category.name is already exist');
        }

        return $CustomSettings->save($entity);
    }

    /**
     * @param array $data
     * @return EntityInterface
     */
    public static function getEntity(array $data): EntityInterface
    {
        if (empty($data['name'])) {
            throw new InvalidArgumentException('The method ' . __METHOD__ . ' expects to receive "name" in $data array');
        }
        if (empty($data['value'])) {
            throw new InvalidArgumentException('The method ' . __METHOD__ . ' expects to receive "value" in $data array');
        }

        $CustomSettings = TableRegistry::getTableLocator()->get('CustomSettings.CustomSettings');
        $data = array_merge(static::DEFAULT_DATA, $data);

        if ($entity = static::read($data['name'], $data['category'], true)) {
            return $CustomSettings->patchEntity($entity, $data);
        }

        return $CustomSettings->newEntity($data);
    }

    /**
     * @param string|null $category
     * @return array
     */
    public static function readAll(): array
    {
        $CustomSettings = TableRegistry::getTableLocator()->get('CustomSettings.CustomSettings');
        $entities = $CustomSettings->find();

        $output = [];
        foreach ($entities as $item) {
            $output[$item->alias] = $item->toArray();
        }

        return $output;
    }

    /**
     * @param string|null $category
     * @return array
     */
	public static function category(?string $category = null): array
    {
        $CustomSettings = TableRegistry::getTableLocator()->get('CustomSettings.CustomSettings');
        $entities = $CustomSettings->find('byCategory', ['category' => $category]);

        $output = [];
        foreach ($entities as $item) {
            $output[$item->alias] = $item->toArray();
        }

        return $output;
    }

    public static function categories(): array
    {
        $CustomSettings = TableRegistry::getTableLocator()->get('CustomSettings.CustomSettings');
        
        return $CustomSettings->find('onlyCategories')->toList();
    }
}
