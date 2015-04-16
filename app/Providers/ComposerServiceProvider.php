<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{


  /**
   * Register bindings in the container.
   *
   * @return void
   */
  public function boot()
  {

    View::composer(['app', 'candidates.show', 'candidates.voteForm', 'categories.show'], 'App\Http\ViewComposers\LayoutComposer');

  }

  /**
   * Register
   *
   * @return void
   */
  public function register()
  {
    // ...
  }

}
