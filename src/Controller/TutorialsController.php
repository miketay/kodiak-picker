<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tutorials Controller
 *
 * @property \App\Model\Table\TutorialsTable $Tutorials
 */
class TutorialsController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

    /**
     * Index method
     *
     * @return void
     */
    public function index()
	{
		$tutorials = $this->Tutorials->find('all')
			->contain('Students');
		if (isset($this->request->params['cycle_id'])) {
			$cycleId = $this->request->params['cycle_id'];
			if ($cycleId == 0) {
				$tutorials->matching('Cycles', function($q) {
					return $q->where(['Cycles.status' => "Open"]);
				});
			} else {
				$tutorials->where(['cycle_id'=>$cycleId]);
			}
		}
		$this->set([
			'tutorials' => $tutorials,
		]);
    }

    /**
     * View method
     *
     * @param string|null $id Tutorial id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
	{
		$conditions = [];
		if (isset($this->request->params['cycle_id'])) {
			$conditions['cycle_id'] = $this->request->params['cycle_id'];
		} elseif (isset($this->request->params['student_id'])) {
			$conditions['student_id'] = $this->request->params['student_id'];
		}
		$tutorial = $this->Tutorials->get($id, [
			'conditions' => $conditions,
            'contain' => ['Cycles', 'Students']
        ]);
        $this->set('tutorial', $tutorial);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$tutorial = $this->Tutorials->newEntity();
		if ($this->request->is('post')) {
			$this->request->data['cycle_id'] = $this->request->params['cycle_id'];
            $tutorial = $this->Tutorials->patchEntity($tutorial, $this->request->data);
            if (!$this->Tutorials->save($tutorial)) {
				throw new \Cake\Network\Exception\BadRequestException($tutorial->errors()[0]);
            }
			$this->set([
				'tutorial' => $tutorial,
			]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Tutorial id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tutorial = $this->Tutorials->get($id, [
            'contain' => ['Students']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$tutorial = $this->Tutorials->patchEntity($tutorial, $this->request->data);
            if (!$this->Tutorials->save($tutorial)) {
				throw new \Cake\Network\Exception\BadRequestException();
			}
		}
		$this->set([
			'tutorial' => $tutorial,
		]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tutorial id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
		$tutorial = $this->Tutorials->get($id);
        if (!$this->Tutorials->delete($tutorial)) {
			throw new \Cake\Network\Exception\BadRequestException();
		}
	}
}

