# CodeIgniter 4  Advenced And Secure Login And Registration System With Differnt Roles

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).

This repository holds the distributable version of the framework,
including the user guide. It has been built from the 
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/). 


## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

## Check user login or not
Go to App/Config/Filters.php
If you need to register new url for auth use like this.
[code]
'auth' =>
'before' => [
your register url
]
[/code]
If you need to register new url for admin use like this.
Note that all users url must be add in auth section.
[code]
'isAdmin' =>
'before' => [
your register url
]
[/code]
You can set url for differnt users role.
I alredy makes 4 roles for you.
admin, editor, author, contributer.

note than an admin can view editor section but a editor can not view a admin section. It is same for all users roles.


## Contact me
if you have trobule to use it or did not understand this ststem please inbox me on Facebook <a href="www.facebook.com/mmrtonmoy">Moshiur Rahman Tonmoy</a>