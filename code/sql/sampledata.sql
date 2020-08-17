insert  into `hood`(`hid`, `hname`) values
(1, 'Metrotech'),
(2, 'Duffield');


insert into `block`(`bid`, `bname`, `longitudesw`, `latitudesw`, `longitudene`, `latitudene`, `hid`) values
(1, 'Metrotech 1', 1.0, 1.0, 2.0, 2.0, 1),
(2, 'Metrotech 2', 2.0, 2.0, 3.0, 3.0, 1),
(3, 'Duffield 1', 5.0, 5.0, 6.0, 6.0, 2),
(4, 'Duffield 2', 6.0, 6.0, 7.0, 7.0, 2);

insert  into `user`(`uid`,`name`,`password`,`email`, `address`, `profile`, `bid`, `hid`, `jointime`, `lastlogin`) values 
(1, 'A', '123', 'A@gmail.com', '101, Metrotech 1', 'I am A', 1, 1, '2018-02-04 10:45:00', '2019-12-04 10:45:00'),
(2, 'B', '123','B@gmail.com', '102, Metrotech 1', 'I am B', 1, 1, '2018-02-04 10:45:00', '2018-02-04 10:45:00'),
(3, 'C', '123','C@gmail.com', '101, Metrotech 2', 'I am C', 2, 1, '2018-02-04 10:45:00', '2018-02-04 10:45:00'),
(4, 'D', '123','D@gmail.com', '102, Metrotech 2', 'I am D', 2, 1, '2018-02-04 10:45:00', '2018-02-04 10:45:00'),
(5, 'E', '123','E@gmail.com', '101, Duffield 1', 'I am E', 3, 2, '2018-02-04 10:45:00', '2018-02-04 10:45:00'),
(6, 'F', '123','F@gmail.com', '101, Duffield 2', 'I am F', 4, 2, '2018-02-04 10:45:00', '2018-02-04 10:45:00');

insert into `thread`(`tid`, `uid`, `title`, `visibtype`, `longitude`, `latitude`, `posttime`) values
(1, 1, 'First user', 4, -78.987194, 40.693169, '2019-12-01 10:58:00'),
(2, 2, 'New to here', 4, -78.987194, 40.693169, '2019-12-02 10:58:00');

insert into `message`(`tid`, `no`, `uid`, `posttime`, `text`) values
(1, 0, 1, '2019-12-01 10:58:00', 'This application is interesting.'),
(1, 1, 2, '2019-12-01 10:59:00', 'Agree.'),
(1, 2, 3, '2019-12-01 10:59:30', 'I am exploring more.'),
(2, 0, 2, '2019-12-02 10:58:00', 'Hi.'),
(2, 1, 3, '2019-12-02 10:59:00', 'Nice to meet you.'),
(2, 2, 4, '2019-12-02 10:59:30', 'Interested.');

insert into msgbox(tid, no, uid, mtype, eid, etext, settime) values 
(0,0,1,1,6,"F wanted to join MetroTech", current_timestamp),
(0,0,1,3,6,"F wanted to be your friend", "2019-12-07 10:45:00"),
(1,2,1,5,3,"new message", "2019-12-01 10:46:00");

insert into setting(uid,emailntf,fntf,nntf,hntf,bntf) values
(1, true, true, true, true, true),
(2, true, true, true, true, true),
(3, true, true, true, true, true),
(4, true, true, true, true, true),
(5, true, true, true, true, true),
(6, true, true, true, true, true);

insert into friend(uid, fuid, settime) values
(1, 2, '2018-02-04 10:45:00'),
(1, 4, '2018-02-04 10:45:00');

insert into neighbor(uid, nuid, settime) values
(1, 2, '2018-02-04 10:45:00'),
(1, 3, '2018-02-04 10:45:00');

insert into hoodapp(uid, hid, confirm) values
(6,1,2),
(7,1,2);