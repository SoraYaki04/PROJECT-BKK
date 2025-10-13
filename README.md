# BKK (Bursa Kerja Khusus) - SMKN 1 Boyolangu

A comprehensive job portal system for vocational schools, specifically designed for SMKN 1 Boyolangu.

## 🚀 Features

- **Multi-User System**: Admin, Management, Students/Alumni, Recruiters, and Other Users
- **Job Portal**: Complete job listing and application system
- **Company Management**: CRUD operations for company profiles
- **Activity Information**: BKK activity updates and news
- **Survey System**: Feedback collection from users
- **Tracer Study**: Alumni tracking and monitoring
- **Profile Management**: User profile handling
- **Security**: CSRF protection, session management, role-based access

## 📋 Requirements

- XAMPP (Apache + MySQL + PHP)
- PHP 7.4 or higher
- MySQL 5.7 or higher (MariaDB 10.4+)
- Web browser

## 🛠️ Installation

### 1. Clone/Download the Project
```bash
# If using git
git clone [repository-url]
# Or download and extract to your XAMPP htdocs folder
```

### 2. Start XAMPP Services
1. Open XAMPP Control Panel
2. Start Apache and MySQL services
3. Ensure both services are running (green status)

### 3. Database Setup

#### Option A: Using Setup Script (Recommended)
1. Open your browser
2. Navigate to: `http://localhost/PROJECT-BKK-main/BKK/tools/setup_database.php`
3. Follow the on-screen instructions

#### Option B: Using phpMyAdmin
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Create a new database named `bkk`
3. Import the file: `db/bkk_clean.sql`

#### Option C: Using Command Line
```bash
# Navigate to MySQL bin directory
cd C:\xampp\mysql\bin

# Import the database
mysql -u root -p bkk < C:\xampp\htdocs\PROJECT-BKK-main\db\bkk_clean.sql
```

### 4. Access the Application
1. Open your browser
2. Navigate to: `http://localhost/PROJECT-BKK-main/`
3. The application will redirect to the main page

## 👥 User Roles

### Admin
- Full system access
- User management
- System configuration
- Database management

### Management
- Job posting management
- Company profile management
- Activity information management
- Reports and analytics

### Students/Alumni
- View job listings
- Apply for jobs
- Update profile
- Participate in surveys
- Tracer study participation

### Recruiters
- Post job listings
- Manage applications
- View candidate profiles

### Other Users
- View public information
- Access general resources

## 📁 Project Structure

```
PROJECT-BKK-main/
├── BKK/
│   ├── config/           # Configuration files
│   ├── CRUD/            # CRUD operations
│   ├── Home/            # Main pages
│   ├── Login/           # Authentication system
│   ├── Loker/           # Job portal
│   ├── Perusahaan/      # Company management
│   ├── Survey/          # Survey system
│   ├── TracerStudy/     # Alumni tracking
│   └── uploads/         # File uploads
├── db/                  # Database files
└── index.php           # Main entry point
```

## 🔧 Configuration

### Database Connection
Edit `BKK/koneksi.php` if you need to change database settings:
```php
$host = "localhost";
$user = "root";
$password = "";
$database = "bkk";
```

### Security Settings
Security configurations are in `BKK/config/security.php`

## 🚨 Troubleshooting

### MySQL Connection Issues
1. Ensure XAMPP MySQL service is running
2. Check if port 3306 is not blocked
3. Verify database credentials in `koneksi.php`

### Apache Issues
1. Check if port 80 is not in use
2. Ensure Apache service is running
3. Check XAMPP error logs

### File Upload Issues
1. Ensure `uploads/` directory has write permissions
2. Check PHP upload settings in `php.ini`

## 📞 Support

For technical support or questions:
- Check the setup script: `http://localhost/PROJECT-BKK-main/BKK/tools/setup_database.php`
- Review error logs in XAMPP
- Contact system administrator

## 🔒 Security Notes

- Change default database passwords in production
- Regularly update PHP and MySQL versions
- Implement HTTPS in production environment
- Regular backup of database and files

## 📝 License

This project is developed for SMKN 1 Boyolangu. All rights reserved.

---

**Version**: 1.0  
**Last Updated**: 2024  
**Developed for**: SMKN 1 Boyolangu
