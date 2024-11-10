CREATE TABLE IF NOT EXISTS models (
    id INT PRIMARY KEY AUTO_INCREMENT,
    model_name VARCHAR(100) NOT NULL,
    model_id VARCHAR(50),
    model_number VARCHAR(50),
    part_number VARCHAR(50),
    serial_number VARCHAR(50) UNIQUE,
    darwin_os_number FLOAT,
    latest_support_darwin_os FLOAT,
    url VARCHAR(255)
);

INSERT INTO models (model_name, model_id, model_number, part_number, serial_number, darwin_os_number, latest_support_darwin_os, url)
VALUES
    ('MacBook (Retina, 12-inch, Early 2015)',    'MacBook8,1',     'A1534', 'Z0RN00003',            '2QJ02DC0GCN2', 15, 20, 'https://support.apple.com/en-us/112442'),
    ('MacBook Pro (15-inch, 2.53GHz, Mid 2009)', 'MacBookPro5,4',   NULL,   'MC118LL/A',            '9W89311B7XJ',  9,  15, 'https://support.apple.com/en-us/112624'),
    ('MacBook Pro (15-inch, 2016)',              'MacBookPro13,3', 'A1707', 'Z0SH0004V',            'C0287FGTF1SQ', 17, 21, 'https://support.apple.com/en-us/111975'),
    ('iMac (Retina 5K, 27-inch, Late 2014)',     'iMac15,1',       'A1419', 'MF886xx/A',            'CL145FY102N4', 14, 20, 'https://support.apple.com/en-us/112436'),
    ('Mac Pro (Late 2013)',                      'MacPro6,1',      'A1481', 'ME253xx/A, MD878xx/A', 'FKWF00JJ3RY5', 18, 21, 'https://support.apple.com/en-us/112025'),
    ('MacBook Pro (15-inch, 2.4GHz, Mid 2010)',  'MacBookPro6,2',   NULL,   'MC118LL/A',            'MNW8044FAGU',  10, 17, 'https://support.apple.com/en-us/112605'),
    ('Mac Pro (Mid 2010)',                       'MacPro5,1',      'A1289', 'MC560LL/A',            'YM1LUEUE310',  10, 18, 'https://support.apple.com/en-us/112578');
