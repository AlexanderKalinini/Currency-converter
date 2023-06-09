<?php

namespace Modules\Form\Controllers;

use Modules\_base\Controller as BaseController;
use Modules\Form\Models\FormModel;
use System\Exceptions\ExcValidation;
use System\Session;

class FormController extends BaseController
{
	protected FormModel $model;
	protected Session $session;
	protected $login;
	protected $password;
	public function __construct()
	{
		parent::__construct();
		$this->model = FormModel::getInstance();
		$this->session = new Session();
		$this->login = htmlspecialchars(trim($_POST['login'] ?? null));
		$this->password  = htmlspecialchars(trim($_POST['password'] ?? null));
	}

	public function defaultMethod()
	{

		$this->title = 'Login';
		$this->session->set('loggedin', false);
		$this->content = $this->view->render('src/Modules/Form/Views/v_form.php');
	}

	public function login()
	{
		$users  = $this->model->all();
		foreach ($users as $user) {
			if ($user['login'] === $this->login && $user['password'] === $this->password) {
				$this->session->set('loggedin', true);
				return;
			}
		};

		$this->content = $this->view->render('src/Modules/Form/Views/v_form.php', ['error' => true]);
	}

	public function signup()
	{
		try {
			$this->model->add(['login' => $this->login, 'password' => $this->password]);
		} catch (ExcValidation $e) {
			$messages = json_decode($e->getMessage(), true);
			$this->content = $this->view->render('src/Modules/Form/Views/v_form.php', [
				'loginMessage' => $messages['login'] ?? null,
				'passwordMessage' => $messages['password'] ?? null
			]);
			return;
		}
		$this->session->set('loggedin', true);
	}
}
