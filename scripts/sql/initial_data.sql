START TRANSACTION;

INSERT INTO social_news.users (idUsers, username, password, name, lastName, birth, email, permitionLevel) VALUES (2, 'ddetoni', '601f1889667efaebb33b8c12572835da3f027f78', 'Douglas', 'Detoni', NOW(), 'ddetoni@gmail.com', 3);

INSERT INTO social_news.news (idNews, Users_idUsers, title, text, tags, date, url) VALUES (2, 2, 'Mais uma noticia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae ex vel arcu placerat elementum. Maecenas pharetra finibus magna, a fermentum nulla pharetra sit amet. Donec iaculis quam augue, id sodales enim vehicula nec. Etiam pellentesque blandit ultrices. Integer pellentesque ultricies felis, a dictum orci eleifend sit amet. Pellentesque ornare nisi ac augue varius commodo id nec lectus. Cras porta erat in lectus ornare egestas. Donec eu egestas libero. Aliquam hendrerit justo laoreet elit placerat dictum. Donec ac consectetur est. Morbi gravida a quam ac bibendum. Donec eu diam ex. Praesent vehicula eros in dui sollicitudin, eu facilisis sapien blandit. Aliquam varius ligula sit amet diam cursus, nec ornare erat condimentum. Proin sit amet eros pulvinar, aliquet est ac, commodo eros. Fusce hendrerit odio in hendrerit fermentum. Etiam non lacinia lorem. Vestibulum sollicitudin tortor ex, eu sagittis sapien hendrerit eget. Sed et purus efficitur ex gravida efficitur ac sit amet dolor. Donec eu dolor vel lacus tristique interdum. Suspendisse eu purus ac diam dictum lacinia. Morbi pharetra ex lobortis, pulvinar ex eu, viverra lorem.', 'teste teste', NOW(), 'news.php?idNew=2');

INSERT INTO social_news.comments (Users_idUsers, News_idNews, comment) VALUES (2, 2, 'Comentario 1');
INSERT INTO social_news.comments (Users_idUsers, News_idNews, comment) VALUES (2, 2, 'Comentario 2');
INSERT INTO social_news.comments (Users_idUsers, News_idNews, comment) VALUES (2, 2, 'Comentario 3');

COMMIT;