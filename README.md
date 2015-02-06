ChibiCritters
=============

ChibiCritters Wordpress Website

# Installation #

sudo apt-get install apache2
apt-get install php5-common php5-mysqlnd php5-xmlrpc php5-curl php5-gd php5-cli php5-fpm php-pear php5-dev php5-imap php5-mcrypt
sudo apt-get install php5-mysqlnd

If you are developing local, we recommend installing phpmyadmin

sudo apt-get install phpmyadmin
 
sudo gedit /etc/apache2/apache2.conf

Add the line:

Include /etc/phpmyadmin/apache.conf

sudo gedit /etc/apache2/sites-available/default

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

sudo a2enmod rewrite

sudo service apache2 restart

cd /var/www/html or /var/www/ if you don't have an html folder.

git clone https://github.com/idmontie/ChibiCritters.git

If you are developing local, we reccomend:


Please follow the folliwng steps to get Wordpress to show up in root: http://codex.wordpress.org/Giving_WordPress_Its_Own_Directory

# Running Tests

```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
cd [project_path]
cd .standards
sudo npm install
composer install
grunt
```