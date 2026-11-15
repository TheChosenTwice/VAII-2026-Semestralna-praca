CREATE TABLE `users`
(
    `id`              INT AUTO_INCREMENT PRIMARY KEY,
    `login`           VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL UNIQUE,
    `password`        VARCHAR(255) NOT NULL,
    `role`            VARCHAR(20)  NOT NULL DEFAULT 'user',
    `profile_picture` VARCHAR(255) DEFAULT 'default_pfp.png'
) DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;