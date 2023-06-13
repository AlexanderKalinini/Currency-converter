<?php

namespace Modules\Account\Models;

use System\Model;

class AccountModel extends Model
{
	protected static $instance;
	protected string $table = 'currencies';

	public function add(array $fields): int
	{
		$names = [];
		$masks = [];

		foreach ($fields as $field => $val) {
			$names[] = $field;
			$masks[] = ":$field";
		}

		$namesStr = implode(', ', $names);
		$masksStr = implode(', ', $masks);

		$query = "INSERT INTO {$this->table} ($namesStr) VALUES ($masksStr)";
		$this->db->query($query, $fields);
		return $this->db->lastInsertId();
	}

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
