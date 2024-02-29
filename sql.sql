INSERT INTO `users` (`id`,`name`,`email`,`password`,`surname`,`username`,`active`)
VALUES
    (1,"Tarik","nisl.maecenas@hotmail.org","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","Kirkland","pellentesque.",true),
    (2,"Dora","fames.ac.turpis@aol.edu","$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e","Kelley","sed",true),
    (3,"Darrel","fusce.dolor@hotmail.net","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","Zimmerman","nisi",true),
    (4,"Paul","a.mi.fringilla@icloud.edu","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","O'connor","blandit",false),
    (5,"Rhea","non@aol.edu","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","Calderon","enim,",false),
    (6,"Velma","rhoncus.nullam@hotmail.edu","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","Mann","vitae,",false),
    (7,"Daria","nisl.quisque@google.com","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","Mcknight","eu,",true),
    (8,"Quinn","arcu.vivamus@yahoo.org","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","Allen","felis",true),
    (9,"Jael","sapien.aenean@aol.couk","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","Conley","luctus",false),
    (10,"Caesar","nibh.quisque@aol.net","$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K","Jones","tristique",true);

INSERT INTO `roles` (`id`,`name`)
VALUES
    (1, "Admin"),
    (2, "User");

INSERT INTO `delivery_types` (`id`,`name`)
VALUES
    (1, "email"),
    (2, "phone"),
    (3, "photo"),
    (4, "link");

INSERT INTO `user_roles` (`role_id`,`user_id`)
VALUES
    (1, 1),
    (2, 1),
    (1, 3),
    (2, 3),
    (2, 2),
    (2, 4);

INSERT INTO `announcements` (`id`, `user_id`,`message`)
VALUES
    (1, 4, "You have been kicked"),
    (2, 5, "You have won the competition");

INSERT INTO `notifications` (`id`,`title`,`description`,`interval_default`) /*Is it IntervalDefault or IntervalDefaut?*/
VALUES
    (1,"Begin Competition","Get ready to unleash your talents, ignite your passions and embark on a thrilling journey of competition! We are thrilled to announce the commencement of our much-anticipated competition!!!",1),
    (2,"Deadline Warning","We hope this message finds you well and we are filled with excitement to see all of your submissions. As the competition heats up, we're reaching out with an important deadline reminder.",3),
    (3,"End competition","With great excitement and a sense of accomplishment, we are thrilled to announce the conclusion of our competition! This marks the end of an incredible journey filled with creativity, innovation and passion from talented individuals like you.",10);

INSERT INTO `competition_categories` (`id`,`name`)
VALUES
    (1,"lectus"),
    (2,"fermentum"),
    (3,"nulla"),
    (4,"Etiam"),
    (5,"ligula"),
    (6,"dapibus"),
    (7,"et"),
    (8,"purus"),
    (9,"Donec"),
    (10,"lectus");

INSERT INTO `competition_types` (`id`,`name`)
VALUES
    (1,"Mauris"),
    (2,"ac"),
    (3,"nibh"),
    (4,"dui,"),
    (5,"justo."),
    (6,"porttitor"),
    (7,"euismod"),
    (8,"sagittis"),
    (9,"dolor."),
    (10,"Pellentesque");

