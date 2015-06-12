<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Tutorials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cycles'), ['controller' => 'Cycles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cycle'), ['controller' => 'Cycles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="tutorials form large-10 medium-9 columns">
    <?= $this->Form->create($tutorial) ?>
    <fieldset>
        <legend><?= __('Add Tutorial') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('cycle_id', ['options' => $cycles, 'empty' => true]);
            echo $this->Form->input('room_number');
            echo $this->Form->input('teacher_name');
            echo $this->Form->input('max_students');
            echo $this->Form->input('students._ids', ['options' => $students]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
