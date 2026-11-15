CREATE TABLE `topics`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `title`       VARCHAR(255) NOT NULL,
    `user_id`     INT DEFAULT NULL,
    `category_id` INT DEFAULT NULL,
    `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ON DELETE SET NULL,

    FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
        ON DELETE SET NULL
) DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;