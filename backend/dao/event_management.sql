CREATE DATABASE event_management;
USE event_management;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);
CREATE TABLE categories (
    id INT PRIMARY KEY,
    name VARCHAR(100)
);
CREATE TABLE venues (
    id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    capacity INT NOT NULL
);
CREATE TABLE events (
    id INT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    category_id INT,
    venue_id INT,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    created_by INT,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (venue_id) REFERENCES venues(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);
CREATE TABLE registrations (
    id INT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES events(id),
    UNIQUE (user_id, event_id)
);