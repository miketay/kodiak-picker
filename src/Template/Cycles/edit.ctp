<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cycle->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cycle->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cycles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tutorials'), ['controller' => 'Tutorials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tutorial'), ['controller' => 'Tutorials', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="cycles form large-10 medium-9 columns">
    <?= $this->Form->create($cycle) ?>
    <fieldset>
        <legend><?= __('Edit Cycle') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
