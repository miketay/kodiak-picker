<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Students Tutorial'), ['action' => 'edit', $studentsTutorial->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Students Tutorial'), ['action' => 'delete', $studentsTutorial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentsTutorial->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Students Tutorials'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Students Tutorial'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tutorials'), ['controller' => 'Tutorials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tutorial'), ['controller' => 'Tutorials', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="studentsTutorials view large-10 medium-9 columns">
    <h2><?= h($studentsTutorial->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Student') ?></h6>
            <p><?= $studentsTutorial->has('student') ? $this->Html->link($studentsTutorial->student->id, ['controller' => 'Students', 'action' => 'view', $studentsTutorial->student->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Tutorial') ?></h6>
            <p><?= $studentsTutorial->has('tutorial') ? $this->Html->link($studentsTutorial->tutorial->name, ['controller' => 'Tutorials', 'action' => 'view', $studentsTutorial->tutorial->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($studentsTutorial->id) ?></p>
        </div>
    </div>
</div>
