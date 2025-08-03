-- Hotel Management System Database Schema for Cameroon
-- Drop database if exists and create new one
DROP DATABASE IF EXISTS hotel_management_cm;
CREATE DATABASE hotel_management_cm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hotel_management_cm;

-- Users table for authentication and role management
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    role ENUM('admin', 'receptionist', 'housekeeping', 'guest', 'restaurant', 'spa') NOT NULL,
    phone VARCHAR(20),
    avatar VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Room types table
CREATE TABLE room_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    base_price DECIMAL(10,2) NOT NULL,
    max_occupancy INT NOT NULL,
    amenities JSON,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Rooms table
CREATE TABLE rooms (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_number VARCHAR(10) UNIQUE NOT NULL,
    room_type_id INT NOT NULL,
    floor INT NOT NULL,
    status ENUM('available', 'occupied', 'maintenance', 'cleaning') DEFAULT 'available',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (room_type_id) REFERENCES room_types(id)
);

-- Guests table
CREATE TABLE guests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    id_number VARCHAR(50),
    id_type ENUM('passport', 'national_id', 'driving_license') NOT NULL,
    nationality VARCHAR(50),
    date_of_birth DATE,
    address TEXT,
    emergency_contact_name VARCHAR(100),
    emergency_contact_phone VARCHAR(20),
    special_requests TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Reservations table
CREATE TABLE reservations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    reservation_number VARCHAR(20) UNIQUE NOT NULL,
    guest_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    adults INT NOT NULL DEFAULT 1,
    children INT DEFAULT 0,
    total_amount DECIMAL(10,2) NOT NULL,
    paid_amount DECIMAL(10,2) DEFAULT 0,
    status ENUM('pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled', 'no_show') DEFAULT 'pending',
    payment_status ENUM('pending', 'partial', 'paid', 'refunded') DEFAULT 'pending',
    special_requests TEXT,
    notes TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (guest_id) REFERENCES guests(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Services table (Restaurant, Spa, etc.)
CREATE TABLE services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category ENUM('restaurant', 'spa', 'laundry', 'transport', 'other') NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Service bookings table
CREATE TABLE service_bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    guest_id INT NOT NULL,
    service_id INT NOT NULL,
    room_id INT,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    quantity INT DEFAULT 1,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    special_requests TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (guest_id) REFERENCES guests(id),
    FOREIGN KEY (service_id) REFERENCES services(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

-- Housekeeping tasks table
CREATE TABLE housekeeping_tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_id INT NOT NULL,
    assigned_to INT,
    task_type ENUM('cleaning', 'maintenance', 'inspection', 'deep_clean') NOT NULL,
    priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    description TEXT,
    status ENUM('pending', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending',
    estimated_duration INT, -- in minutes
    started_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    notes TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (room_id) REFERENCES rooms(id),
    FOREIGN KEY (assigned_to) REFERENCES users(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Payments table
CREATE TABLE payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    reservation_id INT,
    service_booking_id INT,
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('cash', 'card', 'mobile_money', 'bank_transfer', 'other') NOT NULL,
    payment_reference VARCHAR(100),
    status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    processed_by INT,
    processed_at TIMESTAMP NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reservation_id) REFERENCES reservations(id),
    FOREIGN KEY (service_booking_id) REFERENCES service_bookings(id),
    FOREIGN KEY (processed_by) REFERENCES users(id)
);

-- Inventory table
CREATE TABLE inventory (
    id INT PRIMARY KEY AUTO_INCREMENT,
    item_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    current_stock INT NOT NULL DEFAULT 0,
    minimum_stock INT NOT NULL DEFAULT 0,
    unit_price DECIMAL(10,2),
    supplier VARCHAR(100),
    last_restocked DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Gallery images table
CREATE TABLE gallery_images (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    image_path VARCHAR(255) NOT NULL,
    category ENUM('rooms', 'restaurant', 'spa', 'facilities', 'exterior', 'events') NOT NULL,
    is_featured BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    uploaded_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
);

-- Contact inquiries table
CREATE TABLE contact_inquiries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'in_progress', 'resolved', 'closed') DEFAULT 'new',
    assigned_to INT,
    responded_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);

-- System settings table
CREATE TABLE settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    description TEXT,
    category VARCHAR(50) DEFAULT 'general',
    updated_by INT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (updated_by) REFERENCES users(id)
);

