CREATE DATABASE food_ai_db;
USE food_ai_db;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    allergens TEXT, -- Stores allergens as a comma-separated list (e.g., 'Peanuts, Dairy')
    password_hash VARCHAR(255) NOT NULL -- Store hashed passwords
);

-- Menu Table
CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_name VARCHAR(100) NOT NULL,
    food_name VARCHAR(100) NOT NULL,
    allergens TEXT, -- List of allergens present in the food
    description TEXT
);
