<?php

use Laracasts\Presenter\Presenter;

class CandidatePresenter extends Presenter {

  public function thumbnail()
  {
    if($this->photo) {
      return "/images/thumb-" . $this->photo;
    } else {
      return "/placeholder.png";
    }
  }
}
