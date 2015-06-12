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

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('cycles', $this->paginate($this->Cycles));
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
            $cycle = $this->Cycles->patchEntity($cycle, $this->request->data);
            if ($this->Cycles->save($cycle)) {
                $this->Flash->success(__('The cycle has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cycle could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cycle'));
        $this->set('_serialize', ['cycle']);
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
            if ($this->Cycles->save($cycle)) {
                $this->Flash->success(__('The cycle has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cycle could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cycle'));
        $this->set('_serialize', ['cycle']);
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
        $this->request->allowMethod(['post', 'delete']);
        $cycle = $this->Cycles->get($id);
        if ($this->Cycles->delete($cycle)) {
            $this->Flash->success(__('The cycle has been deleted.'));
        } else {
            $this->Flash->error(__('The cycle could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
