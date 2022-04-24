<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customSetting
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Custom Setting'), ['action' => 'edit', $customSetting->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Custom Setting'), ['action' => 'delete', $customSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customSetting->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Custom Settings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Custom Setting'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="customSettings view content">
            <h3><?= h($customSetting->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($customSetting->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($customSetting->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= h($customSetting->category) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($customSetting->id) ?></td>
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
            <div class="text">
                <strong><?= __('Value') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customSetting->value)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Options') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customSetting->options)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
