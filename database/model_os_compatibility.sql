CREATE TABLE IF NOT EXISTS model_compatibility (
    model_id INT,
    model_name VARCHAR(100) NOT NULL,
    installed_os VARCHAR(50),
    last_supported_os VARCHAR(50),
    FOREIGN KEY (model_id) REFERENCES models(id)
);

INSERT INTO model_compatibility (model_id, model_name, installed_os, last_supported_os)
VALUES
  (1, 'MacBook (Retina, 12-inch, Early 2015)', 'macOS El Capitan', 'macOS Big Sur'),
  (2, 'MacBook Pro (15-inch, 2.53GHz, Mid 2009)', 'macOS Leopard', 'macOS El Capitan'),
  (3, 'MacBook Pro (15-inch, 2016)', 'macOS High Sierra', 'macOS Monterey'),
  (4, 'iMac (Retina 5K, 27-inch, Late 2014)', 'macOS Yosemite', 'macOS Big Sur'),
  (5, 'Mac Pro (Late 2013)', 'macOS Mojave', 'macOS Monterey'),
  (6, 'MacBook Pro (15-inch, 2.4GHz, Mid 2010)', 'macOS Snow Leopard', 'macOS High Sierra'),
  (7, 'Mac Pro (Mid 2010)', 'macOS Snow Leopard', 'macOS Mojave');
