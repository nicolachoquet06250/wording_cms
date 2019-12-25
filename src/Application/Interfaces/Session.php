<?php


namespace App\Application\Interfaces;


interface Session extends Singleton {
	public function initWithId();
	public function getValue(string $key);
	public function setValue(string $key, $value);
	public function unsetValue(string $key);
	public function unsetValues(array ...$values);
	public function has(string $key);
}