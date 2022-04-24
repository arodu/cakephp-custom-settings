<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customSetting
 */

use CustomSettings\CustomSettings;

?>
<div class="customSettings index content">
    <?= $this->Html->link(__('List Custom Settings'), ['action' => 'index'], ['class' => 'float-right']) ?>
    <h3><?= __('Add Custom Setting') ?></h3>
    <div>
        <?= $this->Form->create($customSetting) ?>
        <?= $this->Form->control('category') ?>
        <?= $this->Form->control('name') ?>
        <?= $this->Form->control('type', ['options' => CustomSettings::getTypeLabels(), 'empty' => true]) ?>
        <?= $this->Form->control('value', ['type' => 'textarea']) ?>
        <?= $this->Form->control('can_delete', ['value' => false]) ?>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
