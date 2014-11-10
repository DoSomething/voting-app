<?php

class Setting extends \Eloquent {

  /**
   * Primary key used to reference this model in the DB.
   */
  protected $primaryKey = 'key';

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = ['key', 'value'];

}
