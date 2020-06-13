<?php

declare(strict_types=1);

return [
    [
        'select * from users where email = ? or first_name = ? or last_name = ?',
        ['test@example.com', 'TestFirst', 'TestLast'],
        'select * from users where email = "test@example.com" or first_name = "TestFirst" or last_name = "TestLast"',
    ],
    [
        'select * from companies where title like ?',
        ['test%'],
        'select * from companies where title like "test%"',
    ],
    [
        'select * from statistic where user_id = ? and created_at between ? and ?',
        [1, '2017-01-01 00:00:00', '2017-02-01 00:00:00'],
        'select * from statistic where user_id = 1 and created_at between "2017-01-01 00:00:00" and "2017-02-01 00:00:00"',
    ],
];
