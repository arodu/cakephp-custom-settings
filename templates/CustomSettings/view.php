<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customSetting
 */

use CustomSettings\CustomSettings;

?>
<div class="customSettings index content">
    <?= $this->Html->link(__('List Custom Settings'), ['action' => 'index'], ['class' => 'float-right']) ?>
    <h3><?= $customSetting->alias ?></h3>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th style="width: 0;"><?= __('Name') ?></th>
                <td><?= h($customSetting->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Type') ?></th>
                <td><?= h($customSetting->type) ?></td>
            </tr>
            <tr>
                <th><?= __('Category') ?></th>
                <td><?= h($customSetting->category) ?? sprintf('<code>%s</code>', __('N/A')) ?></td>
            </tr>
            <tr>
                <th><?= __('Value') ?></th>
                <td><pre><?= $customSetting->string_value ?></pre></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($customSetting->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($customSetting->modified) ?></td>
            </tr>
        </table>
    </div>
</div>
