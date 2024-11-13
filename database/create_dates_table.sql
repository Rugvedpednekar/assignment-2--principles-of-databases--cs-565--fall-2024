CREATE TABLE IF NOT EXISTS dates (
  announced      DATE         NOT NULL,
  released       DATE         DEFAULT NULL,
  last_release   DATE         DEFAULT NULL,
  darwin         VARCHAR(8)   NOT NULL,

  FOREIGN       KEY (darwin)  REFERENCES os(darwin),
  PRIMARY       KEY(announced)
);
