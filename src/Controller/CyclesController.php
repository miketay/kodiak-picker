<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cycles Controller
 *
 * @property \App\Model\Table\CyclesTable $Cycles
 */
class CyclesController extends AppController
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
		$cycles = $this->Cycles->find('all');
        $this->set('cycles', $cycles);
        $this->set('_serialize', ['cycles']);
    }

    /**
     * View method
     *
     * @param string|null $id Cycle id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cycle = $this->Cycles->get($id, [
            'contain' => ['Tutorials']
        ]);
        $this->set('cycle', $cycle);
        $this->set('_serialize', ['cycle']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cycle = $this->Cycles->newEntity();
		if ($this->request->is('post')) {
			$message = __("Cycle has been saved");
            $cycle = $this->Cycles->patchEntity($cycle, $this->request->data);
            if (!$this->Cycles->save($cycle)) {
				$message = __("Cycle could not be saved");
            }
        }
		$this->set([
			'message' => $message,
			'cycle' => $cycle,
			'_serialize' => ['message', 'cycle']
		]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cycle id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cycle = $this->Cycles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$cycle = $this->Cycles->patchEntity($cycle, $this->request->data);
			$message = __("Cycle has been saved");
            if (!$this->Cycles->save($cycle)) {
				$message = __("Cycle could not be saved");
            }
		}
		$this->set([
			'message' => $message,
			'cycle' => $cycle,
			'_serialize' => ['message', 'cycle']
		]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cycle id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
		$cycle = $this->Cycles->get($id);
		$message = __("Cycle has been deleted");
        if (!$this->Cycles->delete($cycle)) {
			$message = __("Cycle could not be saved");
        }
		$this->set([
			'message' => $message,
			'_serialize' => ['message']
		]);
    }
}
