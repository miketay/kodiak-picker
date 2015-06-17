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
			$message = __("Student added");
            $student = $this->Students->patchEntity($student, $this->request->data);
            if (!$this->Students->save($student)) {
				$message = __("Student could not be added");
            }
			$this->set([
				'message' => $message,
				'student' => $student,
				'_serialize' => ['message','student']
			]);
        }
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
			$message = __("Student saved");
            if (!$this->Students->save($student)) {
				$message = __("Student could not be saved");
			}
			$this->set([
				'message' => $message,
				'student' => $student,
				'_serialize' => ['message', 'student']
			]);
        }
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
        $this->request->allowMethod(['delete']);
		$student = $this->Students->get($id);
		$message = __("Student Deleted");
        if (!$this->Students->delete($student)) {
			$message = __("Student could not be deleted");
        }
		$this->set([
			'message' => $message,
			'_serialize' => ['message']
		]);
    }
}
