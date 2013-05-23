
/*
Used by CodeIgniter to store user sessions instead of keeping them in the cookie
*/
CREATE TABLE IF NOT EXISTS `ci_sessions` (
session_id varchar(40) DEFAULT '0' NOT NULL,
ip_address varchar(16) DEFAULT '0' NOT NULL,
user_agent varchar(120) NOT NULL,
last_activity int(10) unsigned DEFAULT 0 NOT NULL,
user_data text NOT NULL,
PRIMARY KEY (session_id)
);


