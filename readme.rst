---

# CodeIgniter 3.1.8 Authentication System

This project demonstrates a **user authentication system** with features like **registration, login, password reset, profile update**, and JWT-based token authentication built on **CodeIgniter 3.1.8** with **PHP 7.4**.

## Prerequisites

Before starting, ensure that you have the following installed on your machine:

- **PHP 7.4**
- **CodeIgniter 3.1.8** or later
- **Composer** (PHP Dependency Manager)
- **Firebase JWT Package** for handling JSON Web Tokens

## Getting Started

### Step 1: Clone the Repository

```bash
git clone https://github.com/your-repo/codeigniter-auth-system.git
cd codeigniter-auth-system
```

### Step 2: Set up CodeIgniter and PHP

1. Download and set up **CodeIgniter 3.1.8**:
   - [Download CodeIgniter 3.1.8](https://codeigniter.com/download)

2. Ensure you are using **PHP 7.4** by checking your PHP version:

```bash
php -v
```

3. Extract the CodeIgniter package in your project folder if needed and ensure the project runs by navigating to:

```bash
http://localhost/CodeIgniter/
```

You should see the **Welcome to CodeIgniter** screen.

### Step 3: Database Configuration

1. Create a MySQL database, e.g., `ignitor`.
2. Update the database credentials in `application/config/database.php`:

```php
'hostname' => 'localhost',
'username' => 'your_username',
'password' => 'your_password',
'database' => 'ignitor',
```

3. Run the migrations to set up the necessary database tables:

```bash
http://localhost/CodeIgniter/migrate
```

### Step 4: Install Dependencies

Run the following composer command to install **Firebase JWT** package:

```bash
composer require firebase/php-jwt
```

This package is essential for implementing JWT-based authentication.

### Step 5: Routing Configuration

Ensure that the routes in `application/config/routes.php` are correctly set:

```php
$route['default_controller'] = 'welcome';
$route['login'] = 'UserController/login_view';
$route['register'] = 'UserController/index';
$route['api/login'] = 'UserController/login';
$route['api/register'] = 'UserController/register';
$route['dashboard'] = 'UserController/dashboard';
$route['auth/forgot_password'] = 'Auth/forgot_password';
$route['auth/send_reset_link'] = 'Auth/send_reset_link';
$route['auth/reset_password/(:any)'] = 'Auth/reset_password/$1';
$route['auth/update_password'] = 'Auth/update_password';
$route['auth/test_email'] = 'Auth/test_email';
$route['settings'] = 'auth/settings';
$route['auth/change_password'] = 'auth/change_password';
$route['auth/update_profile'] = 'auth/update_profile';
```

---

## Features

### User Registration

- Navigate to:

```bash
http://localhost/CodeIgniter/register
```

- Enter a valid email and password (Password must be 8 characters long and alphanumeric, e.g., `Afsar@123`).
- Successfully register the user.

### User Login

- Navigate to:

```bash
http://localhost/CodeIgniter/login
```

- Enter your registered email and password to log in.

### Password Reset

- If you forgot your password, click on the **Forgot Password** link on the login page.
- You will be redirected to:

```bash
http://localhost/CodeIgniter/auth/forgot_password
```

- Enter your registered email. If the email exists in the system, a reset link will be sent to your inbox.

- Check your email, click on the reset link, and you'll be redirected to:

```bash
http://localhost/CodeIgniter/auth/reset_password/your_token
```

- Enter your new password and confirm it. Once submitted, your password will be updated, and you'll be redirected to the login page.

### Profile Settings

Once logged in, you can manage your account:

- Navigate to:

```bash
http://localhost/CodeIgniter/settings
```

- **Change your password** by entering your current and new passwords.
- **Update your profile** (full name, phone number, etc.).

---

## Conclusion

This project provides a fully functional **authentication system** with JWT integration. Users can **register, log in, reset their password**, and **update their profiles**. This application serves as a solid foundation for more complex user management systems.

Feel free to contribute or raise any issues you encounter.

---