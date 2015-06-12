<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudentsTutorials Controller
 *
 * @property \App\Model\Table\StudentsTutorialsTable $StudentsTutorials
 */
class StudentsTutorialsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Tutorials']
        ];
        $this->set('studentsTutorials', $this->paginate($this->StudentsTutorials));
        $this->set('_serialize', ['studentsTutorials']);
    }

    /**
     * View method
     *
     * @param string|null $id Students Tutorial id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentsTutorial = $this->StudentsTutorials->get($id, [
            'contain' => ['Students', 'Tutorials']
        ]);
        $this->set('studentsTutorial', $studentsTutorial);
        $this->set('_serialize', ['studentsTutorial']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentsTutorial = $this->StudentsTutorials->newEntity();
        if ($this->request->is('post')) {
            $studentsTutorial = $this->StudentsTutorials->patchEntity($studentsTutorial, $this->request->data);
            if ($this->StudentsTutorials->save($studentsTutorial)) {
                $this->Flash->success(__('The students tutorial has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The students tutorial could not be saved. Please, try again.'));
            }
        }
        $students = $this->StudentsTutorials->Students->find('list', ['limit' => 200]);
        $tutorials = $this->StudentsTutorials->Tutorials->find('list', ['limit' => 200]);
        $this->set(compact('studentsTutorial', 'students', 'tutorials'));
        $this->set('_serialize', ['studentsTutorial']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Students Tutorial id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentsTutorial = $this->StudentsTutorials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentsTutorial = $this->StudentsTutorials->patchEntity($studentsTutorial, $this->request->data);
            if ($this->StudentsTutorials->save($studentsTutorial)) {
                $this->Flash->success(__('The students tutorial has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The students tutorial could not be saved. Please, try again.'));
            }
        }
        $students = $this->StudentsTutorials->Students->find('list', ['limit' => 200]);
        $tutorials = $this->StudentsTutorials->Tutorials->find('list', ['limit' => 200]);
        $this->set(compact('studentsTutorial', 'students', 'tutorials'));
        $this->set('_serialize', ['studentsTutorial']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Students Tutorial id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentsTutorial = $this->StudentsTutorials->get($id);
        if ($this->StudentsTutorials->delete($studentsTutorial)) {
            $this->Flash->success(__('The students tutorial has been deleted.'));
        } else {
            $this->Flash->error(__('The students tutorial could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
