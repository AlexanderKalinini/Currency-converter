<?php

namespace System;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Template
{

	public static $instance;

	protected function __construct()
	{
	}

	public static function getInstance(): static
	{
		if (static::$instance === null) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function render(string $pathToTemplate, ?array $args = null): string
	{

		if (isset($args)) {
			extract($args);
		}

		ob_start();
		include $pathToTemplate;
		return ob_get_clean();
	}
}
