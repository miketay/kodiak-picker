<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Cycle'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tutorials'), ['controller' => 'Tutorials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tutorial'), ['controller' => 'Tutorials', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="cycles index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cycles as $cycle): ?>
        <tr>
            <td><?= $this->Number->format($cycle->id) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $cycle->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cycle->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cycle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cycle->id)]) ?>
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
