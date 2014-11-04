<?php

$I = new FunctionalTester($scenario);

$I->am('a logged-out registered user');
$I->wantTo('log in to my account');

$email = 'johndoe@example.com';
$password = 'foobar';

$I->haveAnAccount(compact('email', 'password'));
$I->amOnPage('/');

$I->click('Sign In');
$I->seeCurrentUrlEquals('/login');

$I->submitForm('#sign_in_form', [
  'email' => $email,
  'password' => $password
]);

$I->assertTrue(Auth::check(), "logged in as a user");
$I->seeCurrentUrlEquals('');
