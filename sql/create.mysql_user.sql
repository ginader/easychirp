
/*
	You'll only need to run this script in your dev environment.
	Production will be taken care of by the webhost 
*/

CREATE USER 'easychirp'@'localhost' IDENTIFIED BY 'i am webaxe';

GRANT ALL PRIVILEGES ON * . * TO 'easychirp'@'localhost';

FLUSH PRIVILEGES;

