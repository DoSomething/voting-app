## Voting App
Voting app for DoSomething.org campaigns, launching with Celebs Gone Good in December 2014.

## Getting Started
1. Clone this repository.
2. Add this directory to your local [DS Homestead](https://github.com/DoSomething/ds-homestead) environment.
3. From within your VM, run `composer install && npm install && bower install` to set up dependencies.
4. Run `gulp` to compile front-end assets and watch for changes!
5. Create a `voting` database in your VM.
6. Run `php artisan migrate && php artisan db:seed` to get the database set up.

## License
&copy;2014 DoSomething.org. Voting App is free software, and may be redistributed under the terms specified in the [LICENSE](https://github.com/DoSomething/voting-app/blob/master/LICENSE) file. The name and logo for DoSomething.org are trademarks of Do Something, Inc and may not be used without permission.

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
