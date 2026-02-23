# 💰 Payment Wallet System

A PHP-based digital wallet application for managing user balances with credit and debit operations. Features session-based authentication and a mock payment gateway for testing.

![PHP](https://img.shields.io/badge/PHP-7.0+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?logo=mysql&logoColor=white)

## 🎯 Features

- **User Authentication** - Session-based login with timeout
- **Wallet Balance** - View current balance
- **Credit Operations** - Add money to wallet
- **Debit Operations** - Withdraw money (with balance check)
- **Mock Gateway** - Simulated payment processing for testing
- **Session Security** - 30-minute automatic logout

## 📁 Project Structure

```
wallet/
├── README.md           # This file
├── conn.php            # Database connection (needs configuration)
├── login.php           # User authentication
├── logout.php          # Session termination
├── homepage.php        # Dashboard after login
├── wallet.php          # Fetch user wallet data
├── credit.php          # Add money to wallet
├── debit.php           # Withdraw money
└── API.php             # Mock payment gateway
```

## 🔄 Application Flow

```
┌─────────────┐     ┌──────────────┐     ┌─────────────┐
│  login.php  │────▶│ homepage.php │────▶│ credit.php  │
│             │     │              │     │ debit.php   │
└─────────────┘     └──────────────┘     └─────────────┘
                           │                    │
                           │                    ▼
                    ┌──────┴──────┐      ┌─────────────┐
                    │ logout.php  │      │ wallet.php  │
                    └─────────────┘      │   API.php   │
                                         └─────────────┘
```

## 🗄️ Database Schema

### Table: `users`

```sql
CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `wallet` DECIMAL(10,2) DEFAULT 0.00,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data
INSERT INTO `users` (`name`, `email`, `wallet`) VALUES
('John Doe', 'john@example.com', 1000.00),
('Jane Smith', 'jane@example.com', 500.00),
('Test User', 'test@example.com', 250.00);
```

## 🚀 Installation

### Prerequisites
- PHP 7.0 or higher
- MySQL 5.7+ / MariaDB
- Apache/Nginx web server
- XAMPP/WAMP/LAMP (recommended for local development)

### Step 1: Clone the repository

```bash
git clone https://github.com/RajmaniShukla/wallet.git
cd wallet
```

### Step 2: Create database

```bash
mysql -u root -p
```

```sql
CREATE DATABASE wallet_db;
USE wallet_db;

CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `wallet` DECIMAL(10,2) DEFAULT 0.00,
    PRIMARY KEY (`id`)
);

INSERT INTO `users` (`name`, `email`, `wallet`) VALUES
('Test User', 'test@example.com', 1000.00);
```

### Step 3: Configure database connection

1. Copy the example configuration:
   ```bash
   cp conn.example.php conn.php
   ```

2. Edit `conn.php` with your credentials:
   ```php
   $db_name1 = "wallet_db";
   $mysql_username = "your_username";
   $mysql_password = "your_password";
   $server_name = "localhost";
   ```

### Step 4: Update URLs

Replace `localhost/Raj_tour/` with your actual path in:
- `login.php`
- `homepage.php`

### Step 5: Access the application

```
http://localhost/wallet/login.php
```

**Demo Credentials:**
- Username: `FirstUser`
- Password: `MyPassword`

## 💻 API Reference

### Mock Gateway (`API.php`)

```php
gateway($action, $amount)
```

| Parameter | Type | Description |
|-----------|------|-------------|
| `$action` | string | "credit" or "debit" |
| `$amount` | int | Amount in currency units |

**Returns:** `1` for success (mock implementation)

### Credit Operation

```php
// credit.php
$amount = 100;
$src_w = $data_w[$i]['wallet'];  // Current balance
if ($trans = gateway("credit", $amount)) {
    $new_balance = $src_w + $amount;
    // Update database
}
```

### Debit Operation

```php
// debit.php
$amount = 100;
$src_w = $data_w[$i]['wallet'];  // Current balance
if ($src_w >= $amount) {  // Balance check
    if ($trans = gateway("debit", $amount)) {
        $new_balance = $src_w - $amount;
        // Update database
    }
} else {
    echo "Low balance!";
}
```

## ⚠️ Security Notice

> **⚠️ WARNING: This is a learning/prototype project with security limitations.**

### Known Issues & Fixes

| Issue | Risk | Fix |
|-------|------|-----|
| Hardcoded credentials | 🔴 Critical | Move to environment variables |
| SQL injection | 🔴 Critical | Use prepared statements |
| Assignment in condition | 🟠 High | Fix `=` to `==` in API.php |
| No CSRF protection | 🟠 High | Add CSRF tokens |
| Session fixation | 🟠 High | Regenerate session ID |

### Recommended Security Improvements

```php
// Use prepared statements
$stmt = $conn1->prepare("UPDATE users SET wallet = ? WHERE id = ?");
$stmt->bind_param("di", $new_balance, $user_id);
$stmt->execute();

// Fix API.php comparison
if ($work == "credit") {  // Use == not =
    return 1;
}

// Add password hashing for real auth
$hashed = password_hash($password, PASSWORD_DEFAULT);
if (password_verify($input, $hashed)) { ... }
```

## 🧪 Testing

### Manual Testing

1. **Login Test**
   - Access `login.php`
   - Enter credentials
   - Verify redirect to `homepage.php`

2. **Credit Test**
   - Note current balance
   - Execute `credit.php`
   - Verify balance increased by 100

3. **Debit Test**
   - Execute `debit.php`
   - Verify balance decreased
   - Test with low balance (should show error)

4. **Session Test**
   - Login and wait 30+ minutes
   - Verify session expiration message

## 🔮 Future Enhancements

- [ ] User registration system
- [ ] Real payment gateway integration (Stripe, Razorpay)
- [ ] Transaction history table
- [ ] Email notifications
- [ ] Multi-currency support
- [ ] Two-factor authentication
- [ ] RESTful API endpoints
- [ ] Admin dashboard

## 📄 License

This project is for educational purposes. Do not use in production without proper security hardening.

## 👤 Author

**Rajmani Shukla**
- GitHub: [@RajmaniShukla](https://github.com/RajmaniShukla)

---

<div align="center">

### 💳 Digital Payments Made Simple

*A learning project for understanding wallet systems*

</div>
