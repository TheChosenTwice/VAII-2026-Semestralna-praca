INSERT INTO `topics` (`title`, `user_id`, `category_id`) VALUES
    (
        'How do you organize your daily tasks?',
        (SELECT `id` FROM `users` WHERE `login` = 'alex_morgan'),
        (SELECT `id` FROM `categories` WHERE `name` = 'General')
    ),
    (
        'Best productivity habits that actually work',
        (SELECT `id` FROM `users` WHERE `login` = 'alex_morgan'),
        (SELECT `id` FROM `categories` WHERE `name` = 'Education')
    ),
    (
        'What technology are you most excited about?',
        (SELECT `id` FROM `users` WHERE `login` = 'jamie_lee'),
        (SELECT `id` FROM `categories` WHERE `name` = 'Technology')
    ),
    (
        'Share your favorite programming resources',
        (SELECT `id` FROM `users` WHERE `login` = 'jamie_lee'),
        (SELECT `id` FROM `categories` WHERE `name` = 'Programming')
    ),
    (
        'Which game should everyone try?',
        (SELECT `id` FROM `users` WHERE `login` = 'taylor_reed'),
        (SELECT `id` FROM `categories` WHERE `name` = 'Gaming')
    );