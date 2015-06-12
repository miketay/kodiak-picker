<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cycle Entity.
 */
class Cycle extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'status' => true,
        'tutorials' => true,
    ];
}
