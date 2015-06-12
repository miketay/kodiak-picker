<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tutorial Entity.
 */
class Tutorial extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'cycle_id' => true,
        'room_number' => true,
        'teacher_name' => true,
        'max_students' => true,
        'cycle' => true,
        'students' => true,
    ];
}
