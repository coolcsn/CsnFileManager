CsnFileManager
==============
Zend Framework 2 Module

### What is CsnFileManager? ###
CsnCsnFileManager is a simple File Manager that lets users upload files. It makes it easy to download a file or include it in your html. The files are stored in a directory not directly accessible by *Apache*.

Installation
------------
1. Installation via composer is supported, simply run:
`php composer.phar require coolcsn/csn-file-manager:dev-master`

2. Copy the sample file-manager configuration from `./vendor/coolcsn/csn-file-manager/config/file-manager.local.php.dist` to `./config/autoload` renaming it to **file-manager.local.php**. Edit the file, replacing the directory path with one where you want to store the uploads.

3. Add 'CsnFileManager' to your application configuration in `config/application.config.php`. An example application configuration could look like the following:

```
'modules' => array(
    'Application',
	'CsnUser',
    'CsnFileManager',
)
```

>### How can I upload my gorgeous profile picture? ###
Navigate to ***[hostname]/csn-file-manager***. Enjoy :)

Dependencies
------------
This Module requires that you have a working authentication and authorization modules (in order to control who can upload files and who has access to them). You can check [coolcsn/CsnUser](https://github.com/coolcsn/CsnUser) and [coolcsn/CsnAuthorization](https://github.com/coolcsn/CsnAuthorization).

Recommends
----------
- [coolcsn/CsnCmsApplication](https://github.com/coolcsn/CsnCmsApplication) - An enhanced skeleton application;
- [coolcsn/CsnUser](https://github.com/coolcsn/CsnUser) - Authentication (login, registration) module.
- [coolcsn/CsnAuthorization](https://github.com/coolcsn/CsnAuthorization) - Authorization module.
- [coolcsn/CsnAclNavigation](https://github.com/coolcsn/CsnAclNavigation) - Navigation module;
- [coolcsn/CsnCms](https://github.com/coolcsn/CsnCms) - CMS module;