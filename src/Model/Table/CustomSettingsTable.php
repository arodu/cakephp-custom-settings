<?php
declare(strict_types=1);

namespace CustomSettings\Model\Table;

use ArrayObject;
use Cake\Core\InstanceConfigTrait;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CustomSettings\CustomSettings;
use CustomSettings\Exception\ForbiddenDeleteException;
use CustomSettings\Model\Entity\CustomSetting;
use CustomSettings\SettingTypes\TypeFactory;
use InvalidArgumentException;

/**
 * CustomSettings Model
 *
 * @method \CustomSettings\Model\Entity\CustomSetting newEmptyEntity()
 * @method \CustomSettings\Model\Entity\CustomSetting newEntity(array $data, array $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting[] newEntities(array $data, array $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting get($primaryKey, $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \CustomSettings\Model\Entity\CustomSetting[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomSettingsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('custom_settings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('json_value')
            ->allowEmptyString('json_value');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('category')
            ->maxLength('category', 255)
            ->allowEmptyString('category');

        $validator
            ->scalar('json_options')
            ->allowEmptyString('json_options');

        return $validator;
    }

    public function findByName(Query $query, array $options = []): Query
    {
        if (empty($options['name'])) {
            throw new InvalidArgumentException('The method "findName" expects to receive "name" in $options array');
        }
        $query->where([$this->aliasField('name') => $options['name']]);
        $query->find('byCategory', $options);

        return $query;
    }

    public function findByCategory(Query $query, array $options = []): Query
    {
        if (empty($options['category'])) {
            $query->whereNull(['category']);
        } else {
            $query->where([$this->aliasField('category') => $options['category']]);
        }

        return $query;
    }

    //public function getCategories(): array
    public function findOnlyCategories(Query $query, array $options = []): Query
    {
        return $query
            ->select([$this->aliasField('category')])
            ->distinct($this->aliasField('category'))
            ->find('list', [
                'valueField' => 'category',
            ]);
    }

    /**
     * Undocumented function
     *
     * @param EventInterface $event
     * @param EntityInterface|CustomSetting $entity
     * @param ArrayObject $options
     * @return void
     */
    public function afterMarshal(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $entity->raw_value = $entity->typeObject()->saveValue($options['value']);
        
        if (empty($entity->category)) {
            $entity->category = null;
        }
    }

    public function beforeDelete(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        if (!$entity->can_delete) {
            throw new ForbiddenDeleteException('Cannot be deleted if can_delete field is active');
        }
    }

}