INSERT INTO `competitions` (`id`,`competition_category_id`,`competition_type_id`,`user_id`,`title`,`by_vote`,`path_to_photo`,`rules`,`prize`,`description`,`start_date`,`end_date`,`submission_date`,`accepted`)
VALUES
  (1,5,9,4,"lacus. Mauris non",true,"https://reddit.com/sub/cars","nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis","nibh dolor,","nec metus facilisis lorem tristique aliquet. Phasellus fermentum","2023-11-3","2024-6-1","2023-9-1",false),
  (2,5,2,6,"semper egestas, urna",true,"https://yahoo.com/sub/cars","dolor. Fusce feugiat. Lorem ipsum dolor sit amet, consectetuer adipiscing","tincidunt dui","interdum","2023-4-18","2024-5-29","2024-9-11",true),
  (3,7,7,9,"sem, consequat nec,",false,"https://nytimes.com/settings","in faucibus orci luctus et ultrices posuere cubilia Curae Phasellus","tincidunt. Donec","ullamcorper. Duis cursus, diam at pretium","2023-4-23","2024-4-29","2023-11-14",true),
  (4,9,4,8,"Nullam velit dui,",true,"https://naver.com/sub/cars","consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia","rhoncus. Donec","a, facilisis non, bibendum sed, est.","2023-7-7","2024-6-15","2023-7-15",false),
  (5,4,4,5,"Nunc pulvinar arcu",false,"https://cnn.com/fr","eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in","rutrum, justo.","turpis vitae purus gravida sagittis. Duis gravida. Praesent eu","2023-6-20","2024-12-13","2023-7-13",false),
  (6,3,6,6,"et magnis dis",true,"https://pinterest.com/sub","elit sed consequat auctor, nunc nulla vulputate dui, nec tempus","arcu ac","quam.","2023-8-16","2024-11-30","2024-8-21",true),
  (7,4,2,4,"Vivamus nibh dolor,",false,"https://youtube.com/group/9","ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat","sodales elit","cursus vestibulum. Mauris magna.","2023-10-15","2024-10-20","2023-5-19",false),
  (8,10,8,4,"Fusce aliquet magna",false,"http://reddit.com/settings","orci. Ut semper pretium neque. Morbi quis urna. Nunc quis","tortor. Integer","elit. Etiam","2023-12-26","2024-3-27","2024-7-28",false),
  (9,9,3,6,"odio. Phasellus at",true,"http://facebook.com/sub/cars","sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus","nostra, per","porttitor interdum. Sed auctor odio a","2023-5-21","2024-12-19","2024-9-20",true),
  (10,5,3,7,"turpis egestas. Fusce",false,"https://netflix.com/group/9","ac nulla. In tincidunt congue turpis. In condimentum. Donec at","blandit enim","egestas a, scelerisque sed,","2023-5-5","2024-6-25","2024-12-20",true);

INSERT INTO `noti_comps` (`notification_id`,`competition_id`,`interval_exception`)
VALUES
    (7,8,6),
    (6,1,7),
    (2,5,1),
    (3,5,4),
    (5,9,5),
    (2,9,8),
    (6,6,6),
    (5,3,3),
    (6,8,8),
    (7,1,7);

INSERT INTO changelogs (id,user_id,competition_id,date_change)
VALUES
  (1,7,9,"2023-8-19"),
  (2,2,6,"2023-10-16"),
  (3,6,7,"2024-12-15"),
  (4,4,6,"2023-12-9"),
  (5,3,6,"2024-9-6"),
  (6,2,3,"2024-4-13"),
  (7,7,3,"2023-12-27"),
  (8,5,4,"2024-8-12"),
  (9,8,4,"2023-11-15"),
  (10,1,8,"2024-7-29");


INSERT INTO `participations` (`competition_id`,`user_id`,`ranking`,`disqualified`)
VALUES
	(6,5,1,true),
    (8,3,0,false),
    (7,3,3,true),
    (5,1,4,true),
    (9,9,3,false),
    (4,3,0,false),
    (3,7,1,true),
    (4,8,3,true),
    (9,2,1,false),
    (8,4,5,true);


INSERT INTO `submissions` (`id`,`delivery_type_id`,`participation_id`,`path`,`link`,`description`)
VALUES
    (1,1,9,"http://facebook.com/one","https://zoom.us/sub/cars","Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed"),
    (2,1,9,"https://whatsapp.com/one","http://facebook.com/en-us","Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo"),
    (3,1,10,"http://walmart.com/fr","http://youtube.com/en-ca","Proin mi. Aliquam gravida mauris ut mi. Duis risus odio,"),
    (4,2,2,"https://twitter.com/en-ca","http://guardian.co.uk/en-us","rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar"),
    (5,2,4,"http://pinterest.com/sub","https://pinterest.com/en-us","vulputate, nisi sem semper erat, in consectetuer ipsum nunc id"),
    (6,1,9,"http://pinterest.com/sub/cars","http://cnn.com/group/9","magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur"),
    (7,1,6,"https://walmart.com/fr","https://pinterest.com/sub/cars","Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat,"),
    (8,3,2,"https://youtube.com/sub/cars","http://whatsapp.com/settings","Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet"),
    (9,3,2,"https://wikipedia.org/settings","https://netflix.com/settings","venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at,"),
    (10,1,6,"https://baidu.com/sub","http://cnn.com/group/9","nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio.");

INSERT INTO `likes` (`user_id`,`competition_id`)
VALUES
    (7,5),
    (7,6),
    (2,7),
    (4,7),
    (6,8),
    (1,5),
    (6,1),
    (6,6),
    (6,7),
    (9,6);
