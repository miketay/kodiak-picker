<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
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
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$message = __("User added");
            $user = $this->Users->patchEntity($user, $this->request->data);
            if (!$this->Users->save($user)) {
				$message = __("User could not be added");
			}
			$this->set([
				'message' => $message,
				'user' => $user,
				'_serialize' => ['message','user']
			]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$message = __("User saved");
            $user = $this->Users->patchEntity($user, $this->request->data);
            if (!$this->Users->save($user)) {
				$message = __("User could not be saved");
			}
			$this->set([
				'message' => $message,
				'user' => $user,
				'_serialize' => ['message','user']
			]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		$message = __("User deleted");
        if (!$this->Users->delete($user)) {
			$message = __("User could not be deleted");
        }
		$this->set([
			'message' => $message,
			'_serialize' => ['message']
		]);
    }
}
