<?php

namespace Modules\Account\Controllers;

use Exception;
use Modules\_base\Controller as BaseController;
use Modules\Account\Models\AccountModel;
use System\Parser;
use System\Session;

class AccountController extends BaseController
{
	protected AccountModel $model;
	protected Session $session;
	protected $parser;
	public function __construct()
	{
		parent::__construct();
		$this->model = AccountModel::getInstance();
		$this->session = new Session();
		$this->parser = new Parser();
	}

	public function convert()
	{
		$timestamp = $this->model->selectFirstElement('time');

		if (!isset($timestamp) || (time() + 3600) > strtotime($timestamp) + (3 * 3600)) {
			$currencies = $this->parser->getCurrencies();
			$this->model->deleteAll();
			foreach ($currencies as $value) {
				$this->model->add([
					'code' => $value[1], 'currency' => $value[3],
					'value' => $value[4], 'amount' => $value[2]
				]);
			}
		};

		$curs = $this->model->all();

		$this->content = $this->view->render('src/Modules/Account/Views/v_account.php', ['currencies' => $curs]);
	}
}
