<?php namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;

// All public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module {

  /**
   * Provide a User fixture.
   */
  public function haveAnAccount($overrides = [])
  {
    $user = TestDummy::create('User', $overrides);
  }

}
