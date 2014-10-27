<?php

$I = new FunctionalTester($scenario);

$I->am('an unregistered user');
$I->wantTo('sign up for an account');

$I->amOnPage('/');

$I->click('Sign Up');
$I->seeCurrentUrlEquals('/user/register');

$I->fillField('Email', 'johndoe@example.com');
$I->fillField('Password', 'testing1234');
$I->click('Sign Up');

$I->seeCurrentUrlEquals('');
$I->see('Thanks for registering!');
