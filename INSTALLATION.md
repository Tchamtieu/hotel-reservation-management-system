# 🚀 Quick Installation Guide

## 1. System Requirements
- PHP 8.0+ 
- MySQL 8.0+
- Apache/Nginx
- Web browser with JavaScript enabled

## 2. Installation Steps

### Download & Setup
```bash
# Clone or download the project
git clone <repository-url>
cd hotel-management-system

# Set file permissions
chmod 755 assets/images/
chmod 644 config/database.php
```

### Database Setup
```sql
-- Create database
CREATE DATABASE hotel_management_cm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Import schema
SOURCE database/schema.sql;
```

### Configuration
1. Edit `config/database.php` with your database credentials
2. Update hotel settings in the database `settings` table
3. Ensure your web server has mod_rewrite enabled

### Test Login
Visit your website and login with:
- **Admin**: username `admin`, password `admin123`
- **Reception**: username `reception`, password `reception123`

## 3. What's Included

✅ **Complete Hotel Management System**
- Public website with booking system
- Admin dashboard with analytics
- Role-based access control (Admin, Receptionist, Housekeeping, Guest, Restaurant, Spa)
- FCFA currency integration
- Glassmorphism UI design
- Responsive mobile-first layout

✅ **Core Features**
- Room reservation management
- Guest check-in/check-out
- Housekeeping task management
- Service bookings (Restaurant, Spa)
- Financial reporting
- Contact form with inquiries

✅ **Security Features**
- CSRF protection
- SQL injection prevention
- Input sanitization
- Role-based permissions
- Secure password hashing

✅ **Cameroon-Specific**
- FCFA currency throughout
- Green, Gold, Red color scheme
- French language interface
- Local business practices

## 4. File Structure
```
hotel-management-system/
├── index.php              # Main entry point
├── config/database.php    # Database configuration
├── database/schema.sql    # Database schema
├── auth/                  # Authentication
├── public/                # Public pages
├── dashboard/             # Role-based dashboards
├── api/                   # API endpoints
├── assets/                # CSS, JS, Images
└── includes/              # Common components
```

## 5. Next Steps

1. **Customize**: Update hotel information in database settings
2. **Images**: Add real hotel images to `assets/images/`
3. **Security**: Change default passwords in production
4. **Backup**: Set up regular database backups
5. **SSL**: Configure HTTPS for production

## 6. Troubleshooting

**Database connection error?**
- Check credentials in `config/database.php`
- Verify MySQL is running

**Can't login?**
- Clear browser cache
- Check if user exists in database

**Styling issues?**
- Clear browser cache
- Check if Bootstrap CDN is accessible

**Need help?** Check the full README.md for detailed documentation.

---
🏨 **Ready to manage your hotel like a pro!**