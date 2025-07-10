# Login System

A complete PHP login system with user registration, authentication, and profile management.

## 📁 Project Structure

```
c:\xampp\htdocs\login\
├── config/
│   ├── database.php          # Database configuration
│   └── database.example.php  # Database config template
├── includes/
│   ├── header.php           # Shared header component
│   ├── footer.php           # Shared footer component
│   └── functions.php        # Helper functions
├── auth/
│   ├── login_process.php    # Login form processing
│   ├── register_process.php # Registration form processing
│   ├── logout.php           # Logout functionality
│   ├── forgot_password_process.php  # Password reset request processing
│   └── reset_password_process.php   # Password reset form processing
├── css/
│   └── styles.css           # All CSS styles
├── index.php                # Homepage
├── login.php                # Login form
├── register.php             # Registration form
├── profile.php              # User profile page
├── forgot_password.php      # Password reset request form
├── reset_password.php       # Password reset form
├── setup_database.php       # Database setup script
├── update_database.php      # Database update script (for existing databases)
├── .gitignore              # Git ignore file
└── README.md                # This file
```

## 🚀 Features

- **User Registration** - Secure user account creation
- **User Authentication** - Login with username or email
- **Password Reset** - Secure password reset via email
- **Session Management** - Secure session handling
- **Profile Management** - User profile display
- **Remember Me** - Optional persistent login
- **Password Security** - Bcrypt password hashing
- **SQL Injection Protection** - Prepared statements
- **Input Validation** - Server-side form validation
- **Error Handling** - User-friendly error messages
- **Responsive Design** - Mobile-friendly interface

## 🔧 Setup Instructions

### For New Installations

1. **Start XAMPP** - Start Apache and MySQL services
2. **Copy Database Config** - Copy `config/database.example.php` to `config/database.php` and update credentials
3. **Database Setup** - Visit `http://localhost/login/setup_database.php` to create database and tables
4. **Test Login** - Use test credentials to verify functionality

### For Existing Installations (Adding Password Reset)

1. **Update Database** - Visit `http://localhost/login/update_database.php` to add reset token columns
2. **Configure Email** - Update email settings in `auth/forgot_password_process.php` for production

## 🔐 Test Credentials

- **Username:** `testuser`
- **Email:** `test@example.com` 
- **Password:** `password123`

## 📄 File Descriptions

### Core Pages
- `index.php` - Homepage with navigation
- `login.php` - User login form
- `register.php` - New user registration form
- `profile.php` - User profile page (requires login)
- `forgot_password.php` - Password reset request form
- `reset_password.php` - Password reset form (token required)

### Authentication
- `auth/login_process.php` - Handles login form submission
- `auth/register_process.php` - Handles registration form submission
- `auth/logout.php` - Logs user out and destroys session
- `auth/forgot_password_process.php` - Handles password reset requests
- `auth/reset_password_process.php` - Handles password reset form submission

### Setup & Configuration
- `setup_database.php` - Initial database and table creation
- `update_database.php` - Adds password reset columns to existing databases
- `config/database.php` - Database connection settings
- `config/database.example.php` - Database configuration template

### Includes
- `includes/header.php` - Dynamic header with login/logout states
- `includes/footer.php` - Shared footer component
- `includes/functions.php` - Helper functions for authentication

### Styling
- `css/styles.css` - All CSS styles for the application

## 🛡️ Security Features

- Password hashing using PHP's `password_hash()`
- SQL injection protection with PDO prepared statements
- Session-based authentication
- Input validation and sanitization
- Secure password reset with time-limited tokens
- Token-based password reset (expires in 1 hour)
- Automatic login after successful password reset
- CSRF protection ready (can be added)
- XSS protection with output escaping

## 🎨 Design Features

- Clean, modern interface
- Consistent styling across all pages
- Responsive design for mobile devices
- User-friendly error messages
- Dynamic navigation based on login state
- Professional form styling

## 📱 Usage

1. **Homepage** - Navigate to `http://localhost/login/`
2. **Register** - Create a new account
3. **Login** - Sign in with your credentials
4. **Profile** - View your profile information
5. **Forgot Password** - Use the "Forgot Password?" link on the login page
6. **Reset Password** - Check your email and follow the reset link
7. **Logout** - Sign out safely

## 🔄 Password Reset Workflow

1. User visits the login page and clicks "Forgot Password?"
2. User enters their email address on the forgot password page
3. System generates a secure token and sends reset email
4. User clicks the reset link in their email
5. User enters their new password on the reset form
6. System validates the token and updates the password
7. User is automatically logged in and redirected to their profile

## 📧 Email Configuration

For production use, update the email settings in `auth/forgot_password_process.php`:
- Configure SMTP settings for reliable email delivery
- Update the "From" email address
- Customize the email template as needed

The system currently simulates successful email sending for local development.

The system is production-ready and can be extended with additional features as needed.
