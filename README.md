# 🏨 Hotel Management System - Boutique Hotel Cameroon Edition

A comprehensive hotel management system designed specifically for boutique hotels in Cameroon, featuring elegant glassmorphism styling, role-based access control, and authentic Cameroonian imagery.

## 🌟 Features

### 🔓 Public Pages
- **Landing Page**: Hero section with Cameroonian hotel imagery and CTA buttons
- **Gallery Page**: Interactive image carousel with modal zoom functionality
- **Services Page**: Interactive cards showcasing hotel amenities and pricing
- **Booking Page**: Room selector with availability checker and guest information form
- **Contact Page**: Inquiry form with embedded map and FAQ section

### 🛠️ Admin Dashboard
- **Comprehensive Analytics**: Real-time statistics for reservations, occupancy, and revenue
- **Reservation Management**: Full CRUD operations for bookings with status tracking
- **Room Management**: Visual room status grid with availability tracking
- **Guest Management**: Customer database with booking history
- **Staff Management**: User roles and permissions
- **Housekeeping Tasks**: Room cleaning and maintenance scheduling
- **Service Management**: Additional services and pricing management
- **Financial Reports**: Revenue tracking and payment management
- **System Settings**: Hotel configuration and preferences

### 👥 Role-Based Access Control
- **Admin**: Full system access and management
- **Receptionist**: Reservation and guest management
- **Housekeeping**: Room status and cleaning tasks
- **Restaurant Staff**: Food service and dining reservations
- **Spa Staff**: Wellness service management
- **Guest Portal**: Personal booking management and services

### 💰 FCFA Currency Integration
- All pricing displayed in Central African CFA franc (FCFA)
- Localized currency formatting
- Payment method support for local payment systems

### 🎨 Design Features
- **Glassmorphism UI**: Modern frosted glass aesthetic
- **Bootstrap 5**: Responsive design framework
- **Cameroon Color Scheme**: Green, Gold, and Red theme
- **Mobile-First**: Fully responsive across all devices
- **Dark Theme**: Elegant dark interface with glass effects

## 🚀 Technology Stack

- **Backend**: PHP 8.0+ with PDO for database operations
- **Frontend**: Bootstrap 5 with custom CSS and JavaScript
- **Database**: MySQL 8.0+ with optimized schema
- **Authentication**: PHP Sessions with CSRF protection
- **Security**: Input sanitization and role-based permissions
- **Architecture**: MVC-inspired structure with clean separation

## 📋 Prerequisites

- PHP 8.0 or higher
- MySQL 8.0 or higher
- Apache/Nginx web server
- Composer (optional, for dependencies)

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd hotel-management-system
```

### 2. Database Setup
```bash
# Create database
mysql -u root -p
CREATE DATABASE hotel_management_cm;
exit

# Import schema
mysql -u root -p hotel_management_cm < database/schema.sql
```

### 3. Configuration
```bash
# Copy and configure database settings
cp config/database.php.example config/database.php
# Edit database credentials in config/database.php
```

### 4. File Permissions
```bash
# Set appropriate permissions
chmod 755 assets/images/
chmod 644 config/database.php
```

### 5. Web Server Configuration

#### Apache (.htaccess included)
```apache
# Ensure mod_rewrite is enabled
a2enmod rewrite
systemctl restart apache2
```

#### Nginx
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
}
```

## 🔑 Default Login Credentials

| Role | Username | Password | Description |
|------|----------|----------|-------------|
| Admin | admin | admin123 | Full system access |
| Receptionist | reception | reception123 | Front desk operations |
| Housekeeping | housekeeping | house123 | Room management |
| Guest | guest | guest123 | Guest portal |

**⚠️ Important**: Change default passwords before production deployment!

## 📁 Project Structure

