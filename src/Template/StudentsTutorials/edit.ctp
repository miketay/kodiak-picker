<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $studentsTutorial->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $studentsTutorial->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Students Tutorials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tutorials'), ['controller' => 'Tutorials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tutorial'), ['controller' => 'Tutorials', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="studentsTutorials form large-10 medium-9 columns">
    <?= $this->Form->create($studentsTutorial) ?>
    <fieldset>
        <legend><?= __('Edit Students Tutorial') ?></legend>
        <?php
            echo $this->Form->input('student_id', ['options' => $students, 'empty' => true]);
            echo $this->Form->input('tutorial_id', ['options' => $tutorials, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
