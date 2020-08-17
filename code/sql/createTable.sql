drop table if exists `hood`;
create table `hood` (
    `hid` int(11) not null,
    `hname` varchar(45) not null,
    primary key (`hid`)
);

drop table if exists `block`;
create table `block` (
    `bid` int(11) not null,
    `bname` varchar(45),
    `longitudesw` double,
    `latitudesw` double,
    `longitudene` double,
    `latitudene` double,
    `hid` int(11),
    primary key (`bid`),
    foreign key (`hid`) references `hood`(`hid`)
);

drop table if exists `user`;
create table `user` (
    `uid` int(11) not null,
    `password` varchar(45),
    `jointime` timestamp not null default current_timestamp on update current_timestamp,
    `name` varchar(45),
    `email` varchar(45) not null,
    `address` varchar(45),
    `bid` int(11),
    `hid` int(11),
    `profile` varchar(45),
    `lastlogin` timestamp,
    primary key (`uid`),
    foreign key (`bid`) references `block`(`bid`),
    foreign key (`hid`) references `hood`(`hid`) 
);

drop table if exists `friend`;
create table `friend` (
    `uid` int(11),
    `fuid` int(11),
    `settime` timestamp,
    primary key (`uid`, `fuid`),
    foreign key (`uid`) references `user`(`uid`),
    foreign key (`fuid`) references `user`(`uid`)
);

drop table if exists `neighbor`;
create table `neighbor` (
    `uid` int(11),
    `nuid` int(11),
    `settime` timestamp,
    primary key (`uid`, `nuid`),
    foreign key (`uid`) references `user`(`uid`),
    foreign key (`nuid`) references `user`(`uid`)
);

drop table if exists `hoodapp`;
create table `hoodapp` (
    `uid` int(11),
    `hid` int(11),
    `confirm` int(11),
    primary key (`uid`, `hid`),
    foreign key (`uid`) references `user`(`uid`),
    foreign key (`hid`) references `hood`(`hid`)
);


drop table if exists `thread`;
create table `thread` (
    `tid` int(11),
    `uid` int(11),
    `hid` int(11),
    `bid` int(11),
    `title` varchar(45),
    `visibtype` int(11),
    `longitude` double,
    `latitude` double,
    `posttime` timestamp,
    primary key (`tid`),
    foreign key (`hid`) references `hood` (`hid`),
    foreign key (`bid`) references `block` (`bid`),
    foreign key (`uid`) references `user` (`uid`)
);

drop table if exists `message`;
create table `message` (
    `tid` int(11),
    `hid` int(11),
    `bid` int(11),
    `no` int(11),
    `uid` int(11),
    `text` varchar(45),
    `posttime` timestamp,
    primary key (`tid`, `no`),
    foreign key (`hid`) references `hood` (`hid`),
    foreign key (`bid`) references `block` (`bid`),
    foreign key (`tid`) references `thread`(`tid`),
    foreign key (`uid`) references `user`(`uid`)
);

drop table if exists `setting`;
create table `setting` (
    `uid` int(11),
    `emailntf` boolean,
    `fntf` boolean,
    `nntf` boolean,
    `bntf` boolean,
    `hntf` boolean,
    primary key (`uid`),
    foreign key (`uid`) references `user` (`uid`)
);

drop table if exists `msgbox`;
create table `msgbox` (
    `uid` int(11),
    `tid` int(11),
    `mtype` int(11),
    `etext` varchar(45),
    `eid` int(11),
    `no` int(11),
    `settime` timestamp,
    primary key (`uid`,`eid`,`settime`)
);
