# tutoring

1. Separates all database/business logic using the MVC pattern.

Databases are separate for each user and the data is accesses through different tables on the respective databases. The file structure is separated accoring to the MVC pattern by classes, controllers, views, and the model directories. 

2.Routes all URLs and leverages a templating language using the Fat-Free framework.

All URL's are accessed by routing through the index and controller files. 

3.Has a clearly defined database layer using PDO and prepared statements. You should have at least two related tables.

Our PDO and prepared statements access data within tables to both add and view data on the database. We have 4 tables, course, student,
instructor, and attendance. 

4.Data can be viewed and added.

By using the Add new student and search features the data is either viewed or added from the database. The add attendance drop down
menu's also pull from the tables of instructors and courses to display the data.

5. Has a history of commits from both team members to a Git repository. Commits are clearly commented.

There have been many commits and well documented changes over the last few weeks since working on the project.

6. Uses OOP, and defines multiple classes, including at least one inheritance relationship.

The classes are used for OOP and to create new objects from the respective class. The student to tutor is the inheritance relationship.
All tutors are students but not all students are tutors. 

7. Contains full Docblocks for all PHP files and follows PEAR standards.

All classes and methods are designated with a docblock and the coding style is formatted in accordance with PEAR standards. 

8. Has full validation on the client side through JavaScript and server side through PHP.

All of the data is validated before being processed and proper warnings are in place to direct the user for good data.

9. All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.

Code segments contain comments where needed and docblocks to explain methods. Code is not redundant in any area.

10. Your submission shows adequate effort for a final project in a full-stack web development course.

Lots of work went into this project. 

11. GitHub repo includes readme file outlining how each requirement was met; UML diagram; and ER diagram
