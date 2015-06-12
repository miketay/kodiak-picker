<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('students', $this->paginate($this->Students));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Tutorials']
        ]);
        $this->set('student', $student);
        $this->set('_serialize', ['student']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->data);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $tutorials = $this->Students->Tutorials->find('list', ['limit' => 200]);
        $this->set(compact('student', 'tutorials'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Tutorials']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->data);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $tutorials = $this->Students->Tutorials->find('list', ['limit' => 200]);
        $this->set(compact('student', 'tutorials'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
