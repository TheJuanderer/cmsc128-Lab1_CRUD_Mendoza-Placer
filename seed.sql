-- used in populating the database for testing


-- Categories
INSERT INTO `Category` (`category_name`)
VALUES
    ('School'),
    ('Personal'),
    ('Others');

-- Priorities
INSERT INTO `Priority` (`priority_name`)
VALUES
    ('Low'),
    ('Med'),
    ('High');

-- Users
INSERT INTO `User` (`user_id`, `user_name`, `user_email`, `password_hash`, `created_at`, `updated_at`, `deleted_at` )
VALUES
    (1, 'Brent', 'brent@example.com', '$2y$10$examplehash1', '2026-09-01 09:00:00', '2026-09-01 09:00:00', NULL),
    (2, 'Alice', 'alice@example.com', '$2y$10$examplehash2', '2026-09-02 10:00:00', '2026-09-02 10:00:00', NULL),
    (3, 'John', 'john@example.com', '$2y$10$examplehash3', '2026-09-03 11:00:00', '2026-09-03 11:00:00', NULL),
    (4, 'Deleted User', 'deleted@example.com', '$2y$10$examplehash4', '2026-09-04 12:00:00', '2026-09-20 12:00:00', '2026-09-20 12:00:00');

-- tasks
INSERT INTO `Task`
    (`title`, `user_id`, `due_date`, `priority_id`, `category_id`, `is_done`)
VALUES
    ('Finish database assignment', 1, '2026-09-08 23:59:00', 3, 1, 0),
    ('Review calculus notes', 1, '2026-09-09 18:00:00', 2, 1, 1),
    ('Submit programming project', 1, '2026-09-10 23:59:00', 3, 1, 0),
    ('Read assigned chapter', 1, '2026-09-12 20:00:00', 1, 1, 0),

    -- Alice
    ('Clean my room', 2, '2026-09-08 10:00:00', 2, 2, 1),
    ('Go grocery shopping', 2, '2026-09-09 16:00:00', 1, 2, 0),
    ('Exercise', 2, '2026-09-11 07:00:00', 1, 2, 0),
    ('Organize personal files', 2, '2026-09-13 14:00:00', 2, 2, 0),

    -- John
    ('Buy a new notebook', 3, '2026-09-08 12:00:00', 1, 3, 1),
    ('Call the repair shop', 3, '2026-09-10 15:00:00', 2, 3, 0),
    ('Plan weekend activities', 3, '2026-09-12 18:00:00', 1, 3, 0),
    ('Renew library membership', 3, '2026-09-15 17:00:00', 2, 3, 0);