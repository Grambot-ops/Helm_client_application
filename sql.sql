INSERT INTO `User` (`id`,`name`,`email`,`password`,`surname`,`username`,`active`)
VALUES
    (1,"Tarik","nisl.maecenas@hotmail.org","nec","Kirkland","pellentesque.","true"),
    (2,"Dora","fames.ac.turpis@aol.edu","sit","Kelley","sed","true"),
    (3,"Darrel","fusce.dolor@hotmail.net","id,","Zimmerman","nisi","true"),
    (4,"Paul","a.mi.fringilla@icloud.edu","fames","O'connor","blandit","false"),
    (5,"Rhea","non@aol.edu","nisi.","Calderon","enim,","false"),
    (6,"Velma","rhoncus.nullam@hotmail.edu","accumsan","Mann","vitae,","false"),
    (7,"Daria","nisl.quisque@google.com","vel","Mcknight","eu,","true"),
    (8,"Quinn","arcu.vivamus@yahoo.org","sodales","Allen","felis","true"),
    (9,"Jael","sapien.aenean@aol.couk","velit.","Conley","luctus","false"),
    (10,"Caesar","nibh.quisque@aol.net","dapibus","Jones","tristique","true");

INSERT INTO `Role` (`id`,`name`)
VALUES
    (1, "Admin"),
    (2, "User");

INSERT INTO `UserRole` (`role_id`,`user_id`)
VALUES
    (1, 1),
    (2, 1),
    (1, 3),
    (2, 3),
    (2, 2),
    (2, 4);

INSERT INTO `DeliveryType` (`id`,`name`)
VALUES
    (1, "email"),
    (2, "phone");

INSERT INTO `Announcement` (`id`, `user_id`,`message`)
VALUES
    (1, 4, "You have been kicked"),
    (2, 5, "You have won the competition");

INSERT INTO `Notification` (`id`,`description`,`IntervalDefault`) /*Is it IntervalDefault or IntervalDefaut?*/
VALUES
    (1,"aliquet diam. Sed",1),
    (2,"Cras dictum ultricies ligula.",3),
    (3,"enim mi tempor lorem, eget mollis",10),
    (4,"Etiam",3),
    (5,"et ipsum cursus vestibulum. Mauris magna. Duis",7),
    (6,"In mi pede, nonummy",3),
    (7,"Praesent interdum ligula eu enim.",5),
    (8,"non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra",2),
    (9,"libero nec ligula consectetuer rhoncus. Nullam velit dui,",7),
    (10,"dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus",1);

INSERT INTO `CompetitionCategory` (`id`,`name`)
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

INSERT INTO `CompetitionType` (`id`,`name`)
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

INSERT INTO `Competition` (`id`,`competitionCategory_id`,`competitionType_id`,`title`,`byVote`,`pathToPhoto`,`rules`,`prize`,`description`,`startDate`,`endDate`,`submissionDate`,`accepted`)
VALUES
    (1,10,8,"risus.","false","http://guardian.co.uk/en-us","lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent","arcu. Vivamus sit amet risus. Donec","aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis","May 4, 2023","Mar 22, 2024","Oct 11, 2023","true"),
    (2,6,4,"Nullam lobortis","false","http://naver.com/user/110","pellentesque eget, dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos","aliquam adipiscing lacus. Ut nec urna et arcu imperdiet","dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere vulputate, lacus. Cras interdum. Nunc sollicitudin commodo ipsum. Suspendisse","Oct 8, 2023","Feb 14, 2025","Nov 13, 2023","false"),
    (3,2,9,"non, luctus","false","https://netflix.com/sub","vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat velit.","quam quis diam. Pellentesque","ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer vitae nibh. Donec","Mar 4, 2023","Dec 5, 2024","Jun 10, 2024","true"),
    (4,4,10,"at, velit.","true","http://naver.com/settings","iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget","Duis gravida. Praesent eu nulla","lorem, sit amet ultricies sem magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo auctor velit. Aliquam nisl. Nulla eu neque pellentesque","Oct 30, 2023","Jul 18, 2024","Mar 23, 2024","true"),
    (5,5,4,"Aliquam rutrum lorem ac risus.","true","https://netflix.com/one","ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor","habitant morbi tristique senectus et netus et","purus mauris a nunc. In at pede. Cras vulputate velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta","Aug 21, 2023","Sep 16, 2024","Mar 14, 2023","false"),
    (6,2,6,"accumsan neque","false","https://walmart.com/fr","ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit.","rutrum magna. Cras convallis convallis","malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eget","Apr 25, 2023","Jun 27, 2024","Mar 30, 2023","true"),
    (7,2,4,"facilisis, magna tellus","false","http://guardian.co.uk/sub/cars","Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque","fringilla purus mauris","viverra. Donec tempus, lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit amet ultricies sem magna nec quam. Curabitur vel lectus. Cum sociis","Jun 20, 2023","Aug 24, 2024","Apr 29, 2024","true"),
    (8,1,8,"viverra.","false","http://walmart.com/one","eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam","eget, dictum placerat, augue. Sed molestie. Sed id risus","dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc","May 24, 2023","May 10, 2024","Mar 25, 2024","false"),
    (9,6,9,"eu augue","true","http://netflix.com/sub","iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus","mi lacinia","ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut","Oct 31, 2023","Feb 2, 2025","Sep 27, 2023","true"),
    (10,3,5,"quis accumsan convallis,","false","http://netflix.com/one","neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis","neque. Nullam nisl. Maecenas malesuada fringilla est.","Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris.","May 31, 2023","Nov 23, 2024","Aug 26, 2023","false");

