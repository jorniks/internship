# internship

This is is a project that automate the process of student internship placement, application and acceptance. The project is more like a simulation of the real thing (this is more like me messing around in my free time).

To run the project you have to install a few dependencies; it is assumed that you already have xampp installed so i will proceed to the main thing.

NOTE: All the installation instructions are for Linux Operating System (Ubuntu)

UPDATE PACKAGES INDEX



`
 $ sudo apt-get update
`


INSTALL REQUIREMENTS (php cli)



`
$ sudo apt updatesudo apt install wget php-cli php-zip unzip
`


Now that we have php cli installed on our machine, we can download the composer installer with:



`
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
`


Next, we need to verify the data integrity of the script by comparing the script SHA-384 hash with the latest installer hash found on the Composer Public Keys / Signatures page.

We will use the following wget command to download the expected signature of the latest Composer installer from the Composer’s Github page and store it in a variable named HASH:



`
$ HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
`


Now run the following command to verify that the installation script is not corrupted:



`
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
`

INSTALL Composer in the /usr/local/bin directory



`
$ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
`


VERIFY YOU INSTALLATION BY RUNNING COMPOSER



`
$ composer
`




With composer installed next is to get the project to use is as a dependency. Migrate to the project folder and get composer to install the sendgrid api



`
$ composer require sendgrid/sendgrid
`


With SendGrid API installed next thing is to update the composer.lock file



`
$ composer update
`


Create environment files to save your SendGrid API key

```
$ echo "export SENDGRID_API_KEY='YOUR_API_KEY'" > sendgrid.env
$ echo "sendgrid.env" >> .gitignore
$ source ./sendgrid.env
```


You are good. Now run the app with your localhost. If you have an active internet connetion, the app will be able to send a mail to the email address specified in the index page.
