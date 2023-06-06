DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `user_id` int(8) unsigned NOT NULL auto_increment, 
  `user_lastname` varchar(180) NOT NULL default '',
  `user_firstname` varchar(180) NOT NULL default '',
  `user_email` varchar(180) NOT NULL default '',
  `user_password` varchar(180) NOT NULL default '',
  `user_date_added` date NOT NULL default '0000-00-00',
  `user_time_added` time NOT NULL default '00:00:00',	
  `user_date_updated` date NOT NULL default '0000-00-00',
  `user_time_updated` time NOT NULL default '00:00:00',
  `user_status` int(1) NOT NULL default '0',
  `user_token` varchar(255) NOT NULL default '',
  `user_access` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000001;

DROP TABLE IF EXISTS `tbl_driver`;
CREATE TABLE `tbl_taxi` (
  `driver_id` int(8) unsigned NOT NULL auto_increment, 
  `dr_first` varchar(180) NOT NULL default '',
  `dr_last` varchar(180) NOT NULL default '',
  `dr_dob` date NOT NULL default '0001-01-01',
  `dr_age` int(3) NOT NULL default '0',	
  `dr_gender` varchar(180) NOT NULL default '',	
  `prod_status` int(1) NOT NULL default '0',
  `dr_exp` date NOT NULL default '001-01-01',
  PRIMARY KEY  (`driver_id`),
) ENGINE=MyISAM AUTO_INCREMENT=10000001;

DROP TABLE IF EXISTS `tbl_taxi`;
CREATE TABLE `tbl_taxi` (
  `taxi_id` int(8) unsigned NOT NULL auto_increment, 
  `taxi_plate` varchar(180) NOT NULL default '',
  `taxi_model` varchar(180) NOT NULL default '',
  `taxi_type` varchar(180) NOT NULL default '',
  `taxi_capacity` varchar(180) NOT NULL default '',
  `taxi_transmission` varchar(180) NOT NULL default '',
  `taxi_status` varchar(180) NOT NULL default '',
 
  PRIMARY KEY  (`taxi_id`),
) ENGINE=MyISAM AUTO_INCREMENT=10000001;

DROP TABLE IF EXISTS `tbl_booking`;
CREATE TABLE `tbl_booking` (
  `booking_id` int(11) unsigned NOT NULL auto_increment, 
  `booking_date` date NOT NULL default '0001-01-01',
  `booking_price` int(3) NOT NULL default '0',
  `customer_id` int(11) NOT NULL default '0',
  `taxi_model` varchar(180) NOT NULL default '',
 
  PRIMARY KEY  (`booking_id`),
  KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000001;

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE `tbl_customer` (
  `customer_id` int(11) unsigned NOT NULL auto_increment, 
  `customer_first` varchar(180) NOT NULL default '',
  `customer_last` varchar(180) NOT NULL default '',
  `customer_phone` int(15) NOT NULL default '0',
  `customer_add` varchar(180) NOT NULL default '',
 
  PRIMARY KEY  (`customer_id`),
) ENGINE=MyISAM AUTO_INCREMENT=10000001;

