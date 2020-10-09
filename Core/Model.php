<?php
class Model
{
	public $instance;

	public function __construct()
    {
    	$this->instance = Database::Instance();
    }
}
