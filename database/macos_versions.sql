CREATE TABLE IF NOT EXISTS macos_versions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    version_name VARCHAR(50) NOT NULL,
    release_name VARCHAR(50),
    darwin_os_number FLOAT,
    date_announced DATE,
    date_released DATE,
    latest_release_date DATE
);

INSERT INTO macos_versions (version_name, release_name, darwin_os_number, date_announced, date_released, latest_release_date)
VALUES
  ('Mac OS X 10.0', 'Cheetah',       1.3,  '2001-01-09', '2001-03-24', '2001-06-22'),
  ('Mac OS X 10.1', 'Puma',          1.4,  '2001-07-18', '2001-10-25', '2002-06-06'),
  ('Mac OS X 10.2', 'Jaguar',        6.0,  '2002-05-06', '2002-08-24', '2003-10-03'),
  ('Mac OS X 10.3', 'Panther',       7.0,  '2002-06-23', '2003-10-24', '2005-04-15'),
  ('Mac OS X 10.4', 'Tiger',         8.0,  '2004-05-04', '2005-04-29', '2007-11-14'),
  ('Mac OS X 10.5', 'Leopard',       9.0,  '2006-06-26', '2007-10-26', '2009-08-13'),
  ('Mac OS X 10.6', 'Snow Leopard',  10.0, '2008-06-09', '2009-08-28', '2011-06-25'),
  ('Mac OS X 10.7', 'Lion',          11.0, '2010-10-20', '2011-07-20', '2012-10-04'),
  ('OS X 10.8',     'Mountain Lion', 12.0, '2012-02-16', '2012-07-25', '2015-08-13'),
  ('OS X 10.9',     'Mavericks',     13.0, '2013-06-10', '2013-10-22', '2016-07-18'),
  ('OS X 10.10',    'Yosemite',      14.0, '2014-06-02', '2014-10-16', '2017-07-19'),
  ('OS X 10.11',    'El Capitán',    15.0, '2015-06-08', '2015-09-30', '2018-07-09'),
  ('macOS 10.12',   'Sierra',        16.0, '2016-06-13', '2016-09-20', '2019-10-26'),
  ('macOS 10.13',   'High Sierra',   17.0, '2017-06-05', '2017-09-25', '2020-11-12'),
  ('macOS 10.14',   'Mojave',        18.0, '2018-06-04', '2018-09-24', '2021-07-21'),
  ('macOS 10.15',   'Catalina',      19.0, '2019-06-03', '2019-10-07', '2022-07-20'),
  ('macOS 11',      'Big Sur',       20.0, '2020-06-22', '2020-11-12', '2023-09-11'),
  ('macOS 12',      'Monterey',      21.0, '2021-06-07', '2021-10-25', '2024-07-29'),
  ('macOS 13',      'Ventura',       22.0, '2022-06-06', '2022-10-24', '2024-09-16'),
  ('macOS 14',      'Sonoma',        23.0, '2023-06-05', '2023-09-26', '2024-09-16'),
  ('macOS 15',      'Sequoia',       24.0, '2024-06-10', '2024-09-16', '2024-10-03');
