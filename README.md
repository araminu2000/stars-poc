Stars CRM proof of concept
==========================

[![Build Status](https://travis-ci.org/crm-stars/stars-poc.png?branch=master)](https://travis-ci.org/crm-stars/stars-poc)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/crm-stars/stars-poc/badges/quality-score.png?s=5ab7f8a0b81e781930a2257e9e65304b78059275)](https://scrutinizer-ci.com/g/crm-stars/stars-poc/)
[![Coverage Status](https://coveralls.io/repos/crm-stars/stars-poc/badge.png)](https://coveralls.io/r/crm-stars/stars-poc)

Stars is a the proof of concept of an open source CRM. Details to be added soon after we set things up!

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
