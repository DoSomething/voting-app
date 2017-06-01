## Voting App [![Wercker](https://img.shields.io/wercker/ci/5463a6bde3d1713625001c35.svg?style=flat-square)](https://app.wercker.com/#applications/5463a6bde3d1713625001c35) [![StyleCI](https://styleci.io/repos/24192462/shield)](https://styleci.io/repos/24192462)
Voting app for DoSomething.org campaigns, which launched with Celebs Gone Good in December 2014.

## Getting Started
1. Clone this repository & add to your local [DS Homestead](https://github.com/DoSomething/ds-homestead) environment.
2. Copy `.env.example` and create your own `.env`
3. From within your VM, run `composer install && npm install` to set up dependencies.
4. Run `npm build:dev` to compile front-end assets and watch for changes!
5. Create a `voting` database in your VM.
6. Run `php artisan migrate && php artisan db:seed` to get the database set up.

## Tests
We have a suite of client-side and server-side tests. You can run `npm test` to test client-side code, and `vendor/bin/phpunit` for server-side functional & unit tests. Tests are automatically run on all pull requests.

## License
&copy;2015 DoSomething.org. Voting App is free software, and may be redistributed under the terms specified in the [LICENSE](https://github.com/DoSomething/voting-app/blob/master/LICENSE) file. The name and logo for DoSomething.org are trademarks of Do Something, Inc and may not be used without permission.

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

