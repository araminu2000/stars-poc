Stars CRM proof of concept
==========================

[![Build Status](https://travis-ci.org/crm-stars/stars-poc.png?branch=master)](https://travis-ci.org/crm-stars/stars-poc)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/crm-stars/stars-poc/badges/quality-score.png?s=5ab7f8a0b81e781930a2257e9e65304b78059275)](https://scrutinizer-ci.com/g/crm-stars/stars-poc/)
[![Coverage Status](https://coveralls.io/repos/crm-stars/stars-poc/badge.png)](https://coveralls.io/r/crm-stars/stars-poc)

Stars is a the proof of concept of an open source CRM. Details to be added soon after we set things up!

Milestones
==========

Milestones are used as ticket buckets, so that we have better control over our release schedule and ticket organisation. If you come across a bug or a ticket that **can be assigned to one of the existing milestones**, make sure you do that. If you find several tickets that **could be grouped under a common milestone**, create one for it, and if you encounter a general purpose ticket, add it to the list of issues, but **don't specify a milestone**.

Installation
============

In order to install the project and contribute to it, you need to follow the steps below. Please make sure you have access to *Composer* for dependency management, and to *Git* for version control management.

Source code management
----------------------

1. Clone the GitHub repository via the following command: **git clone https://github.com/crm-stars/stars-poc**
2. To install all of the dependencies required for the project, go into the root of the project and run: **composer install**

* The command above will also ask you about the initial setup of your project, so please make sure to specify **your own database connectivity details**.

3. Set up permissions for Symfony by running the [installation commands](http://symfony.com/doc/current/book/installation.html#configuration-and-setup) or by simply applying the operations below in the root dir of the project checkout:

* APACHEUSER=`ps aux | grep -E '[a]pache|[h]ttpd' | grep -v root | head -1 | cut -d\  -f1`
* sudo setfacl -R -m u:$APACHEUSER:rwX -m u:`whoami`:rwX app/cache app/logs
* sudo setfacl -dR -m u:$APACHEUSER:rwX -m u:`whoami`:rwX app/cache app/logs

Database management
-------------------

We run two separate databases which always need to be maintained - one is applicable for the development environment where active data can be stored and used, and one for the test environment, where integration tests can be run; please be aware that **no stable data should ever be kept on the test database** since it will always be destroyed when running integration tests.

In order to configure database management, there are two sets of operations that need to be performed - first-time database setup, and continous database maintenance.

### First time database setup

In order to set up the database, you simply need to run:

* php app/console doctrine:database:create
* php app/console doctrine:database:create --env=test

The commands above will set up the project for the **dev** and **test** environments.

### Continous database maintenance

Database changes are handled via [Doctrine Migrations](http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html), and in order to apply all of the migrations at once, please run the following commands:

* php app/console doctrine:mig:mig
* php app/console doctrine:mig:mig --env=test

The commands above guarantee that your database structure will pass through all of the stable states and be set to the latest version.