-- Audit log table
CREATE TABLE audit_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    table_name VARCHAR(50) NOT NULL,
    record_id INT NOT NULL,
    action ENUM('CREATE', 'UPDATE', 'DELETE') NOT NULL,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert default data
-- Insert default admin user (password: admin123)
INSERT INTO users (username, email, password_hash, first_name, last_name, role) VALUES 
('admin', 'admin@hotelboutique.cm', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'System', 'admin');

-- Insert room types
INSERT INTO room_types (name, description, base_price, max_occupancy, amenities) VALUES 
('Chambre Standard', 'Chambre confortable avec vue sur la ville', 45000.00, 2, '["WiFi gratuit", "TV écran plat", "Climatisation", "Mini-bar"]'),
('Chambre Deluxe', 'Chambre spacieuse avec balcon et vue panoramique', 65000.00, 3, '["WiFi gratuit", "TV écran plat", "Climatisation", "Mini-bar", "Balcon", "Coffre-fort"]'),
('Suite Junior', 'Suite avec salon séparé et terrasse privée', 95000.00, 4, '["WiFi gratuit", "TV écran plat", "Climatisation", "Mini-bar", "Salon séparé", "Terrasse", "Service en chambre 24h"]'),
('Suite Présidentielle', 'Suite luxueuse avec jacuzzi et service personnalisé', 150000.00, 6, '["WiFi gratuit", "TV écran plat", "Climatisation", "Mini-bar", "Jacuzzi", "Service de majordome", "Terrasse panoramique"]');

-- Insert sample rooms
INSERT INTO rooms (room_number, room_type_id, floor) VALUES 
('101', 1, 1), ('102', 1, 1), ('103', 1, 1), ('104', 2, 1), ('105', 2, 1),
('201', 2, 2), ('202', 2, 2), ('203', 3, 2), ('204', 3, 2),
('301', 3, 3), ('302', 4, 3);

-- Insert services
INSERT INTO services (name, category, description, price) VALUES 
('Petit-déjeuner Continental', 'restaurant', 'Petit-déjeuner buffet avec spécialités locales et internationales', 8500.00),
('Massage Relaxant', 'spa', 'Massage thérapeutique de 60 minutes', 25000.00),
('Service de Blanchisserie', 'laundry', 'Nettoyage et repassage express', 5000.00),
('Transport Aéroport', 'transport', 'Navette privée vers l\'aéroport de Yaoundé', 15000.00),
('Dîner Gastronomique', 'restaurant', 'Menu dégustation avec vins locaux', 35000.00);

-- Insert gallery images (placeholder paths)
INSERT INTO gallery_images (title, description, image_path, category, is_featured) VALUES 
('Façade Principale', 'Vue de la façade principale de l\'hôtel', 'assets/images/gallery/facade.jpg', 'exterior', TRUE),
('Chambre Deluxe', 'Intérieur d\'une chambre deluxe', 'assets/images/gallery/room-deluxe.jpg', 'rooms', TRUE),
('Restaurant Panoramique', 'Vue du restaurant avec terrasse', 'assets/images/gallery/restaurant.jpg', 'restaurant', TRUE),
('Spa Wellness', 'Centre de bien-être et spa', 'assets/images/gallery/spa.jpg', 'spa', TRUE),
('Piscine Infinity', 'Piscine à débordement avec vue sur la ville', 'assets/images/gallery/pool.jpg', 'facilities', TRUE);

-- Insert system settings
INSERT INTO settings (setting_key, setting_value, description, category) VALUES 
('hotel_name', 'Hôtel Boutique Cameroun', 'Nom de l\'hôtel', 'general'),
('hotel_address', 'Yaoundé, Cameroun', 'Adresse de l\'hôtel', 'general'),
('hotel_phone', '+237 6XX XXX XXX', 'Numéro de téléphone principal', 'general'),
('hotel_email', 'contact@hotelboutique.cm', 'Email de contact principal', 'general'),
('currency', 'FCFA', 'Devise utilisée', 'general'),
('tax_rate', '19.25', 'Taux de TVA (en %)', 'financial'),
('check_in_time', '14:00', 'Heure d\'arrivée standard', 'operations'),
('check_out_time', '12:00', 'Heure de départ standard', 'operations');

