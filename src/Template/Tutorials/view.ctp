<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Tutorial'), ['action' => 'edit', $tutorial->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tutorial'), ['action' => 'delete', $tutorial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorial->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tutorials'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tutorial'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cycles'), ['controller' => 'Cycles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cycle'), ['controller' => 'Cycles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="tutorials view large-10 medium-9 columns">
    <h2><?= h($tutorial->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Cycle') ?></h6>
            <p><?= $tutorial->has('cycle') ? $this->Html->link($tutorial->cycle->name, ['controller' => 'Cycles', 'action' => 'view', $tutorial->cycle->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($tutorial->id) ?></p>
            <h6 class="subheader"><?= __('Teacher Name') ?></h6>
            <p><?= $this->Number->format($tutorial->teacher_name) ?></p>
            <h6 class="subheader"><?= __('Max Students') ?></h6>
            <p><?= $this->Number->format($tutorial->max_students) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <?= $this->Text->autoParagraph(h($tutorial->name)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Room Number') ?></h6>
            <?= $this->Text->autoParagraph(h($tutorial->room_number)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Students') ?></h4>
    <?php if (!empty($tutorial->students)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('First Name') ?></th>
            <th><?= __('Last Name') ?></th>
            <th><?= __('Grade Level') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($tutorial->students as $students): ?>
        <tr>
            <td><?= h($students->id) ?></td>
            <td><?= h($students->first_name) ?></td>
            <td><?= h($students->last_name) ?></td>
            <td><?= h($students->grade_level) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
