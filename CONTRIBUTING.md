# Contribution Guidelines
Voting App was built for our internal needs at DoSomething.org, but feel free to poke around the codebase and see how we implemented things.

#### Pull Requests
- All pull requests should include tests verifying that your new feature or bugfix works.
- Reference any supporting documentation or issues to include context for changes you make.

#### Code Style

- Use soft-tabs with a two-space indent.
  - We recommend using [EditorConfig](http://editorconfig.org) to automatically configure your editor to use this project's indentation settings and trim excess whitespace.
- We use [K&R style braces](http://en.wikipedia.org/wiki/Indent_style#K.26R_style):
  - Classes should be declared with brackets on the same line.
  - Functions should be declared with brackets on a new line.
  - Control structures (such as `if` blocks) should be declared with brackets on the same line.
- We follow [PSR-0](http://www.php-fig.org/psr/psr-0/) and [PSR-1](http://www.php-fig.org/psr/psr-1/) coding standards. Here's some highlights:
  - Files must use only `<?php` tags. Omit closing `?>` in class files.
  - Class names must be declared in `StudlyCaps`.
  - Method names must be declared in `camelCase`.
  - Helper functions must be declared in `snake_case`.
- Use array literals `$array = [];` rather than `array()` function.
- Always document your methods and variables using [PHPDoc](http://en.wikipedia.org/wiki/PHPDoc) docblocks.

