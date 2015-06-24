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
		$students = $this->Students->find('all');
		if (isset($this->request->params['tutorial_id'])) {
			$students->matching('Tutorials', function($q) {
				return $q->where(['Tutorials.id' => $this->request->params['tutorial_id']]);
			});
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
            'contain' => ['Tutorials']
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
		$student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->data);
            if (!$this->Students->save($student)) {
				throw new \Cake\Network\Exception\BadRequestException();
            }
			$this->set([
				'student' => $student,
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
            if (!$this->Students->save($student)) {
				throw new \Cake\Network\Exception\BadRequestException();
			}
			$this->set([
				'student' => $student,
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
		$file = explode("\r\n", $file);

		$StudentTable = TableRegistry::get('Students');
		$StudentTable->connection()->transactional(function() use ($StudentTable, $file) {
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
				$student = $StudentTable->newEntity($student, [
					'accessibleFields' => ['id' => true]
				]);
				if (!$StudentTable->save($student)) {
					throw new \Cake\Network\Exception\InternalErrorException("Couldn't save student {$student['id']}");
				}
			}
		});

		$this->set([
			'message' => "Success",
			'_serialize' => ['message']
		]);
	}
}
