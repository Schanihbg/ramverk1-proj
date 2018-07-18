[![Build Status](https://travis-ci.org/Schanihbg/ramverk1-proj.svg?branch=master)](https://travis-ci.org/Schanihbg/ramverk1-proj)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Schanihbg/ramverk1-proj/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Schanihbg/ramverk1-proj/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Schanihbg/ramverk1-proj/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Schanihbg/ramverk1-proj/build-status/master)

Ramverk 1 project
==================================

# Requirements
Tested with
* PHP 7.0+
* MariaDB 10.3
* Apache 2.4+

Other combinations might work

# Install
* Clone this project
* import sql file from `sql/ramverk1_proj.sql`
* Copy `vendor/anax/database/config/database.php` to `config/database.php`
* Configure SQL connection in `database.php`
* Run composer install

Optional:
* Create user and change to admin rights in SQL
