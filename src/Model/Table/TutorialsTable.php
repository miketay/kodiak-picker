<?php
namespace App\Model\Table;

use App\Model\Entity\Tutorial;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tutorials Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cycles
 * @property \Cake\ORM\Association\BelongsToMany $Students
 */
class TutorialsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('tutorials');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Cycles', [
            'foreignKey' => 'cycle_id'
        ]);
        $this->belongsToMany('Students', [
			'through' => 'StudentsTutorials'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->allowEmpty('name');
            
		$validator
            ->allowEmpty('room_number');
            
        $validator
            ->allowEmpty('teacher_name');
            
        $validator
            ->add('max_students', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('max_students');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['cycle_id'], 'Cycles'));
        return $rules;
    }
}
