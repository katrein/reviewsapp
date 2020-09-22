-- Run this SQL to create tables and seed the database with dummy data

CREATE TABLE IF NOT EXISTS products (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    item_name tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci
);

INSERT INTO
    products (id, item_name)
VALUES
    (null, 'Red cupcake'),
    (null, 'Orange cupcake'),
    (null, 'Yellow cupcake'),
    (null, 'Green cupcake'),
    (null, 'Blue cupcake'),
    (null, 'Unicorn cupcake');

CREATE TABLE IF NOT EXISTS reviews (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    product_id int(11) DEFAULT NULL,
    rating int(1) DEFAULT NULL,
    review text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
    date date DEFAULT NULL,
    user_name tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
    user_email tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci
);

INSERT INTO
    reviews (id, product_id, rating, review, date, user_name, user_email)
VALUES
    (null, 1, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      '2020-07-02', 'Angel C', 'acampey@example.co.za' ),
    (null, 1, 3, 'Pellentesque efficitur, lorem sed ornare gravida.',
      '2020-06-16', 'Kevin F', 'kfraser@example.co.za' ),
    (null, 2, 5, 'Nam molestie orci ut pharetra aliquet.',
      '2020-05-15', 'Kim E', 'kengelbrecht@example.co.za' ),
    (null, 3, 5, 'Mauris tempor diam ac ligula interdum aliquet.',
      '2020-06-16', 'Trevor L', 'tlagerwey@example.co.za' ),
    (null, 3, 4, 'Praesent vitae tortor quis lectus malesuada cursus nec nec diam.',
      '2020-07-24', 'Nosipho D', 'ndumisa@example.co.za' ),
    (null, 3, 5, 'Phasellus auctor auctor porttitor. Suspendisse non feugiat nulla.',
      '2020-03-18', 'Tamburai C', 'tchirume@example.co.za' ),
    (null, 4, 2, 'Vestibulum fringilla quam vel tortor sagittis malesuada.',
      '2020-04-25', 'Siya K', 'skolisi@example.co.za' ),
    (null, 4, 1, 'Nullam consectetur turpis tempus sodales lacinia.',
      '2020-08-02', 'Peter V', 'pveysie@example.co.za' ),
    (null, 5, 3, 'In quam nibh, pretium varius sodales eget, tempor a lectus.',
      '2020-06-05', 'Lauren D', 'ldallas@example.co.za' ),
    (null, 6, 4, 'Quisque ut odio ac justo pulvinar finibus sit amet at quam.',
      '2020-07-15', 'Evan F', 'efaull@example.co.za' ),
    (null, 6, 5, 'Vivamus nisi nisl, dapibus at mi ut, varius tincidunt.',
      '2020-03-15', 'Trevor N', 'tnoah@example.co.za' );
