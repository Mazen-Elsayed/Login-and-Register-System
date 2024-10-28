# Login & Registration Page

## Features

- User registration with form validation
- User login functionality 
- Smooth animations
- Client/server-side validation
- Secure password handling
- Logout functionality

## Files Description

### `Lab4.html`
- Main HTML file containing the registration and login forms
- Includes smooth transitions between login/register views
- Linked to CSS and JavaScript files

### `Lab4.css `
- Stylesheet for the application
- Responsive design elements
- Smooth animations for form transitions
- Modern UI styling

### `validations.js`
- Client-side form validation
- Validates registration form fields:
  - Full name
  - Email address
  - Password
  - Password confirmation
- Validates login form fields:
  - Email address
  - Password
- Prevents empty submissions and ensures data quality

### `login.php`
- Handles server-side logic
- Manages user sessions
- Processes registration and login requests
- Connects to MySQL database
- Implements secure password handling
- Manages logout functionality

## Setup Instructions

1. Install XAMPP
2. Create a MySQL database named "registration"
3. Execute the SQL commands in the Database Setup section to create the database and table "users"
3. Place all 4 files in XAMPP's htdocs directory
4. Access the application through web browser by going to http://localhost/<your-folder-name>/Lab4.html

## Database Setup
    Execute the following SQL commands to set up the database:
        - CREATE DATABASE registration;
        - USE registration;
        - CREATE TABLE users (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            fullname VARCHAR(100) NOT NULL,
          email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );

## Security Features

- Password validation
- MD5 hashing
- Session management
- Secure database connections

