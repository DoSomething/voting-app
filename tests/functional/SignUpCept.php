<?php

$I = new FunctionalTester($scenario);

$I->am('an unregistered user');
$I->wantTo('sign up for an account');

$I->amOnPage('/');

$I->click('Create Account');
$I->seeCurrentUrlEquals('/users/create');

$I->fillField('Email', 'johndoe@example.com');
$I->fillField('Password', 'testing1234');
$I->fillField('Password Confirmation', 'testing1234');
$I->click('Create New Account');

$I->seeCurrentUrlEquals('');

$I->seeRecord('users', [
  'email' => 'johndoe@example.com'
]);

$I->assertTrue(Auth::check());
