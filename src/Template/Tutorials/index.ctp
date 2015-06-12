<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Tutorial'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cycles'), ['controller' => 'Cycles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cycle'), ['controller' => 'Cycles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="tutorials index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('cycle_id') ?></th>
            <th><?= $this->Paginator->sort('teacher_name') ?></th>
            <th><?= $this->Paginator->sort('max_students') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tutorials as $tutorial): ?>
        <tr>
            <td><?= $this->Number->format($tutorial->id) ?></td>
            <td>
                <?= $tutorial->has('cycle') ? $this->Html->link($tutorial->cycle->name, ['controller' => 'Cycles', 'action' => 'view', $tutorial->cycle->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($tutorial->teacher_name) ?></td>
            <td><?= $this->Number->format($tutorial->max_students) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $tutorial->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tutorial->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tutorial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorial->id)]) ?>
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
