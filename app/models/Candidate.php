<?php

use Laracasts\Presenter\PresentableTrait;

class Candidate extends BaseModel  {

	use PresentableTrait;

	/**
	 * The presenter class for view logic.
	 *
	 * @var string
	 */
	protected $presenter = 'CandidatePresenter';

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

	public function thumbnail()
	{
		if($this->photo) {
			return "/images/thumb-" . $this->photo;
		} else {
			return "/placeholder.png";
		}
	}
}
