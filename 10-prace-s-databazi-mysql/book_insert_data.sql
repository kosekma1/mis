USE books;
SET NAMES utf8;
SET CHARSET utf8;

INSERT INTO Customers VALUES
  (1, 'Jana Nováková', 'Dubová 25', 'Pelhřimov'),
  (2, 'Aleš Světlý', 'Kopřivová 47', 'Horní Bečva'),
  (3, 'Michal Starý', 'Severní 357', 'Pustiměř');

INSERT INTO Books VALUES
  ('9788025137505', 'Ondřej Baše', 'jQuery pro neprogramátory', 424),
  ('9788025147375', 'Timothy Boronczyk', 'MySQL Okamžitě', 212),
  ('9788025141960', 'Callum Hopkins', 'PHP Okamžitě', 212),
  ('9788025148204', 'Don Nguyen', 'Node.js okamžitě', 299);

INSERT INTO Orders VALUES
  (NULL, 3, 848, '2007-04-02'),
  (NULL, 1, 299, '2007-04-15'),
  (NULL, 2, 511, '2007-04-19'),
  (NULL, 3, 636, '2007-05-01');

INSERT INTO Order_Items VALUES
  (1, '9788025137505', 2),
  (2, '9788025148204', 1),
  (3, '9788025148204', 1),
  (3, '9788025141960', 1),
  (4, '9788025147375', 3);

INSERT INTO Book_Reviews VALUES
  ('9788025141960', 'Hopkinsova kniha je napsaná srozumitelně a jde dál než
                     většina knih o jazyce PHP pro začátečníky.');

