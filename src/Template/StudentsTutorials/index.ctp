<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Students Tutorial'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tutorials'), ['controller' => 'Tutorials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tutorial'), ['controller' => 'Tutorials', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="studentsTutorials index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('tutorial_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($studentsTutorials as $studentsTutorial): ?>
        <tr>
            <td><?= $this->Number->format($studentsTutorial->id) ?></td>
            <td>
                <?= $studentsTutorial->has('student') ? $this->Html->link($studentsTutorial->student->id, ['controller' => 'Students', 'action' => 'view', $studentsTutorial->student->id]) : '' ?>
            </td>
            <td>
                <?= $studentsTutorial->has('tutorial') ? $this->Html->link($studentsTutorial->tutorial->name, ['controller' => 'Tutorials', 'action' => 'view', $studentsTutorial->tutorial->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $studentsTutorial->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $studentsTutorial->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $studentsTutorial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentsTutorial->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
