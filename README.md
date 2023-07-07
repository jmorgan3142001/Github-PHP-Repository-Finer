# Github PHP Repository Finer

-This program uses the PHP HTTP Library, Guzzle. To run this program, Guzzle must be installed by using the command 'composer require guzzlehttp/guzzle' on the console in the project file.

-User will need to imput their own GitHub API token at the top of the db_refresh.php file where '$token = 'YOUR_TOKEN_HERE';' is to be able to access the GitHub API. Ensure that the token supports viewing public repositories.

-Requires a connection to a MySQL database and uses the mysqli PHP library

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
