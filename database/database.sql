DROP DATABASE IF EXISTS `bptp_library_guest_book`;
CREATE DATABASE `bptp_library_guest_book`;

CREATE TABLE `bptp_library_guest_book`.`topics` (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE `bptp_library_guest_book`.`guests` (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    topic_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    visit_datetime DATETIME NOT NULL,
    visit_reason TEXT NULL,
    profession VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (topic_id) REFERENCES topics (id)
);

CREATE TABLE `bptp_library_guest_book`.`guest_students` (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    guest_id BIGINT UNSIGNED NOT NULL,
    university VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (guest_id) REFERENCES guests (id)
);

CREATE TABLE `bptp_library_guest_book`.`guest_employees` (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    guest_id BIGINT UNSIGNED NOT NULL,
    division VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (guest_id) REFERENCES guests (id)
);

CREATE TABLE `bptp_library_guest_book`.`backup_guests` (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    backup_datetime DATETIME NOT NULL,
    PRIMARY KEY (id)
);

-- Dummies Data
INSERT INTO `bptp_library_guest_book`.`topics` (
    `id`,
    `name`
) VALUES 
(1, 'Umum'),
(2, 'Filsafat'),
(3, 'Ilmu Pengetahuan Masyarakat'),
(4, 'Bahasa'),
(5, 'Matematika'),
(6, 'Ilmu Pengetahuan Terapan'),
(7, 'Kesenian'),
(8, 'Literatur'),
(9, 'Sejarah');

INSERT INTO `bptp_library_guest_book`.`guests` (
    topic_id,
    name,
    visit_datetime,
    visit_reason,
    profession
) VALUES 
(1, 'Nurcholis', NOW(), 'Belajar', 'Umum'),
(2, 'A', NOW(), 'Belajar', 'Umum'),
(3, 'B', NOW(), 'Belajar', 'Umum'),
(4, 'C', NOW(), 'Belajar', 'Umum'),
(5, 'D', NOW(), 'Belajar', 'Umum'),
(6, 'E', NOW(), 'Belajar', 'Umum'),
(7, 'F', NOW(), 'Belajar', 'Umum'),
(8, 'G', NOW(), 'Belajar', 'Umum'),
(9, 'H', NOW(), 'Belajar', 'Umum'),
(1, 'I', NOW(), 'Belajar', 'Umum'),
(2, 'J', NOW(), 'Belajar', 'Umum');