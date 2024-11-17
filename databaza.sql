CREATE DATABASE pprojekti;

USE pprojekti;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    category VARCHAR(50),
    availability ENUM('available', 'borrowed') DEFAULT 'available'
);

-- Shto admin dhe një përdorues të thjeshtë
INSERT INTO users (username, password, role) VALUES
('rina', '1234', 'admin'),
('user1', 'password', 'user');

-- Shto libra
INSERT INTO books (title, author, category, availability) VALUES
('Ditari i Ana Frankut', 'Ana Frank', 'Autobiografi', 'available'),
('Alkimisti', 'Paulo Coelho', 'Fiction', 'available'),
('Të mbetesh i gjallë', 'Haruki Murakami', 'Literaturë bashkëkohore', 'available'),
('Njëqind vjet vetmi', 'Gabriel Garcia Marquez', 'Klasik', 'available');

CREATE TABLE borrowings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    borrow_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

ALTER TABLE books ADD return_date DATE;

ALTER TABLE books ADD quantity INT DEFAULT 0;
 INSERT INTO books (title, author, quantity, availability) VALUES ('Ditari i Ana Frankut', 'Ana Frank', 3, 'available');
INSERT INTO books (title, author, quantity, availability) VALUES ('Alkimisti', 'Paulo Coelho', 5, 'available');
  
  INSERT INTO books (title, author, quantity) VALUES 
('Ditari i Ana Frankut', 'Ana Frank', 3),
('Alkimisti', 'Paulo Coelho', 5),
('Të mbetesh i gjallë', 'Haruki Murakami', 2),
('Njëqind vjet vetmi', 'Gabriel Garcia Marquez', 4);
 

 DESCRIBE books;

