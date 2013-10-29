This is a file-management system I built as a web front-end for managing the distribution of files without resorting to using FTP. It was originally built for agencies to allow clients to send them large files and to keep files organised. It can handle very large files providing the server is set up to allow this.

Set Up and Installation
=======================
Create a MySQL database, import the SQL from /assets/sql/webftp.sql
Set the database server, database name, username and password in /application/config/database.php
Set the $config['base_url'] variable in /application/config/config.php
Check the value of RewriteBase in /.htaccess matches the location of the files on your server. (For example on my development machine I keep the file in a folder called /webftp. In .htaccess I have RewriteBase set as /webftp
Ensure that the /uploads/ folder has correct permissions to allow PHP to upload files and create folders

Log into the admin here: http://www.yourdomain.com/admin (assuming you have installed the software into the root of your website)
The default username / password are:

username: admin
password: password

Create a new user (this will create a folder in the /uploads/ folder.

Now you can log out, then log into the main part of the site using the username / password you created.

You can also check Apache.conf LimitRequestBody directive and set it as high as possible to allow the upload of large files and please check the settings in the .htaccess file as some of them may not work on your server.

To Dos
======
Create unique Salts for users in the database rather than using a global salt
Use sha1 instead of md5 for hashing the passwords
Upgrade CodeIgniter to a later version (mainly so that the base_url doesn't need to be set, making installation easier)
Build in a way for admin users to change their own passwords
Change logo and/or create way for users to manage their own logo

