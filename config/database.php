<?php
// Database Configuration for Hotel Cameroun Management System

class Database {
    private $host = 'localhost';
    private $db_name = 'hotel_cameroun';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

// Sample Data for Development
class SampleData {
    public static function getUsers() {
        return [
            [
                'id' => 1,
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'email' => 'admin@hotelcameroun.com',
                'role' => 'admin',
                'first_name' => 'Jean',
                'last_name' => 'Mbeki',
                'phone' => '+237 222 123 456',
                'status' => 'active',
                'hotel_location' => 'all'
            ],
            [
                'id' => 2,
                'username' => 'receptionist1',
                'password' => password_hash('recep123', PASSWORD_DEFAULT),
                'email' => 'reception@hilton-yaounde.com',
                'role' => 'receptionist',
                'first_name' => 'Marie',
                'last_name' => 'Nsona',
                'phone' => '+237 222 234 567',
                'status' => 'active',
                'hotel_location' => 'hilton-yaounde'
            ],
            [
                'id' => 3,
                'username' => 'housekeeper1',
                'password' => password_hash('house123', PASSWORD_DEFAULT),
                'email' => 'housekeeping@k-hotel-douala.com',
                'role' => 'housekeeping',
                'first_name' => 'Grace',
                'last_name' => 'Fon',
                'phone' => '+237 233 345 678',
                'status' => 'active',
                'hotel_location' => 'k-hotel-douala'
            ],
            [
                'id' => 4,
                'username' => 'restaurant1',
                'password' => password_hash('resto123', PASSWORD_DEFAULT),
                'email' => 'restaurant@mountain-hotel-buea.com',
                'role' => 'restaurant',
                'first_name' => 'Paul',
                'last_name' => 'Biya',
                'phone' => '+237 244 456 789',
                'status' => 'active',
                'hotel_location' => 'mountain-hotel-buea'
            ],
            [
                'id' => 5,
                'username' => 'spa1',
                'password' => password_hash('spa123', PASSWORD_DEFAULT),
                'email' => 'spa@hotelcameroun.com',
                'role' => 'spa',
                'first_name' => 'Aminata',
                'last_name' => 'Kone',
                'phone' => '+237 255 567 890',
                'status' => 'active',
                'hotel_location' => 'hilton-yaounde'
            ],
            [
                'id' => 6,
                'username' => 'guest1',
                'password' => password_hash('guest123', PASSWORD_DEFAULT),
                'email' => 'john.doe@email.com',
                'role' => 'guest',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '+1 555 123 4567',
                'status' => 'active',
                'hotel_location' => 'hilton-yaounde'
            ]
        ];
    }

    public static function getBookings() {
        return [
            [
                'id' => 1,
                'guest_id' => 6,
                'hotel_location' => 'hilton-yaounde',
                'room_type' => 'Presidential Suite',
                'check_in' => '2024-01-15',
                'check_out' => '2024-01-18',
                'total_amount' => 750000,
                'status' => 'confirmed',
                'special_requests' => 'Late checkout requested'
            ],
            [
                'id' => 2,
                'guest_id' => 6,
                'hotel_location' => 'k-hotel-douala',
                'room_type' => 'Executive Suite',
                'check_in' => '2024-01-20',
                'check_out' => '2024-01-22',
                'total_amount' => 300000,
                'status' => 'pending',
                'special_requests' => 'Airport transfer needed'
            ]
        ];
    }

    public static function getRoomInventory() {
        return [
            [
                'hotel_location' => 'hilton-yaounde',
                'room_type' => 'Presidential Suite',
                'total_rooms' => 2,
                'available_rooms' => 1,
                'price_per_night' => 250000
            ],
            [
                'hotel_location' => 'hilton-yaounde',
                'room_type' => 'Executive Suite',
                'total_rooms' => 8,
                'available_rooms' => 5,
                'price_per_night' => 150000
            ],
            [
                'hotel_location' => 'hilton-yaounde',
                'room_type' => 'Deluxe Room',
                'total_rooms' => 20,
                'available_rooms' => 12,
                'price_per_night' => 85000
            ],
            [
                'hotel_location' => 'k-hotel-douala',
                'room_type' => 'Executive Suite',
                'total_rooms' => 10,
                'available_rooms' => 7,
                'price_per_night' => 150000
            ],
            [
                'hotel_location' => 'k-hotel-douala',
                'room_type' => 'Deluxe Room',
                'total_rooms' => 25,
                'available_rooms' => 18,
                'price_per_night' => 75000
            ],
            [
                'hotel_location' => 'mountain-hotel-buea',
                'room_type' => 'Mountain View Suite',
                'total_rooms' => 5,
                'available_rooms' => 3,
                'price_per_night' => 120000
            ],
            [
                'hotel_location' => 'mountain-hotel-buea',
                'room_type' => 'Deluxe Room',
                'total_rooms' => 15,
                'available_rooms' => 10,
                'price_per_night' => 65000
            ]
        ];
    }

    public static function getRecentActivities() {
        return [
            [
                'id' => 1,
                'type' => 'booking',
                'description' => 'New booking for Presidential Suite',
                'user' => 'John Doe',
                'timestamp' => '2024-01-10 14:30:00',
                'hotel_location' => 'hilton-yaounde'
            ],
            [
                'id' => 2,
                'type' => 'checkin',
                'description' => 'Guest checked in to Executive Suite',
                'user' => 'Marie Nsona',
                'timestamp' => '2024-01-10 15:45:00',
                'hotel_location' => 'hilton-yaounde'
            ],
            [
                'id' => 3,
                'type' => 'maintenance',
                'description' => 'Room 205 maintenance completed',
                'user' => 'Grace Fon',
                'timestamp' => '2024-01-10 16:20:00',
                'hotel_location' => 'k-hotel-douala'
            ],
            [
                'id' => 4,
                'type' => 'restaurant',
                'description' => 'Special dinner reservation for 8 guests',
                'user' => 'Paul Biya',
                'timestamp' => '2024-01-10 17:00:00',
                'hotel_location' => 'mountain-hotel-buea'
            ],
            [
                'id' => 5,
                'type' => 'spa',
                'description' => 'Spa package booking for wellness retreat',
                'user' => 'Aminata Kone',
                'timestamp' => '2024-01-10 17:30:00',
                'hotel_location' => 'hilton-yaounde'
            ]
        ];
    }
}

// Utility Functions
function formatCurrency($amount) {
    return number_format($amount, 0, ',', ' ') . ' FCFA';
}

function getHotelName($location) {
    $hotels = [
        'hilton-yaounde' => 'Hilton Yaoundé',
        'k-hotel-douala' => 'K Hotel Douala',
        'mountain-hotel-buea' => 'Mountain Hotel Buea'
    ];
    return $hotels[$location] ?? $location;
}

function getUserRole($role) {
    $roles = [
        'admin' => 'Administrator',
        'receptionist' => 'Receptionist',
        'housekeeping' => 'Housekeeping',
        'restaurant' => 'Restaurant Manager',
        'spa' => 'Spa Manager',
        'guest' => 'Guest'
    ];
    return $roles[$role] ?? $role;
}

function getStatusBadge($status) {
    $badges = [
        'active' => 'success',
        'inactive' => 'secondary',
        'confirmed' => 'success',
        'pending' => 'warning',
        'cancelled' => 'danger',
        'completed' => 'info'
    ];
    return $badges[$status] ?? 'secondary';
}
?>