<?php

namespace Modules\Account\Models;

use System\Model;

class AccountModel extends Model
{
	protected static $instance;
	protected string $table = 'currencies';



	public function deleteAll(): void
	{
		$query = "DELETE FROM {$this->table}";
		$this->db->query($query);
	}

	public function selectFirstElement(string $column)
	{
		return $this->selector()->fields([$column])->limit(1)->get()[0][$column] ?? null;
	}
}
