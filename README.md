# Client-Server Project

This project is a simple client-server application that allows users to register and login. The project is built using HTML, CSS, MySQL, and PHP. The primary functionalities include user registration with data storage in a MySQL database and email verification during registration.

## Technologies Used

- HTML
- CSS
- MySQL
- PHP

## Getting Started

To use this project, follow these steps:

### 1. Prerequisites

- **XAMPP**: Download and install XAMPP, a free and open-source cross-platform web server solution stack package developed by Apache Friends. You can download it from [here](https://www.apachefriends.org/index.html).

### 2. Clone the Project

Clone this repository into the `htdocs` folder of your XAMPP installation. 

### 3. Start XAMPP

Start the Apache server and MySQL from the XAMPP control panel.

### 4. Set up the Database

Open 'phpmyadmin' in your browser('https://localhost/phpmyadmin')
Create a new database called 'demo'
Inside the 'demo' database, create a table named 'users' with the following structure:

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    verify_status TINYINT DEFAULT 0,
    verify_token VARCHAR(255)
);

### 5. Access the Project

Open your web browser and navigate to 'http://localhost/Client-Server'.
