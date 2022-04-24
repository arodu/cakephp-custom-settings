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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customSetting->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customSetting->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Custom Settings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="customSettings form content">
            <?= $this->Form->create($customSetting) ?>
            <fieldset>
                <legend><?= __('Edit Custom Setting') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('value');
                    echo $this->Form->control('type');
                    echo $this->Form->control('category');
                    echo $this->Form->control('options');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
