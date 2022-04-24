<?php
declare(strict_types=1);

namespace CustomSettings\Model\Entity;

use Cake\ORM\Entity;
use CustomSettings\Model\Entity\TypesTrait;

/**
 * CustomSetting Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $raw_value
 * @property string $type
 * @property string|null $category
 * @property string|null $options
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class CustomSetting extends Entity
{
    use TypesTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'raw_value' => true,
        'type' => true,
        'category' => true,
        'options' => true,
        'created' => true,
        'modified' => true,
    ];
}
