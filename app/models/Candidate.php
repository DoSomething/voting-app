<?php

class Candidate extends BaseModel  {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'candidates';

	protected $fillable = [
		'name', 'description', 'category_id'
	];

	public static $rules = [
		'name' => 'required'
	];

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'slug'
	];

	public function category()
	{
		return $this->belongsTo('Category');
	}
}
