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
  phone varchar(15) null unique,
  email varchar(50) not null unique,

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

CREATE TABLE orders_products (
  order_id int unsigned not null,
  product_id int unsigned not null,

  INDEX (order_id, product_id),

  FOREIGN KEY (order_id)
    REFERENCES orders(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,

  FOREIGN KEY (product_id)
    REFERENCES products(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE

);

# Представление, для расчета количества остатка
CREATE VIEW products_amount AS
  SELECT
    s.product_id product_id,
    (s.amount - COUNT(*)) amount
  FROM orders_products as op
    LEFT JOIN orders as o
      ON o.status = 'success'
    INNER JOIN store as s
      ON (o.id = op.order_id AND s.product_id = op.product_id)
  GROUP BY op.product_id
;

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