DROP TABLE IF EXISTS clients, store, orders, products;



CREATE TABLE products (
  id int unsigned auto_increment not null,
  title varchar(255) not null,
  price double(16, 2) unsigned not null default 0.00,

  PRIMARY KEY (id)
);

CREATE TABLE clients (
  id int unsigned auto_increment not null,
  name varchar(50) not null,
  surname varchar(50) null,
  phone varchar(15) null,
  email varchar(50) not null,

  PRIMARY KEY (id)
);

CREATE TABLE orders (
  id int unsigned auto_increment not null,
  client_id int unsigned not null,
  status varchar(50), # status: pending, success, fail

  PRIMARY KEY (id),
  INDEX (client_id),

  FOREIGN KEY (client_id)
    REFERENCES clients(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE

);
CREATE TABLE store(
  id int unsigned auto_increment not null,
  product_id int unsigned not null,
  amount bigint not null default 0,

  PRIMARY KEY (id),
  INDEX (product_id),

  FOREIGN KEY (product_id)
    REFERENCES products(id)
    ON DELETE CASCADE

);




# Заполняем таблицы дефолтными значениями
INSERT INTO products (
  title, price
) VALUES ('Product2', 1234.32),('Product3', 11234.22),('Product4', 1234.42) ;