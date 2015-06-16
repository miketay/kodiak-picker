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
        $this->paginate = [
            'contain' => ['Cycles']
        ];
        $this->set('tutorials', $this->paginate($this->Tutorials));
        $this->set('_serialize', ['tutorials']);
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
        $tutorial = $this->Tutorials->get($id, [
            'contain' => ['Cycles', 'Students']
        ]);
        $this->set('tutorial', $tutorial);
        $this->set('_serialize', ['tutorial']);
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
			$message = "";
            $tutorial = $this->Tutorials->patchEntity($tutorial, $this->request->data);
            if ($this->Tutorials->save($tutorial)) {
				$message = 'Saved';
            } else {
				$message = $tutorial->errors();
			}
			$this->set([
				'message' => $message,
				'tutorial' => $tutorial,
				'_serialize' => ['message', 'tutorial']
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
            if ($this->Tutorials->save($tutorial)) {
                $this->Flash->success(__('The tutorial has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tutorial could not be saved. Please, try again.'));
            }
        }
        $cycles = $this->Tutorials->Cycles->find('list', ['limit' => 200]);
        $students = $this->Tutorials->Students->find('list', ['limit' => 200]);
        $this->set(compact('tutorial', 'cycles', 'students'));
        $this->set('_serialize', ['tutorial']);
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
        if ($this->Tutorials->delete($tutorial)) {
            $this->Flash->success(__('The tutorial has been deleted.'));
        } else {
            $this->Flash->error(__('The tutorial could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
