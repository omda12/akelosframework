# Akelos PHP Framework, a Rails port to PHP #


Please visit the new [Akelos PHP Framework](http://www.akelos.org) website at http://www.akelos.org for,

  * [downloads](http://www.akelos.org/download),
  * [documentation](http://www.akelos.org/docs),
  * [a new Screen cast!](http://www.akelos.org/screencasts),
  * [community forum](http://forum.akelos.org/),
  * [documentation wiki](http://wiki.akelos.org/),
  * [development site](http://trac.akelos.org/),
  * [reporting bugs](http://trac.akelos.org/newticket)


## The new source code repository lays at svn.akelos.org ##

In order to switch your working copy from Google to the new svn.akelos.org hosted repository you'll need to run the following command:

```
cd /path/to/your7akelos/working/copy
svn switch --relocate http://akelosframework.googlecode.com/svn/trunk/ http://svn.akelos.org/trunk/ ./
```

The Akelos project has moved to its own [development site](http://trac.akelos.org/).

```











The information on this site will be kept for historical purposes.









```


The Akelos Framework is a PHP4 and PHP5 port of Ruby on Rails Web Development Framework.

The main goal of the Akelos Framework is to help programmers to build multilingual database-backed web applications according to the Model-View-Control pattern. It lets you write less code by favoring conventions over configuration.

## Framework Features ##

These features are already implemented into the framework.

Features ported from Ruby on Rails

### Active Record ###

  * Associations
    * belongs\_to
    * has\_one
    * has\_many
    * has\_and\_belongs\_to\_many
  * Finders - not so cool as Ruby on Rails but you can still do `$Project->findFirstBy(‘language AND start_year:greater’, ‘PHP’, ‘2004’);`
  * Acts as
    * nested\_set
    * list
  * Callbacks
  * Transactions
  * Validators
  * Locking
  * Observer
  * Versioning
  * Scaffolds
  * Support for MySQL, PostgreSQL and SQLite (might work with other databases supported by ADOdb)

### Action Controller ###

  * Filters
  * Pagination
  * Helpers
  * Mime Type
  * Mime Response
  * Code Generation
  * Flash messages
  * URL Routing
  * Response handler
  * Url rewriter

### Action View ###

  * Templates (using Sintags)
  * Web 2.0 javascript using prototype and script.aculo.us
  * Helpers
  * Partials
  * Template Compilers

### Additional Akelos Framework Features ###

  * Multilingual Models and Views
  * Locale alias integrated on URLS (example.com/spanish will load the es\_ES locale)
  * Database migrations using DB Designer files
  * Pure PHP support for Unicode (no extensions required)
  * Unit Tested source code
  * Code Generators
  * Built in XHTML validator
  * Automated locale management
  * Clean separation from HTML and Javascript using CSS event selectors.
  * Ajax file uploads.
  * Format converters.
  * File handling using SFTP for shared host running Apache as user nobody (as most CPanel server do).
  * Distributed sessions using databases.

## Why another PHP Framework? ##

While many frameworks exist for PHP we could not find any that matched our main goals:

  * Conventions over configuration.
  * Write less code by using simple interfaces to common functionality. Solve the problems the simplest way.
  * Simple and easy to maintain Internationalization and localization built in support.
  * Empower collaborative development across distributed teams by adhering to standards and best practices.
  * Code portability. The code should run on the mainstream PHP version.
  * Enable distribution of Web 2.0 applications that can be easily installed.
  * Simple extendibility. By using plug-ins.
  * Isolated testing of components.
  * Simplistic creation of Web services.
  * Batteries included. No need to modify the server settings.

## Why porting Ruby on Rails? ##

Ruby on Rails is a fantastic web development framework backed with a highly qualified community, which produces great functionalities and documentation. Although we strongly recommend you learning Ruby, many experienced PHP developers/shops do not have the time/resources to get productive with a new programming language.

We decided to build the framework after considering several alternatives. Although we loved Ruby on Rails we needed a framework that allowed developers to distribute standalone scripts that could run on cheap shared hosting without modifications. For this reason we decided to go with PHP4 and make it compatible with PHP5.

We considered other PHP ports of Ruby on Rails, but we could not find all we needed on them. One feature that we needed on the core was internationalization and Unicode support, so we decided to roll our own framework trying to keep most of the original rails interface so most of its documentation could work for it.

## Checking out the source ##

The Subversion repository resides at http://akelosframework.googlecode.com/svn/trunk/, so checking out the current trunk can happen with a command like:

```
svn co http://akelosframework.googlecode.com/svn/trunk/ akelos
```

You can also get a snapshot of the latest build on http://www.akelos.org/akelos_framework-dev_preview.tar.gz

## Getting Started ##

If you want to get started quickly read the source: trunk/README.txt

You can also have a look to the  [Tutorial](http://code.google.com/p/akelosframework/wiki/Tutorial).

First steps after checking out the source (on **NIX systems):**

  1. Check if `env php` works for you `/usr/bin/env php -v` If you don’t see the output you would expect from `php -v` (e.g. PHP 5.1.2 (cli) (built: Sep 6 2006 22:04:21)…), you will have to customize the path to PHP in the first lines of `script/console`, `script/generate`, ``script/migrate`, `script/setup` and `script/test`.
  1. Create your project (at least public within the destination path has to be in your docroot) `./script/setup /your/project/destination/path`
  1. Make sure, your project directory is writable to the webserver user (e.g.:) `chgrp www-data /your/project/destination/path -R` and `chmod g+w /your/project/destination/path -R`.
  1. Point your browser to whatever URL points to the destination path and configure Akelos or alternatively `cp config/DEFAULT-config.php config/config.php` and edit it according to your needs.
  1. Generate some models, controllers and tables and get going! (e.g.:) `./script/generate model Article`, `./script/generate controller Blog`

## Documentation ##

The [inline documentation](http://www.akelos.org/docs/) is automatically updated at http://www.akelos.org/docs/, but still needs some reformatting.

If you have a look into the [unit tests](http://akelosframework.googlecode.com/svn/trunk/test/unit/lib/) at [./test/unit/lib](http://akelosframework.googlecode.com/svn/trunk/test/unit/lib/) you might learn a few thing about the framework.

Most Ruby on Rails docs work for the Akelos Framework with very little modifications, if you’ve read that cool how-to-do-that-web-2.0-thing-on-rails you can adapt it for the Akelos Framework. Try it and write about your experiences to help the Akelos community grow.

You might also find useful the crossed reference output of the [./lib folder generated by PHPXref](http://www.akelos.org/xref/) at http://www.akelos.org/xref/.


## Contributing ##

Tickets are fine, but patches are great. If you want to change something in the Akelos Framework or fix a bug you’ve run across, there’s no faster way to make it happen than to do it yourself.

  1. Get the Akelos Framework ready for patching
    1. heck out the trunk using: `svn co http://akelosframework.googlecode.com/svn/trunk/ akelos`
    1. Setup your environment in a way to be able to run the unit tests.
  1. Make a test-driven change
    1. Add or change unit tests that would prove that your change worked.
    1. Make the change to the source.
    1. Verify that all existing tests still work as well as all the new ones you added by running `./script/test unit` and `./script/test path_to_your_test.php`
  1. Share your well-tested change
    1. Create a patch with your changes: `svn diff > my_properly_named_patch.diff`
    1. [Create a new issue](http://code.google.com/p/akelosframework/issues/entry) with \[PATCH](PATCH.md) as the first word in the summary and upload (not paste) your diff.
    1. Keep an eye on your patch in case there are any reservations raised before it can be applied.

If you want to write code for the framework itself, please make sure you read the [Akelos Framework coding guidelines](http://akelos.org/Akelos%20Framework%20Developer%20Coding%20Style%20Guide.pdf).


## Considerations before adopting the Akelos Framework ##

  * It’s not Akelos on Ruby; so don’t expect to see things like blocks, namespaces, class overloading, modules … Although none of them have been necessary to build the Akelos.
  * It does not use PHP5 only features like (magic setters/functions, object protection and iterators) Although the Framework will make use of this in a future release when PHP5 spreads.
  * It has some hacks around for solving PHP4 limitations like case insensitiveness, pass by reference and magic getter/setter.
  * You need to edit your PHP files on UTF-8 (at least those files with non ASCII characters).

## License ##

Source code is licensed as LGPL. This means you can use it for commercial projects without releasing your application as open-source. You only have to open-source the changes you make to the Framework itself.

