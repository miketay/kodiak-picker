<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentsTutorial Entity.
 */
class StudentsTutorial extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'student_id' => true,
        'tutorial_id' => true,
        'student' => true,
        'tutorial' => true,
    ];
}
