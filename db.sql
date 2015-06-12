PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE students (
	id          INTEGER primary key,
	first_name  TEXT,
	last_name   TEXT,
	grade_level INTEGER
);
CREATE TABLE cycles (
	id     INTEGER primary key,
	name   TEXT,
	status TEXT
);
CREATE TABLE users (
	id   INTEGER primary key,
	name TEXT,
	role TEXT
);
CREATE TABLE tutorials (
	id           INTEGER primary key,
	name         TEXT,
	cycle_id     INTEGER,
	room_number  TEXT,
	teacher_name TEXT,
	max_students INTEGER
);
CREATE TABLE students_tutorials (
	id          INTEGER primary key,
	student_id  INTEGER,
	tutorial_id INTEGER
);
COMMIT;
