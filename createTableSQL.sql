create table REQUESTS_QUEUE(
request_id					NOT NULL,
request_title VARCHAR2(10),
id INT,
employee_name VARCHAR2(30),
priority VARCHAR2(15),
program VARCHAR2(15)
site_name VARCHAR2(10)
request_description VARCHAR2(300),
request_date DATE,
approved_date DATE,
finished_date DATE,
status VARCHAR2(15),
primary key(request_id)
);

