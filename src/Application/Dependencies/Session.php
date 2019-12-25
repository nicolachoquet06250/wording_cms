<?php


namespace App\Application\Dependencies;


class Session implements \App\Application\Interfaces\Session {

	private static ?Session $instance = null;

	public static function getInstance(): Session {
		if (is_null(self::$instance)) {
			self::$instance = new Session();
		}
		return self::$instance;
	}

	private function __construct() {
		session_start();
	}

	public function initWithId() {
		if(isset($_COOKIE['PHPSESSID'])) {
			session_id( $_COOKIE['PHPSESSID'] );
		}
	}

	public function getValue(string $key) {
		return $this->has($key) ? $_SESSION[$key] : false;
	}

	public function setValue(string $key, $value): void {
		$_SESSION[$key] = $value;
	}

	public function unsetValue(string $value): void {
		unset($_SESSION[$value]);
	}

	public function unsetValues(array ...$values): void {
		/** @var string $value */
		foreach ( $values as $value ) {
			$this->unsetValue($value);
		}
	}

	public function has(string $key) {
		return isset($_SESSION[$key]);
	}
}