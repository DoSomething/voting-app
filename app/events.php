<?php

// An event listener that handles user votes.
Event::listen('user.login.to.vote', function($candidate_id, $user_id) {
  // @TODO: check if a user can vote!
  return $vote = Vote::createIfEligible($candidate_id, $user_id);
  // @TODO: Add a flash alert here.
});

Event::listen('user.create', function() {
  // Sign user up for transaction messages.
});