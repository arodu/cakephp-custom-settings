<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $customSettings
 */
?>
<div class="customSettings index content">
    <?= $this->Html->link(__('New Custom Setting'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Custom Settings') ?></h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('category') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= __('Value') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customSettings as $customSetting): ?>
                <tr>
                    <td><?= h($customSetting->category) ?></td>
                    <td><?= h($customSetting->name) ?></td>
                    <td><?= h($customSetting->type) ?></td>
                    <td><?= h($customSetting->string_value) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $customSetting->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customSetting->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customSetting->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
