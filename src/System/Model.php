<?php

namespace System;

use System\Database\Connection;
use System\Database\QuerySelect;
use System\Database\SelectBuilder;
use System\Exceptions\ExcValidation;
use Rakit\Validation\Validator;

abstract class Model
{
   protected static $instance;
   protected Connection $db;
   protected string $table;
   protected string $pk;
   protected array $validationRules;
   protected array $validationMessages;
   protected Validator $validator;

   public static function getInstance(): static
   {
      if (static::$instance === null) {
         static::$instance = new static();
      }

      return static::$instance;
   }

   protected function __construct()
   {
      $this->db = Connection::getInstance();
      $this->validator = new Validator();
   }

   public function all(): array
   {
      return $this->selector()->get();
   }

   public function getById(int $id): ?array
   {
      $res = $this->selector()->where("{$this->pk} = :pk", ['pk' => $id])->get();
      return $res[0] ?? null;
   }

   public function selector(): QuerySelect
   {
      $builder = new SelectBuilder($this->table);
      return new QuerySelect($this->db, $builder);
   }

   public function add(array $fields): int
   {

      $validation = $this->validator->validate($fields, $this->validationRules, $this->validationMessages);
      $messages = json_encode($validation->errors()->toArray());

      if ($validation->fails()) {
         throw new ExcValidation($messages, $validation->errors());
      }

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

   public function remove(int $id): bool
   {
      $query = "DELETE FROM {$this->table} WHERE {$this->pk} =:pk";
      $query = $this->db->query($query, ['pk' => $id]);
      return $query->rowCount() > 0;
   }

   public function edit(int $id, array $fields): bool
   {

      $validation = $this->validator->validate($fields, $this->validationRules);

      if ($validation->fails()) {
         throw new ExcValidation('cant add article', $validation->errors());
      }

      $pairs = [];

      foreach ($fields as $field => $val) {
         $pairs[] = "$field=:$field";
      }

      $pairsStr = implode(', ', $pairs);

      $query = "UPDATE {$this->table} SET $pairsStr WHERE {$this->pk} =:{$this->pk}";
      $this->db->query($query, $fields + [$this->pk => $id]);
      return true;
   }

   protected function rebuildRules(array $rules, ?int $pk = null)
   {
      $mask = 'unique';

      foreach ($rules as $field => $rule) {
         if (strpos($rule, $mask) !== false) {
            $updRule = str_replace($mask, "$mask:{$this->table},$field", $rule);

            if ($pk !== null) {
               $updRule .= ",{$this->pk},$pk";
            }

            $rules[$field] = $updRule;
         }
      }
      /* var_dump($rules);
		exit(); */
      return $rules;
   }
}
