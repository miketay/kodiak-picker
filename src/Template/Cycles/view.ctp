<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Cycle'), ['action' => 'edit', $cycle->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cycle'), ['action' => 'delete', $cycle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cycle->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cycles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cycle'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tutorials'), ['controller' => 'Tutorials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tutorial'), ['controller' => 'Tutorials', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="cycles view large-10 medium-9 columns">
    <h2><?= h($cycle->name) ?></h2>
    <div class="row">
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($cycle->id) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <?= $this->Text->autoParagraph(h($cycle->name)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Status') ?></h6>
            <?= $this->Text->autoParagraph(h($cycle->status)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tutorials') ?></h4>
    <?php if (!empty($cycle->tutorials)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Cycle Id') ?></th>
            <th><?= __('Room Number') ?></th>
            <th><?= __('Teacher Name') ?></th>
            <th><?= __('Max Students') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($cycle->tutorials as $tutorials): ?>
        <tr>
            <td><?= h($tutorials->id) ?></td>
            <td><?= h($tutorials->name) ?></td>
            <td><?= h($tutorials->cycle_id) ?></td>
            <td><?= h($tutorials->room_number) ?></td>
            <td><?= h($tutorials->teacher_name) ?></td>
            <td><?= h($tutorials->max_students) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Tutorials', 'action' => 'view', $tutorials->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Tutorials', 'action' => 'edit', $tutorials->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tutorials', 'action' => 'delete', $tutorials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tutorials->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
