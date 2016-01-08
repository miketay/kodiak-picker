<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
		$status = isset($this->request->params['status']) ? $this->request->params['status'] : "Open";
		$status = ucfirst(strtolower($status));
		$students = $this->Students->find('all');
		if (isset($this->request->params['tutorial_id'])) {
			$students->matching('Tutorials', function($q) {
				return $q->where(['Tutorials.id' => $this->request->params['tutorial_id']]);
			});
		} else {
			$students->contain(['Tutorials'=> function($q) use ($status) {
				return $q->matching('Cycles', function($q) use ($status) {
					return $q->where(['Cycles.status' => $status]);
				});
			}]);
		}
		$this->set([
			'students' => $students
		]);
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
			'contain' => ['Tutorials' => function($q) {
				return $q->contain('Cycles');
			}]
        ]);
        $this->set('student', $student);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
	{
		$this->request->allowMethod(['post']);
		$student = $this->Students->newEntity();
		$student = $this->Students->patchEntity($student, $this->request->data);
		if (!$this->Students->save($student)) {
			throw new \Cake\Network\Exception\BadRequestException();
		}
		$this->set([
			'student' => $student,
		]);
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
        $this->request->allowMethod(['put']);
		$student = $this->Students->get($id);
		$student = $this->Students->patchEntity($student, $this->request->data);
		if (!$this->Students->save($student)) {
			throw new \Cake\Network\Exception\BadRequestException();
		}
		$this->set([
			'student' => $student,
		]);
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
		if (isset($this->request->params['tutorial_id'])) {
			return $this->unregister($id);
		}
		$student = $this->Students->get($id);
        if (!$this->Students->delete($student)) {
			throw new \Cake\Network\Exception\BadRequestException();
        }
	}

	public function import()
	{
		// get file and parse it into db
		$file = $this->request->input();
		$listStart = strpos($file, "last_name\tfirst_name\tgrade_level\tStudent_Number");
		if ($listStart === false) {
			throw new \Cake\Network\Exception\BadRequestException("Malformed File");
		}
		$file = substr($file, $listStart);
		$file = str_replace("\r\n","\n", $file);
		$file = str_replace("\r","\n", $file);
		$file = explode("\n", $file);

		$this->Students->connection()->transactional(function() use ($file) {
			$rows = count($file);
			$headers = explode("\t", $file[0]);
			for ($i = 1; $i<$rows; $i++) {
				$row = explode("\t", $file[$i]);
				if (count($row) <= 1) {
					break;
				}
				$num = count($row);
				$student = [];
				for ($j = 0; $j<$num; $j++) {
					$header = $headers[$j] == "Student_Number" ? "id" : $headers[$j];
					$student[$header] = is_numeric($row[$j]) ? intval($row[$j]) : $row[$j];
				}
				// cake 3 doesn't have a saveAll that checks for existing records
				// so we have to do it indiviually
				$student = $this->Students->newEntity($student, [
					'accessibleFields' => ['id' => true]
				]);
				if (!$this->Students->save($student)) {
					throw new \Cake\Network\Exception\InternalErrorException("Couldn't save student {$student['id']}");
				}
			}
		});

		$this->set([
			'message' => "Success",
			'_serialize' => ['message']
		]);
	}

	public function register($id = null) {
		$this->request->allowMethod(['post']);
		$student = $this->Students->get($id, [
			'contain' => ['Tutorials']
		]);
		$lock = !!$this->request->data('lock');
		$tutorial_id = $this->request->params['tutorial_id'];
		$tutorial = $this->Students->Tutorials->get($tutorial_id, [
			'contain' => ['Students']
		]);
		if (!$this->request->session()->read('admin') && count($tutorial['students']) >= $tutorial['max_students']) {
			throw new \Cake\Network\Exception\BadRequestException("full");
		}
		// see if they are already registered for a tutorial in this cycle
		// delete it if they are
		foreach ($student['tutorials'] as $regTutorial) {
			if ($regTutorial['cycle_id'] == $tutorial['cycle_id']) {
				// delete the current one if it's not locked
				$locked = $regTutorial['_joinData']['locked'];
				if ($lock || !$locked) {
					$this->Students->Tutorials->unlink($student, [$regTutorial]);
				} else {
					throw new \Cake\Network\Exception\ForbiddenException("locked");
				}
				break;
			}
		}
		// create a new one
		$tutorial->_joinData = $this->Students->Tutorials->StudentsTutorials->newEntity();
		$tutorial->_joinData->locked = $lock;

		if (!$this->Students->Tutorials->link($student, [$tutorial])) {
			throw new \Cake\Network\Exception\BadRequestException();
		}

		$this->set([
			'student' => $student
		]);
	}

	public function unregister($id = null) {
		$student = $this->Students->get($id);
		$tutorial = $this->Students->Tutorials->get($this->request->params['tutorial_id']);
		try {
			$this->Students->Tutorials->unlink($student, [$tutorial]);
		} catch (Exception $e) {
			throw new \Cake\Network\Exception\BadRequestException($e->getMessage());
		}
	}

	public function login() {
		$data = $this->request->data('student');
		// first see if it's an admin
		if ($data['first_name'] == "admin") {
			if ($this->request->data('password') == ADMIN_PASSWORD) {
				$session = $this->request->session();
				$session->write('admin', true);
				$data['type'] = "admin";
				$this->set([
					'student' => $data
				]);
			} else {
				throw new \Cake\Network\Exception\ForbiddenException();
			}
		} else if ($data['first_name'] == "teacher") {
			if ($this->request->data('password') == TEACHER_PASSWORD) {
				$data['type'] = "teacher";
				$this->request->session()->write('admin', false);
				$this->set([
					'student' => $data
				]);
			} else {
				throw new \Cake\Network\Exception\ForbiddenException();
			}
		} else {
			// then attempt to login a student
			$student = $data;
			$this->request->session()->write('admin', false);
			unset($student['full_name']);
			unset($student['tutorials']);
			$password = $this->request->data('password');
			//$realStudent = $this->Students->get($password);
			$realStudent = $this->Students->find()
				->where(['Students.id' => $password])
				->contain(['Tutorials' => function($q) {
					return $q->contain('Cycles');
				}])
				->first();
			// okay if we made it this far it's a real student
			// now to see if they put the password in correctly
			foreach ($student as $key => $value) {
				if ($realStudent[$key] != $student[$key]) {
					throw new \Cake\Network\Exception\ForbiddenException();
				}
			}
			$realStudent['type'] = "student";
			$this->set([
				'student' => $realStudent
			]);
		}
	}

}
