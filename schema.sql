DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;

--
-- Table structure for table 'cities'
--

DROP TABLE IF EXISTS users;
CREATE TABLE users 
(
  id int(11) NOT NULL auto_increment,
  firstname varchar(32) NOT NULL default '',
  lastname varchar(32) NOT NULL default '',
  password varchar(255) NOT NULL default '',
  email varchar(32) NOT NULL default '',
  role varchar(32) NOT NULL default '',
  created_at datetime,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


INSERT INTO users(firstname ,lastname,password,email,role,created_at) 
VALUES
	  ('Krishna', 'Jones', PASSWORD('password123'), 'admin@project2.com', 'Admin','2023-11-15 12:30:00'),
	  ('Bob', 'Smith', PASSWORD('SecurePass456'), 'bobsmith@gmail.com', 'User','2023-11-14 15:45:00'),
	  ('Charlie', 'Brown', PASSWORD('P@ssw0rd789'), 'charliebrown@gmail.com', 'User','2023-11-13 10:20:00'),
	  ('David', 'Williams', PASSWORD('1234LetMeIn'), 'davidwilliams@gmail.com', 'User','2023-11-12 18:55:00'),
	  ('Emma', 'Taylor', PASSWORD('RandomPwd!23'), 'emmataylor@gmail.com', 'User','2023-11-10 22:30:00');


--
-- Table structure for table 'contacts'
--

DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts
(
  id int(11) NOT NULL auto_increment,
  title varchar(35) NOT NULL default '',
  firstname varchar(35) NOT NULL default '',
  lastname varchar(35) NOT NULL default '',
  email varchar(35) NOT NULL default '',
  telephone varchar(35) NOT NULL default '',
  company varchar(35) NOT NULL default '',
  type varchar(35) NOT NULL default '',
  assigned_to int(11) NOT NULL,
  created_by int(11) NOT NULL,
  created_at datetime,
  updated_at datetime,
  PRIMARY KEY (id),
  FOREIGN KEY (assigned_to) REFERENCES users(id),
  FOREIGN KEY (created_by) REFERENCES users(id)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) 
VALUES 
			('Mr.', 'John', 'Doe', 'johndoe@gmail.com', '876-123-4432', 'ABC Corp', 'Sales Lead', 1, 1, '2023-04-15 08:30:00', '2023-04-15 10:45:00'),
	    ('Mrs.', 'Alice', 'Smith', 'alicesmith@gmail.com', '876-603-4532', 'XYZ Ltd', 'Support', 2, 1, '2023-03-22 14:12:00', '2023-03-23 09:28:00'),
	    ('Dr.', 'Robert', 'Johnson', 'robertjohnson@gmail.com', '876-923-4832', 'Tech Solutions', 'Sales Lead', 3, 1, '2023-02-10 18:55:00', '2023-02-11 11:20:00'),
	    ('Ms.', 'Emily', 'White', 'emilywhite@gmail.com', '876-133-4032', 'Innovate Co', 'Support', 4, 1, '2023-01-05 07:40:00', '2023-01-05 15:55:00'),
	    ('Mr.', 'Daniel', 'Lee', 'daniellee@gmail.com', '876-723-4632', 'Global Tech', 'Sales Lead', 5, 1, '2022-12-12 12:22:00', '2022-12-12 17:30:00');


--
-- Table structure for table 'notes'
--

DROP TABLE IF EXISTS notes;
CREATE TABLE notes 
(
  id int(11) NOT NULL auto_increment,
  contact_id int(11) NOT NULL,
  comment text(35) NOT NULL default '',
  created_by int(11) NOT NULL,
  created_at datetime,
  PRIMARY KEY  (id),
  FOREIGN KEY (contact_id) REFERENCES contacts(id), 
  FOREIGN KEY (created_by) REFERENCES users(id)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


INSERT INTO notes (contact_id, comment, created_by, created_at) 
VALUES 
	    (1, 'Interested in our new product.', 1, '2023-11-16 13:30:00'),
	    (2, 'Follow up about their support request.', 2, '2023-11-16 14:45:00'),
	    (3, 'Discussed potential collaboration.', 3, '2023-11-16 16:00:00'),
	    (4, 'Provided information on our services.', 4, '2023-11-16 17:15:00'),
	    (5, 'Scheduled a meeting to discuss their needs.', 5, '2023-11-16 18:30:00');
