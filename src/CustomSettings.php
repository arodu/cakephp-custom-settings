<?php
declare(strict_types=1);

namespace CustomSettings;

use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
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

    protected const DEFAULT_DATA = [
        'category' => null,
        'name' => null,
        'type' => self::TYPE_STRING,
        'value' => null,
        'options' => [],
    ];

    public static function getTypeLabels(): array
    {
        $list = Configure::read('CustomSettings');
        $output = [];
        foreach ($list as $key => $item) {
            $output[$key] = $item['label'];
        }

        return $output;
    }
    
    /**
     * @param string $name
     * @param string|null $category
     * @return EntityInterface|null
     */
    public static function read(string $name, ?string $category = null): ?EntityInterface
    {
        $CustomSettings = TableRegistry::getTableLocator()->get('CustomSettings.CustomSettings');
        
        return $CustomSettings->find('name', [
                'name' => $name,
                'category' => $category,
            ])
            ->first();
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

        if ($entity = static::read($data['name'], $data['category'])) {
            return $CustomSettings->patchEntity($entity, $data);
        }

        return $CustomSettings->newEntity($data);
    }

    // @todo
	//public static function category($category=null): array<EntityInterface>
}
