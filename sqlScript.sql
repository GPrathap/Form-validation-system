
create database Group;


use Group;

/*Creating tables*/

/*Lecturer data*/
create table LECTURER(
Fname varchar(20),
Lname varchar(20),
Email varchar(30) Not NULL,
Department varchar(20) not NULL,
Primary key(Fname,Lname)
);

/*Note- Not every student can register to database 
		Registering student should be a representative 
		of a student group. Only they can request for 
		resources.
*/

/*Student data*/
create table STUDENT(
RegNo char(6),
Email varchar(30) Not NULL,
Association varchar(30) Not NULL,
Telephone int,
Primary key(RegNo)
);

/*Dean is also a lecturer. But we need a spearate relation*/
create table DEAN(
Fname varchar(20),
Lname varchar(20),
Email varchar(30) Not NULL,
Department varchar(20) not NULL,
Primary key(Fname,Lname),
foreign key(Fname,Lname) references LECTURER(Fname,Lname) on update cascade on delete restrict
);

/*Availability is marked to indicate current availability*/

/*Seminar room data*/
create table SEMINAR_ROOM(
SemRoomNo varchar(10),
Capacity int Not Null,
Availability bool,
Reserve_on date,
Time varchar(10),
Duration varchar(10),
Primary Key(SemRoomNo,Time,Reserve_on)
);

/*Lecture halls*/
create table LECTURE_HALL(
HallNo int,
Capacity int Not Null,
Projectors bool,
Availability bool,
Reserve_on date,
Time varchar(10),
Duration varchar(10),
Primary Key(HallNo,Time,Reserve_on)
);

/*Vehicle data*/
create table VEHICLE(
VehiRegNo varchar(10),
Capacity int not null,
Type varchar(5),
Availability bool,
Reserve_on date,
Time varchar(10),
Primary Key(VehiRegNo,Time,Reserve_on)
);

/*Special tables*/

/*Tables for lecturer reservations*/

/*Lecturer reserving seminar room*/
create table lect_seminar(
Fname varchar(20),
Lname varchar(20),
Email varchar(30) Not NULL,
SemRoomNo varchar(10),
reserve_on datetime,
approved bool,
primary key(Fname,Lname,reserve_on),
foreign key(Fname,Lname) references LECTURER(Fname,Lname) on update cascade on delete cascade,
foreign key(SemRoomNo) references SEMINAR_ROOM(SemRoomNo) on update cascade on delete restrict
);

/*Lecturer reserving lecture hall*/
create table lect_hall(
Fname varchar(20),
Lname varchar(20),
Email varchar(30) Not NULL,
HallNo int,
reserve_on datetime,
approved bool,
primary key(Fname,Lname,reserve_on),
foreign key(Fname,Lname) references LECTURER(Fname,Lname) on update cascade on delete cascade,
foreign key(HallNo) references LECTURE_HALL(HallNo) on update cascade on delete restrict
);

/*Lecturer reserving vehicle*/
create table lect_vehicle(
Fname varchar(20),
Lname varchar(20),
Email varchar(30) Not NULL,
VehiRegNo varchar(10),
reserve_on datetime,
approved bool,
primary key(Fname,Lname,reserve_on),
foreign key(Fname,Lname) references LECTURER(Fname,Lname) on update cascade on delete cascade,
foreign key(VehiRegNo) references VEHICLE(VehiRegNo) on update cascade on delete restrict
);

/*Tables for student reservations*/

/*Student requesting seminar room*/
create table stud_seminar(
RegNo char(6),
Email varchar(30) Not NULL,
SemRoomNo varchar(10),
reserve_on datetime,
approved bool,
primary key(RegNo,reserve_on),
foreign key(RegNo) references STUDENT(RegNo) on update cascade on delete cascade,
foreign key(SemRoomNo) references SEMINAR_ROOM(SemRoomNo) on update cascade on delete restrict
);

/*Student requesting lecture hall*/
create table stud_hall(
RegNo char(6),
Email varchar(30) Not NULL,
HallNo int,
reserve_on datetime,
approved bool,
primary key(RegNo,reserve_on),
foreign key(RegNo) references STUDENT(RegNo) on update cascade on delete cascade,
foreign key(HallNo) references LECTURE_HALL(HallNo) on update cascade on delete restrict
);

/*Student requesting vehicle*/
create table stud_vehicle(
RegNo char(6),
Email varchar(30) Not NULL,
VehiRegNo varchar(10),
reserve_on datetime,
approved bool,
primary key(RegNo,reserve_on),
foreign key(RegNo) references STUDENT(RegNo) on update cascade on delete cascade,
foreign key(VehiRegNo) references VEHICLE(VehiRegNo) on update cascade on delete restrict
);