```
hotel-management-system/
├── assets/
│   ├── css/
│   │   └── style.css          # Glassmorphism styling
│   ├── js/
│   │   └── main.js           # Interactive functionality
│   └── images/
│       ├── gallery/          # Hotel gallery images
│       ├── rooms/           # Room type images
│       └── avatars/         # User profile images
├── auth/
│   ├── login.php            # Login page
│   └── logout.php           # Logout handler
├── config/
│   └── database.php         # Database configuration
├── dashboard/
│   ├── admin/
│   │   └── index.php        # Admin dashboard
│   ├── receptionist/        # Receptionist interface
│   ├── housekeeping/        # Housekeeping interface
│   └── guest/              # Guest portal
├── database/
│   └── schema.sql          # Database schema
├── includes/
│   ├── header.php          # Common header
│   ├── footer.php          # Common footer
│   └── functions.php       # Utility functions
├── public/
│   ├── landing.php         # Landing page
│   ├── gallery.php         # Gallery page
│   ├── services.php        # Services page
│   ├── booking.php         # Booking page
│   └── contact.php         # Contact page
├── api/
│   ├── process_booking.php  # Booking API
│   └── process_contact.php  # Contact API
└── index.php               # Main entry point
```

## 🔧 Configuration

### Database Configuration
Edit `config/database.php`:
```php
private $host = "localhost";
private $db_name = "hotel_management_cm";
private $username = "your_username";
private $password = "your_password";
```

### Hotel Settings
Customize hotel information in the database `settings` table:
- Hotel name and address
- Contact information
- Check-in/check-out times
- Currency and tax rates

## 🎨 Customization

### Adding New Room Types
1. Insert into `room_types` table
2. Add room images to `assets/images/rooms/`
3. Update room selection in booking form

### Custom Styling
- Modify `assets/css/style.css` for design changes
- Colors are defined in CSS custom properties
- Glassmorphism effects can be adjusted in `.glass-*` classes

### Adding New User Roles
1. Update `users` table role enum
2. Create new dashboard in `dashboard/` directory
3. Add role-specific permissions in `includes/functions.php`

## 🔒 Security Features

- **CSRF Protection**: All forms include CSRF tokens
- **Input Sanitization**: All user inputs are sanitized
- **SQL Injection Prevention**: Prepared statements used throughout
- **Session Security**: Secure session configuration
- **Role-Based Access**: Strict permission checking
- **Password Hashing**: bcrypt password hashing

## 🚀 Deployment

### Production Checklist
- [ ] Change default passwords
- [ ] Update database credentials
- [ ] Set up SSL certificate
- [ ] Configure backup system
- [ ] Set appropriate file permissions
- [ ] Enable PHP OPcache
- [ ] Configure error logging
- [ ] Set up monitoring

### Performance Optimization
- Enable PHP OPcache
- Use database indexing (already included in schema)
- Implement image optimization
- Configure caching headers
- Minimize CSS/JS files

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials in `config/database.php`
   - Ensure MySQL service is running
   - Verify database exists

2. **Login Issues**
   - Clear browser cache and cookies
   - Check user exists in database
   - Verify session configuration

3. **File Upload Issues**
   - Check file permissions on uploads directory
   - Verify PHP upload settings
   - Ensure adequate disk space

4. **Styling Issues**
   - Clear browser cache
   - Check CSS file paths
   - Verify Bootstrap CDN accessibility

## 📚 API Documentation

### Booking API
**Endpoint**: `POST /api/process_booking.php`

**Required Fields**:
- `check_in` (date)
- `check_out` (date)
- `room_type` (integer)
- `first_name` (string)
- `last_name` (string)
- `email` (string)
- `phone` (string)
- `id_type` (string)
- `id_number` (string)
- `csrf_token` (string)

**Response**:
```json
{
  "success": true,
  "reservation_number": "RES20241201001",
  "total_amount": 135000,
  "room_info": {
    "room_type": "Chambre Deluxe",
    "nights": 3
  }
}
```

### Contact API
**Endpoint**: `POST /api/process_contact.php`

**Required Fields**:
- `name` (string)
- `email` (string)
- `subject` (string)
- `message` (string)
- `csrf_token` (string)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🎯 Roadmap

### Upcoming Features
- [ ] Email notifications for bookings
- [ ] Mobile app development
- [ ] Integration with payment gateways
- [ ] Advanced reporting and analytics
- [ ] Multi-language support
- [ ] Calendar view for reservations
- [ ] Inventory management system
- [ ] Customer loyalty program

### Version History
- **v1.0.0** - Initial release with core functionality
- **v1.1.0** - Enhanced dashboard and reporting (planned)
- **v1.2.0** - Mobile app integration (planned)

## 📞 Support

For support and questions:
- Email: support@hotelboutique.cm
- Documentation: [Project Wiki]
- Issues: [GitHub Issues]

---

**Made with ❤️ for Cameroonian hospitality industry**