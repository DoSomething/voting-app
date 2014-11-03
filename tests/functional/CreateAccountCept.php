<?php

$I = new FunctionalTester($scenario);

$I->am('an unregistered user');
$I->wantTo('create an account');

$email = 'johndoe@example.com';
$password = 'testing1234';

$I->amOnPage('/');

$I->click('Create Account');
$I->seeCurrentUrlEquals('/users/create');

$I->fillField('Email', $email);
$I->fillField('Password', $password);
$I->fillField('Password Confirmation', 'testing1234');
$I->click('Create New Account');

$I->seeCurrentUrlEquals('');

$I->seeRecord('users', [
  'email' => 'johndoe@example.com'
]);

$I->assertTrue(Auth::check(), "logged in as a user");