-- Create indexes for better performance
CREATE INDEX idx_reservations_dates ON reservations(check_in_date, check_out_date);
CREATE INDEX idx_reservations_status ON reservations(status);
CREATE INDEX idx_rooms_status ON rooms(status);
CREATE INDEX idx_users_role ON users(role);
CREATE INDEX idx_housekeeping_status ON housekeeping_tasks(status);
CREATE INDEX idx_payments_status ON payments(status);
CREATE INDEX idx_gallery_category ON gallery_images(category);
CREATE INDEX idx_services_category ON services(category);

-- Create views for common queries
CREATE VIEW room_availability AS
SELECT 
    r.id,
    r.room_number,
    rt.name as room_type,
    rt.base_price,
    r.status,
    CASE 
        WHEN r.status = 'available' THEN 'Disponible'
        WHEN r.status = 'occupied' THEN 'Occupée'
        WHEN r.status = 'maintenance' THEN 'Maintenance'
        WHEN r.status = 'cleaning' THEN 'Nettoyage'
    END as status_fr
FROM rooms r
JOIN room_types rt ON r.room_type_id = rt.id;

CREATE VIEW current_guests AS
SELECT 
    g.first_name,
    g.last_name,
    g.email,
    g.phone,
    r.room_number,
    res.check_in_date,
    res.check_out_date,
    res.status
FROM guests g
JOIN reservations res ON g.id = res.guest_id
JOIN rooms r ON res.room_id = r.id
WHERE res.status IN ('confirmed', 'checked_in')
AND res.check_in_date <= CURDATE()
AND res.check_out_date >= CURDATE();

-- Create stored procedures
DELIMITER //

CREATE PROCEDURE GetRoomAvailability(IN check_in DATE, IN check_out DATE)
BEGIN
    SELECT 
        r.id,
        r.room_number,
        rt.name as room_type,
        rt.base_price,
        rt.max_occupancy
    FROM rooms r
    JOIN room_types rt ON r.room_type_id = rt.id
    WHERE r.status = 'available'
    AND r.id NOT IN (
        SELECT room_id 
        FROM reservations 
        WHERE status IN ('confirmed', 'checked_in')
        AND NOT (check_out_date <= check_in OR check_in_date >= check_out)
    );
END //

CREATE PROCEDURE CalculateRevenue(IN start_date DATE, IN end_date DATE)
BEGIN
    SELECT 
        SUM(p.amount) as total_revenue,
        COUNT(DISTINCT res.id) as total_reservations,
        AVG(p.amount) as average_payment
    FROM payments p
    JOIN reservations res ON p.reservation_id = res.id
    WHERE p.status = 'completed'
    AND p.processed_at BETWEEN start_date AND end_date;
END //

DELIMITER ;

-- Create triggers for audit logging
DELIMITER //

CREATE TRIGGER audit_users_insert
    AFTER INSERT ON users
    FOR EACH ROW
BEGIN
    INSERT INTO audit_logs (user_id, table_name, record_id, action, new_values)
    VALUES (NEW.id, 'users', NEW.id, 'CREATE', JSON_OBJECT(
        'username', NEW.username,
        'email', NEW.email,
        'role', NEW.role
    ));
END //

CREATE TRIGGER audit_reservations_update
    AFTER UPDATE ON reservations
    FOR EACH ROW
BEGIN
    INSERT INTO audit_logs (user_id, table_name, record_id, action, old_values, new_values)
    VALUES (NEW.created_by, 'reservations', NEW.id, 'UPDATE', 
        JSON_OBJECT('status', OLD.status, 'total_amount', OLD.total_amount),
        JSON_OBJECT('status', NEW.status, 'total_amount', NEW.total_amount)
    );
END //

DELIMITER ;