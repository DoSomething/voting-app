<?php

class BaseModel extends Eloquent {
	protected $errors;

	public static function boot()
	{
		parent::boot();

		// Validate model on save
		static::saving(function($model) {
			return $model->validate();
		});
	}

	public function validate()
	{
		$validation = Validator::make($this->attributes, static::$rules);

		if($validation->passes())
			return true;

		$this->errors = $validation->messages();
		return false;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}
