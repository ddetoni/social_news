START TRANSACTION;

INSERT INTO social_news.users (idUsers, username, password, name, lastName, birth, email, permitionLevel) VALUES (2, 'ddetoni', '7c222fb2927d828af22f592134e8932480637c0d', 'Douglas', 'Detoni', NOW(), 'ddetoni@gmail.com', 1);

INSERT INTO social_news.users (idUsers, username, password, name, lastName, birth, email, permitionLevel) VALUES (3, 'editor', '7c222fb2927d828af22f592134e8932480637c0d', 'Editor', 'Master', NOW(), 'editor@gmail.com', 2);

INSERT INTO social_news.users (idUsers, username, password, name, lastName, birth, email, permitionLevel) VALUES (4, 'admin', '7c222fb2927d828af22f592134e8932480637c0d', 'Admin', 'Master', NOW(), 'admin@gmail.com', 3);

INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (6, 3, 'City council backs late-night bus expansion', 'After a three-month pilot, the city will expand overnight bus service to cover the airport, downtown, and campus corridors. Transit officials say the change should cut late-night wait times and improve safety.', 'local transit', NOW(), 'news.php?idNew=6');
INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (7, 3, 'Community clinic opens same-day mental health visits', 'A new walk-in program will offer same-day counseling sessions five days a week. Organizers say the goal is to reduce wait times for initial care.', 'health community', NOW(), 'news.php?idNew=7');
INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (8, 3, 'University team wins regional robotics challenge', 'Engineering students built an autonomous rover that mapped a mock disaster zone in under ten minutes. The team plans to open source the design for local schools.', 'education robotics', NOW(), 'news.php?idNew=8');
INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (9, 3, 'Library launches device lending to bridge digital gap', 'Residents can now borrow Wi-Fi hotspots and tablets for two weeks. The library says the program will expand if demand continues to rise.', 'technology community', NOW(), 'news.php?idNew=9');
INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (10, 3, 'Farmers market moves indoors for winter season', 'The downtown market will operate year-round in a renovated warehouse with indoor stalls and events. Vendors expect more stable winter revenue.', 'local food', NOW(), 'news.php?idNew=10');
INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (11, 3, 'New bike corridor connects east and west routes', 'A five-mile protected bike lane opened today, linking two greenways and improving crossings at major intersections.', 'transportation cycling', NOW(), 'news.php?idNew=11');
INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (12, 3, 'Utility pilots peak-hour rebate program', 'Households can earn bill credits by reducing energy use during peak hours. The pilot runs through the summer and may expand later this year.', 'energy utilities', NOW(), 'news.php?idNew=12');
INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (13, 3, 'Arts festival brings murals to five neighborhoods', 'More than 30 artists are painting large-scale murals across the city with free weekend walking tours.', 'arts culture', NOW(), 'news.php?idNew=13');


INSERT INTO social_news.comments (Users_idUsers, News_idNews, comment) VALUES (2, 6, 'Comment 1');
INSERT INTO social_news.comments (Users_idUsers, News_idNews, comment) VALUES (2, 6, 'Comment 2');
INSERT INTO social_news.comments (Users_idUsers, News_idNews, comment) VALUES (2, 6, 'Comment 3');

COMMIT;
