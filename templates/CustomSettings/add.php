<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customSetting
 */

use CustomSettings\CustomSettings;

?>

<div class="row">
    <div>
        <?= $this->Html->link(__('List Custom Settings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
</div>

<div class="row">
    <div class="column-responsive column-80">
        <div class="customSettings form content">
            <?= $this->Form->create($customSetting) ?>
            <fieldset>
                <legend><?= __('Add Custom Setting') ?></legend>
                <?php
                echo $this->Form->control('name');
                echo $this->Form->control('type', ['options' => CustomSettings::getTypeLabels(), 'empty' => true]);
                echo $this->Form->control('value', ['type' => 'text', 'label' => __('Value')]);
                echo $this->Form->control('category');
                //echo $this->Form->control('options');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>



