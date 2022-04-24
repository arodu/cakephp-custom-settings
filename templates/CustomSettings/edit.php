<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customSetting
 */

use CustomSettings\CustomSettings;

?>
<div class="customSettings index content">
    <?= $this->Html->link(__('List Custom Settings'), ['action' => 'index'], ['class' => 'float-right']) ?>
    <h3><?= __('Edit Custom Setting') ?></h3>
    <div>
        <?= $this->Form->create($customSetting) ?>
        <?= $this->Form->control('name', ['disabled' => true]) ?>
        <?= $this->Form->control('type', [
            'options' => CustomSettings::getTypeLabels(),
            'empty' => true,
            'disabled' => true
        ]) ?>
        <?= $this->Form->control('value', [
            'type' => 'textarea',
            'value' => $customSetting->invalid_value ?? $customSetting->string_value,
        ]) ?>
        <?= $this->Form->control('category', ['disabled' => true]) ?>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
