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

-- tasks
INSERT INTO `Task`
    (`title`, `due_date`, `priority_id`, `category_id`)
VALUES
    ('Finish database assignment', '2026-09-08 23:59:00', 3, 1),
    ('Review calculus notes', '2026-09-09 18:00:00', 2, 1),
    ('Submit programming project', '2026-09-10 23:59:00', 3, 1),
    ('Read assigned chapter', '2026-09-12 20:00:00', 1, 1),

    ('Clean my room', '2026-09-08 10:00:00', 2, 2),
    ('Go grocery shopping', '2026-09-09 16:00:00', 1, 2),
    ('Exercise', '2026-09-11 07:00:00', 1, 2),
    ('Organize personal files', '2026-09-13 14:00:00', 2, 2),

    ('Buy a new notebook', '2026-09-08 12:00:00', 1, 3),
    ('Call the repair shop', '2026-09-10 15:00:00', 2, 3),
    ('Plan weekend activities', '2026-09-12 18:00:00', 1, 3),
    ('Renew library membership', '2026-09-15 17:00:00', 2, 3);