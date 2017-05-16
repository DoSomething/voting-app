## Voting App [![Wercker](https://img.shields.io/wercker/ci/5463a6bde3d1713625001c35.svg?style=flat-square)](https://app.wercker.com/#applications/5463a6bde3d1713625001c35) [![StyleCI](https://styleci.io/repos/24192462/shield)](https://styleci.io/repos/24192462)
Voting app for DoSomething.org campaigns, which launched with Celebs Gone Good in December 2014.

### Contributing

Fork and clone this repository, add to your local [DS Homestead](https://github.com/DoSomething/ds-homestead), and run set-up:

```sh
# Install dependencies:
$ composer install && npm install
    
# Copy the default environment variables & generate a key:
$ cp .env.example .env
$ php artisan key:generate

# Run database migrations:
$ php artisan migrate

# And finally, build the frontend assets:
$ npm start
```

You can seed the database with test data:

    $ php artisan db:seed

You may run unit tests locally using PHPUnit:

    $ vendor/bin/phpunit


We follow [Laravel's code style](http://laravel.com/docs/5.1/contributions#coding-style) and automatically
lint all pull requests with [StyleCI](https://styleci.io/repos/26884886). Be sure to configure
[EditorConfig](http://editorconfig.org) to ensure you have proper indentation settings.

Consider [writing a test case](http://laravel.com/docs/5.1/testing) when adding or changing a feature.
Most steps you would take when manually testing your code can be automated, which makes it easier for
yourself & others to review your code and ensures we don't accidentally break something later on!

## License
&copy;2017 DoSomething.org. Voting App is free software, and may be redistributed under the terms specified in the [LICENSE](https://github.com/DoSomething/voting-app/blob/master/LICENSE) file. The name and logo for DoSomething.org are trademarks of Do Something, Inc and may not be used without permission.

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

