 # ProductApp

A simple PHP CRUD web app to manage products.

## Features
- View product list
- Edit and update products
- Delete products

## Database Schema
```sql
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  description TEXT,
  image TEXT
);
