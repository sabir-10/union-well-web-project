CREATE DATABASE IF NOT EXISTS union_well_portfolio;
USE union_well_portfolio;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(150) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) NOT NULL,
    instructor VARCHAR(100) NOT NULL,
    class_day VARCHAR(20) NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    location VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    subject VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (username, password_hash) VALUES
('admin', '$2y$10$gVV8SX5M4KjRWwQvJrHSBun0KQe1x4TqfYf9T9N54nK5x6kXMtQ5a');

INSERT INTO announcements (title, body) VALUES
('Spring Facility Updates', 'New wellness classes, improved facility access, and expanded event support are now available across the center.'),
('Student Leadership Week', 'Join workshops, networking sessions, and campus activities designed to support student success and engagement.'),
('Reservation System Demo', 'This demo portfolio project can be extended with room reservations and a members portal.');

INSERT INTO events (title, description, location, event_date, event_time) VALUES
('Campus Wellness Workshop', 'A guided workshop focused on balancing academic success with healthy wellness habits and stress management.', 'Wellness Studio A', '2026-05-12', '14:00:00'),
('Union Game Night', 'Students are invited to an evening of board games, social connection, and free refreshments in the student lounge.', 'Union Lounge', '2026-05-15', '18:30:00'),
('Leadership Mixer', 'Meet student leaders, campus organizations, and professional staff during this networking and information session.', 'Conference Room 2', '2026-05-20', '16:00:00');

INSERT INTO classes (class_name, instructor, class_day, start_time, end_time, location, category) VALUES
('Morning Yoga', 'Jamie Lee', 'Monday', '08:00:00', '09:00:00', 'Studio 1', 'Mindfulness'),
('HIIT Express', 'Chris Patel', 'Tuesday', '12:00:00', '12:45:00', 'Studio 2', 'Fitness'),
('Basketball Skills', 'Alex Moore', 'Wednesday', '17:00:00', '18:00:00', 'Main Court', 'Sports'),
('Stretch & Recover', 'Taylor Kim', 'Thursday', '15:00:00', '15:45:00', 'Recovery Room', 'Mindfulness');
