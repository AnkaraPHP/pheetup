Contributing
------------

Pheetup is an open source, community-driven project.

If you'd like to contribute, please read the following documents:

### Reporting a Bug

Whenever you find a bug in Pheetup, we kindly ask you to report it. It helps
us make a better Pheetup.


Before submitting a bug:

* Double-check the official [documentation](README.md) to see if you're not misusing the
  application;


If your problem definitely looks like a bug, report it using the official bug
[tracker](https://github.com/ankaraphp/pheetup/issues) and follow some basic rules:

* Use the title field to clearly describe the issue;

* Describe the steps needed to reproduce the bug with short code examples
  (providing a unit test that illustrates the bug is best);

* If the bug you experienced affects more than one layer, providing a simple
  failing unit test may not be sufficient. In this case, please fork the
  [Pheetup](https://github.com/ankaraphp/pheetup/) and reproduce your issue on a new branch;

* Give as much detail as possible about your environment (OS, PHP version,
  Symfony version, enabled extensions, ...);



### Running Tests

The Pheetup project uses a third-party service which automatically runs tests for any submitted patch.
If the new code breaks any test, the pull request will show an error message with a link to the full error details.

In any case, it's a good practice to run tests locally before submitting a patch for inclusion, to check that you have not broken anything.


#### Before Running the Tests

To run the Pheetup test suite, install the external dependencies used during the tests, such as Doctrine, Twig and Monolog.
To do so, install Composer and execute the following:

	$ composer update
	$ rm -rf app/sqlite
	$ php app/console doctrine:schema:update --force --env=test


#### Running the Tests

Then, run the test suite from the Symfony root directory with the following command:

	$ phpunit -c app

The output should display OK. If not, read the reported errors to figure out what's going on and if the tests are broken because of the new code.


### Coding Standards

We use [Symfony`s coding standarts](https://symfony.com/doc/current/contributing/code/standards.html)
