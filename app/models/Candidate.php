<?php

class Candidate extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'candidates';

	protected $fillable = [
		'name', 'slug', 'description', 'category_id'
	];

	public static $rules = [
		'name' => 'required',
		'slug' => 'required'
	];

	public function category()
	{
		return $this->belongsTo('Category');
	}
}
