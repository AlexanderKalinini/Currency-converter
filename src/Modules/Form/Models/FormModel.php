<?php

namespace Modules\Form\Models;

use System\Model;

class FormModel extends Model
{
	protected static $instance;
	protected string $table = 'users';

	protected array $validationRules = [
		'login' => 'required|min:6|max:20',
		'password' => 'required|min:6'
	];
	protected array $validationMessages = [];
}
