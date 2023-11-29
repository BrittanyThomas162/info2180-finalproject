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
  password varchar(16) NOT NULL default '',
  email varchar(32) NOT NULL default '',
  role varchar(32) NOT NULL default '',
  created_at datetime,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


INSERT INTO users(firstname ,lastname,password,email,role,created_at) 
VALUES
	  ('Krishna', 'Jones', MD5('password123'), 'admin@project2.com', 'admin','2023-11-15 12:30:00'),
	  ('Bob', 'Smith', 'SecurePass456', 'bobsmith@gmail.com', 'user','2023-11-14 15:45:00'),
	  ('Charlie', 'Brown', 'P@ssw0rd789', 'charliebrown@gmail.com', 'user','2023-11-13 10:20:00'),
	  ('David', 'Williams', '1234LetMeIn', 'davidwilliams@gmail.com', 'user','2023-11-12 18:55:00'),
	  ('Emma', 'Taylor', 'RandomPwd!23', 'emmataylor@gmail.com', 'user','2023-11-10 22:30:00'),
	  ('Frank', 'Anderson', 'StrongP@ssword', 'frankanderson@gmail.com', 'user','2023-11-09 12:15:00'),
	  ('Grace', 'Clark', '$2b$12ord7', 'graceclark@gmail.com', 'user','2023-11-08 14:40:00'),
	  ('Henry', 'Martin', 'password8', 'henrymartin@gmail.com', 'user','2023-11-07 19:25:00'),
	  ('Ivy', 'Turner', '9876SecureP', 'ivyturner@gmail.com', 'user','2023-11-05 23:05:00'),
	  ('Jack', 'Harrison', 'GamingPro@789', 'jackharrison@gmail.com', 'user','2023-11-03 17:15:00'),
	  ('Katherine', 'Miller', 'SunsetWatcher456', 'katherinemiller@gmail.com', 'user','2023-11-02 11:30:00'),
	  ('Leo', 'Carter', 'ashedpass', 'leocarter@gmail.com', 'user','2023-11-01 20:45:00'),
	  ('Mia', 'Jones', 'P@ssMeNot123', 'miajones@gmail.com', 'user','2023-10-31 13:55:00'),
	  ('Nathan', 'Perez', 'YogaEnthusiast!', 'nathanperez@gmail.com', 'user','2023-10-29 16:25:00'),
	  ('Olivia', 'Moore', 'MusicFanatic12', 'oliviamoore@gmail.com', 'user','2023-10-28 19:40:00'),
	  ('Paul', 'Rodriguez', 'TravelBug12', 'paulrodriguez@gmail.com', 'user','2023-10-27 22:00:00'),
	  ('Quinn', 'Lopez', 'FoodieLover!23', 'quinnlopez@gmail.com', 'user','2023-10-29 22:00:00'),
	  ('Rachel', 'Stewart', 'PetLover!567', 'rachelstewart@gmail.com', 'user','2023-10-29 15:00:00'),
	  ('Samuel', 'Lee', 'DIYProject!789', 'samuellee@gmail.com', 'user','2023-10-29 14:00:00'),
	  ('Tina', 'Ward', 'BookWorm!789', 'tinaward@gmail.com', 'user','2023-10-29 20:00:00');


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
	    ('Mrs.', 'Alice', 'Smith', 'alicesmith@gmail.com', '876-603-4532', 'XYZ Ltd', 'Support', 2, 2, '2023-03-22 14:12:00', '2023-03-23 09:28:00'),
	    ('Dr.', 'Robert', 'Johnson', 'robertjohnson@gmail.com', '876-923-4832', 'Tech Solutions', 'Sales Lead', 3, 3, '2023-02-10 18:55:00', '2023-02-11 11:20:00'),
	    ('Ms.', 'Emily', 'White', 'emilywhite@gmail.com', '876-133-4032', 'Innovate Co', 'Support', 4, 4, '2023-01-05 07:40:00', '2023-01-05 15:55:00'),
	    ('Mr.', 'Daniel', 'Lee', 'daniellee@gmail.com', '876-723-4632', 'Global Tech', 'Sales Lead', 5, 5, '2022-12-12 12:22:00', '2022-12-12 17:30:00'),
	    ('Miss', 'Sophia', 'Garcia', 'sophiagarcia@gmail.com', '876-223-5472', 'Energy Solutions', 'Support', 6, 6, '2022-11-28 16:48:00', '2022-11-29 09:10:00'),
	    ('Mr.', 'Michael', 'Brown', 'michaelbrown@gmail.com', '876-201-3456', 'Tech Innovators', 'Sales Lead', 7, 7, '2022-10-17 11:05:00', '2022-10-17 14:40:00'),
	    ('Ms.', 'Olivia', 'Miller', 'oliviamiller@gmail.com', '876-987-1234', 'Data Solutions', 'Support', 8, 8, '2022-09-08 09:15:00', '2022-09-08 12:25:00'),
	    ('Dr.', 'Ethan', 'Anderson', 'ethananderson@gmail.com', '876-456-7890', 'Innovate Tech', 'Sales Lead', 9, 9, '2022-08-04 20:03:00', '2022-08-05 08:45:00'),
	    ('Mrs.', 'Emma', 'Wilson', 'emmawilson@gmail.com', '876-890-5678', 'Global Solutions', 'Support', 10, 10, '2022-07-19 13:30:00', '2022-07-19 17:55:00'),
	    ('Mr.', 'Liam', 'Davis', 'liamdavis@gmail.com', '876-234-9012', 'Digital Ventures', 'Sales Lead', 11, 11, '2022-06-25 04:18:00', '2022-06-25 11:40:00'),
	    ('Miss', 'Ava', 'Martinez', 'avamartinez@gmail.com', '876-567-8901', 'Future Tech', 'Support', 12, 12, '2022-05-14 22:10:00', '2022-05-15 10:20:00'),
	    ('Mr.', 'Lucas', 'Hill', 'lucashill@gmail.com', '876-113-4566', 'Smart Solutions', 'Sales Lead', 13, 13, '2022-04-09 15:42:00', '2022-04-09 19:55:00'),
	    ('Mrs.', 'Isabella', 'Wright', 'isabellawright@gmail.com', '876-789-0123', 'Digital Insights', 'Support', 14, 14, '2022-03-06 08:20:00', '2022-03-06 14:30:00'),
	    ('Dr.', 'Jackson', 'Clark', 'jacksonclark@gmail.com', '876-345-6789', 'Innovate Solutions', 'Sales Lead', 15, 15, '2022-02-18 18:12:00', '2022-02-19 09:28:00'),
			('Ms.', 'Sophie', 'Baker', 'sophiebaker@gmail.com', '876-876-5432', 'Tech Dynamics', 'Support', 16, 16, '2023-11-16 13:30:00', '2023-11-16 13:45:00'),
	    ('Mr.', 'Henry', 'Taylor', 'henrytaylor@gmail.com', '876-432-1098', 'Data Innovations', 'Sales Lead', 17, 17, '2023-11-16 14:45:00', '2023-11-16 15:00:00'),
	    ('Miss', 'Scarlett', 'Cooper', 'scarlettcooper@gmail.com', '876-789-8765', 'Global Ventures', 'Support', 18, 18, '2023-11-16 16:00:00', '2023-11-16 16:15:00'),
	    ('Mr.', 'Gabriel', 'Fisher', 'gabrielfisher@gmail.com', '876-543-2109', 'Future Innovations', 'Sales Lead', 19, 19, '2023-11-16 17:15:00', '2023-11-16 17:30:00'),
	    ('Mrs.', 'Mia', 'Evans', 'miaevans@gmail.com', '876-210-9876', 'Smart Insights', 'Support', 20, 20, '2023-11-16 18:30:00', '2023-11-16 18:45:00');

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
	    (5, 'Scheduled a meeting to discuss their needs.', 5, '2023-11-16 18:30:00'),
	    (6, 'Addressed concerns raised during the call.', 6, '2023-11-16 19:45:00'),
	    (7, 'Follow up regarding their purchase inquiry.', 7, '2023-11-16 21:00:00'),
	    (8, 'Provided technical support.', 8, '2023-11-16 22:15:00'),
	    (9, 'Sent a proposal for their consideration.', 9, '2023-11-16 23:30:00'),
	    (10, 'Expressed interest in our upcoming event.', 10, '2023-11-17 00:45:00'),
	    (11, 'Follow up regarding their account status.', 11, '2023-11-17 02:00:00'),
	    (12, 'Scheduled a demo to showcase product features.', 12, '2023-11-17 03:15:00'),
	    (13, 'Discussed pricing options.', 13, '2023-11-17 04:30:00'),
	    (14, 'Follow up about feedback on our services.', 14, '2023-11-17 05:45:00'),
	    (15, 'Requested additional information on our offerings.', 15, '2023-11-17 07:00:00'),
	    (16, 'Provided guidance on using our platform.', 16, '2023-11-17 08:15:00'),
	    (17, 'Follow up regarding their recent order.', 17, '2023-11-17 09:30:00'),
	    (18, 'Addressed concerns raised during the call.', 18, '2023-11-17 10:45:00'),
	    (19, 'Scheduled a meeting to discuss their needs.', 19, '2023-11-17 12:00:00'),
	    (20, 'Provided technical support.', 20, '2023-11-17 13:15:00');