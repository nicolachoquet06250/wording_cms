<?php


namespace App\Application\Interfaces;


interface Singleton {
	public static function getInstance(): self;
}