# Github PHP Repository Finer

This is a program built to show information about the top 100 public PHP repositories on Github. The program is able to access the GitHub API to be able to dynamically update the MySQL database used to store the repositories. Below are instructions to be able to prepare and set up a development environment for this program.

-This program uses the PHP HTTP Library, Guzzle. To run this program, Guzzle must be installed by using the command 'composer require guzzlehttp/guzzle' on the console in the project file.

-User will need to input their own GitHub API token at the top of the db_refresh.php file where '$token = 'YOUR_TOKEN_HERE';' is to be able to access the GitHub API. Ensure that the token supports viewing public repositories.

-Requires a connection to a MySQL database and uses the mysqli PHP library. User will need to input their own server, username, password, host, and database information in the DBConnect.php file before usage.

-To set up the table used by the program, write following query to the MySQL database:
"create table repos (
id int,
name varchar(255),
url varchar(1024),
created_date date,
last_push_date date,
description varchar(2048),
stars int
);"

-To run on a local machine, use the command 'php -S localhost:8000' in the console to serve a local server to run the program
