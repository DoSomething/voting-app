<?php

// An event listener that handles user votes.
Event::listen('user.vote', function($candidate_id, $user_id) {
  $vote = Vote::castVote($candidate_id, $user_id);
  // @TODO: Add a flash alert here.
});

Event::listen('user.create', function() {
  // Sign user up for transaction messages.
});

Event::listen('user.signin', function() {
  // Do things on user.signin?
});