INSERT INTO `NotiComp` (`notification_id`,`competition_id`,`intervalException`)
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

INSERT INTO `Changelog` (`id`,`user_id`,`competition_id`,`dateChange`)
VALUES
    (1,9,5,"Aug 5, 2023"),
    (2,9,3,"May 15, 2023"),
    (3,3,9,"Jun 18, 2024"),
    (4,2,10,"Apr 28, 2024"),
    (5,7,5,"Oct 20, 2023"),
    (6,7,6,"Apr 18, 2023"),
    (7,2,9,"Jul 25, 2023"),
    (8,8,3,"Jan 26, 2025"),
    (9,2,4,"Nov 14, 2024"),
    (10,3,5,"Jan 31, 2024");

INSERT INTO `myTable` (`competition_id`,`user_id`,`ranking`,`disqualified`)
VALUES
    (6,5,1,"true"),
    (8,3,0,"false"),
    (7,3,3,"true"),
    (5,1,4,"true"),
    (9,9,3,"false"),
    (4,3,0,"false"),
    (3,7,1,"true"),
    (4,8,3,"true"),
    (9,2,1,"false"),
    (8,4,5,"true");

INSERT INTO `Submission` (`id`,`deliveryType_id`,`participation_id`,`path`,`link`,`description`)
VALUES
    (1,7,9,"http://facebook.com/one","https://zoom.us/sub/cars","Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed"),
    (2,7,9,"https://whatsapp.com/one","http://facebook.com/en-us","Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo"),
    (3,4,10,"http://walmart.com/fr","http://youtube.com/en-ca","Proin mi. Aliquam gravida mauris ut mi. Duis risus odio,"),
    (4,1,2,"https://twitter.com/en-ca","http://guardian.co.uk/en-us","rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar"),
    (5,1,4,"http://pinterest.com/sub","https://pinterest.com/en-us","vulputate, nisi sem semper erat, in consectetuer ipsum nunc id"),
    (6,4,9,"http://pinterest.com/sub/cars","http://cnn.com/group/9","magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur"),
    (7,6,6,"https://walmart.com/fr","https://pinterest.com/sub/cars","Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat,"),
    (8,4,2,"https://youtube.com/sub/cars","http://whatsapp.com/settings","Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet"),
    (9,4,2,"https://wikipedia.org/settings","https://netflix.com/settings","venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at,"),
    (10,4,6,"https://baidu.com/sub","http://cnn.com/group/9","nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio.");

INSERT INTO `Like` (`user_id`,`competition_id`)
VALUES
    (7,6),
    (7,6),
    (2,7),
    (4,7),
    (6,8),
    (1,5),
    (6,6),
    (6,6),
    (6,7),
    (9,6);
