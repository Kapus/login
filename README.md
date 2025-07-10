# Login System

A complete PHP login system with user registration, authentication, and profile management.

## 📁 Project Structure

```
c:\xampp\htdocs\login\
├── config/
│   └── database.php          # Database configuration
├── includes/
│   ├── header.php           # Shared header component
│   ├── footer.php           # Shared footer component
│   └── functions.php        # Helper functions
├── auth/
│   ├── login_process.php    # Login form processing
│   ├── register_process.php # Registration form processing
│   └── logout.php           # Logout functionality
├── css/
│   └── styles.css           # All CSS styles
├── index.php                # Homepage
├── login.php                # Login form
├── register.php             # Registration form
├── profile.php              # User profile page
└── README.md                # This file
```

## 🚀 Features

- **User Registration** - Secure user account creation
- **User Authentication** - Login with username or email
- **Session Management** - Secure session handling
- **Profile Management** - User profile display
- **Remember Me** - Optional persistent login
- **Password Security** - Bcrypt password hashing
- **SQL Injection Protection** - Prepared statements
- **Input Validation** - Server-side form validation
- **Error Handling** - User-friendly error messages
- **Responsive Design** - Mobile-friendly interface

## 🔧 Setup Instructions

1. **Start XAMPP** - Start Apache and MySQL services
2. **Database Setup** - Create database and user table (run once)
3. **Test Login** - Use test credentials to verify functionality

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

### Authentication
- `auth/login_process.php` - Handles login form submission
- `auth/register_process.php` - Handles registration form submission
- `auth/logout.php` - Logs user out and destroys session

### Includes
- `includes/header.php` - Dynamic header with login/logout states
- `includes/footer.php` - Shared footer component
- `includes/functions.php` - Helper functions for authentication

### Configuration
- `config/database.php` - Database connection settings

### Styling
- `css/styles.css` - All CSS styles for the application

## 🛡️ Security Features

- Password hashing using PHP's `password_hash()`
- SQL injection protection with PDO prepared statements
- Session-based authentication
- Input validation and sanitization
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
5. **Logout** - Sign out safely

The system is production-ready and can be extended with additional features as needed.
