<?php

class Category extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	protected $fillable = [
		'name', 'slug'
	];

	public static $rules = [
		'name' => 'required',
		'slug' => 'required'
	];

	public function candidates()
	{
		return $this->hasMany('Candidate');
	}
}
