# Chibi Critters #

Created by Daniela Howe
Software by Ivan Montiel

## Installation ##

#### Apache Config ####

This project requires the htaccess file to work properly.  Make sure that
Apache allows overrides: (/etc/apache2/sites-available/default)

```
 <Directory /var/www/>
	Options Indexes FollowSymLinks MultiViews
	AllowOverride All
	Order allow,deny
	allow from all
	# Uncomment this directive is you want to see apache2's
	# default start page (in /apache2-default) when you go to /
	#RedirectMatch ^/$ /apache2-default/
</Directory>
```

The  `AllowOverride All` is the important line.

Also make sure that Rewrite_module is enabled. Run the following in the command line:

```
sudo a2enmod rewrite
sudo service apache2 restart
```

#### File Config ####

There are some example files for your consideration with this installation.

Under "config/" there is a "database.example.yml".  Copy it to "database.yml" and change the settings
to the apprioprate values.

#### Database Config ####

Run "db/schema-creation.sql" for MySQL.  Warning, it will drop any databases and tables of the same name.

## About this Project ##

Chibi Critters is based on the MVC achitecture using the following diagram
as a starting point:



```
#!diagram

                          -------------------
                          |       View      |
                          | (index.html.php)|
                          -------------------
                               /|\      |
                      (6) data  |       |   (7) HTML
                                |      \|/
                      ---------------------------    (5) access     --------------
                      |        Controller       |<----------------->|   Model    |
                      |  (card_controller.php)  |                   | (card.php) |
                    _ ---------------------------                   --------------
                    /|              /                                     /|\
                   /               /                             (3) Req   |   (4) Resp
(2) route /index  /               /                                        |
                 /               /                                        \|/
                /               /                                       --------
          ----------           /                                        |  DB  |
          |  PHP   |          /                                         --------
          | Router |         /  (8) HTML
          ----------        /
             /|\           /
              |           /
   (1) /cards |          /
              |         /
           .-'';'-.   |/_
         ,'   <_,-.`. 
        /)   ,--,_>\_\
       |'   (      \_ |
       |_    `-.    / |
        \`-.   ;  _(`/
         `.(    \/ ,' 
           `-....-'
```



## Running Unit Tests ##

### Installation ###

For Windows:

* As administrator `>php go-pear.phar`
* Just hit ENTER for all defaults.
* Run the following

```
#!cmd

pear channel-update pear.php.net
pear upgrade-all
pear channel-discover pear.phpunit.de
pear channel-discover components.ez.no
pear channel-discover pear.symfony-project.com
pear update-channels
```

* Clear your pear cache `pear clear-cache`
* To install PHPUnit, run `pear install --alldeps --force phpunit/PHPUnit`
* To test that PHPUnit was successfully installed, run `phpunit -v`
