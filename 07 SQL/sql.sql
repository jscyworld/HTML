
-- Ex. 1 Create DB and tables
create database college character set utf8 collate utf8_general_ci;
use college;

create table student (
	student_id integer primary key,
	name varchar(10) not null,
	year smallint not null default "1",
	dept_no integer not null,
	major varchar(20)
);

create table department (
	dept_no integer primary key auto_increment,
	dept_name varchar(20) unique key not null,
	office varchar(20) not null,
	office_tel varchar(13)
);

alter table student change column major major varchar(30);
alter table student add column gender varchar(1);

-- Ex. 2 Insert
alter table student drop column gender;
insert into student values(20070002, '송은이', 3, 4, '경영학');
insert into student values(20060001, '박미선', 4, 4, '경영학');
insert into student values(20030001, '이경규', 4, 2, '전자공학');
insert into student values(20040003, '김용만', 3, 2, '전자공학');
insert into student values(20060002, '김국진', 3, 1, '컴퓨터공학');
insert into student values(20100002, '한선화', 3, 4, '경영학');
insert into student values(20110001, '송지은', 2, 1, '컴퓨터공학');
insert into student values(20080003, '전효성', 4, 3, '법학');
insert into student values(20040002, '김구라', 4, 5, '영문학');
insert into student values(20070001, '김숙', 4, 4, '경영학');
insert into student values(20100001, '황광희', 3, 4, '경영학');
insert into student values(20110002, '권지용', 2, 1, '전자공학');
insert into student values(20030002, '김재진', 5, 1, '컴퓨터공학');
insert into student values(20070003, '신봉선', 4, 3, '법학');
insert into student values(20070005, '김신영', 2, 5, '영문학');
insert into student values(20100003, '임시환', 3, 1, '컴퓨터공학');
insert into student values(20070007, '정준하', 2, 4, '경영학');

insert into department(dept_name, office, office_tel) values('컴퓨터공학', '이학관 101호', '02-3290-0123');
insert into department(dept_name, office, office_tel) values('전자공학', '공학관 401호', '02-3290-2345');
insert into department(dept_name, office, office_tel) values('법학', '법학관 201호', '02-3290-7896');
insert into department(dept_name, office, office_tel) values('경영학', '경영관 104호', '02-3290-1112');
insert into department(dept_name, office, office_tel) values('영문학', '문화관 303호', '02-3290-4412');

-- Ex. 3 Update & delete data
update department set dept_name = '전자전기공학' where dept_name = '전자공학';
update student set major = '전자전기공학' where major = '전자공학';
insert into department(dept_name, office, office_tel) values('특수교육학과', '공학관 403호', '02-3290-2347');
update student set major = '특수교육학과' where name = '송지은';
delete from student where name = '권지용';
delete from student where name = '김재진';

-- Ex. 4 Query
select * from student where major = '컴퓨터공학';
select student_id, year, major from student;
select * from student where year = 3;
select * from student where year = 1 or year = 2;
select student.* from student join department on student.dept_no = department.dept_no where department.dept_name = '경영학';

-- Ex. 5 Advanced Query
select * from student where student_id like '2007%';
select * from student order by student_id;
select major from student group by major having avg(year) > 3;
select * from student where major = '경영학' and student_id like '2007%' limit 2;

-- Ex. 6 imdb
use imdb_small;
select roles.role from roles join movies on roles.movie_id = movies.id where movies.name = 'Pi';
select first_name, last_name from actors join roles on actors.id = roles.actor_id join movies on roles.movie_id = movies.id where movies.name = 'Pi';
select a.first_name, a.last_name from actors a join roles r1 on r1.actor_id = a.id join movies m1 on r1.movie_id = m1.id join roles r2 on r2.actor_id = a.id join movies m2 on r2.movie_id = m2.id where m1.name = 'Kill Bill: Vol. 1' and m2.name = 'Kill Bill: Vol. 2';
select first_name, last_name, count(movie_id) from actors join roles on actors.id = roles.actor_id join movies on roles.movie_id = movies.id group by actor_id order by count(movie_id) desc limit 7;
select genre from movies_genres group by genre order by count(movie_id) desc limit 3;
select first_name, last_name from directors join movies_directors on directors.id = movies_directors.director_id join movies_genres on movies_directors.movie_id = movies_genres.movie_id where movies_genres.genre = 'Thriller' group by movies_directors.director_id order by count(genre) desc limit 1;

-- Ex. 7 Simpsons
use simpsons;
select grade from grades join courses on grades.course_id = courses.id where courses.name = 'Computer Science 143';
select students.name, grades.grade from students join grades on students.id = grades.student_id join courses on grades.course_id = courses.id where courses.name = 'Computer Science 143' and grades.grade <= 'B-';
select students.name, courses.name, grades.grade from students join grades on students.id = grades.student_id join courses on grades.course_id = courses.id where grades.grade <= 'B-';
select courses.name from grades join courses on grades.course_id = courses.id group by course_id having count(grades.student_id) >= 2;
