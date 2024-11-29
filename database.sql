-- Create 'employees' table
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    course_name VARCHAR(100) NOT NULL
);

-- Create 'manager' table
CREATE TABLE manager (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL
);

-- Create 'jobs' table
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_name VARCHAR(100) NOT NULL,
    job_description TEXT
);

INSERT INTO employees (first_name, last_name, job_name) VALUES ('Ken', 'Mac', 'Socmed Manager');
INSERT INTO manager (first_name, last_name) VALUES ('Lynel', 'Tabien');
