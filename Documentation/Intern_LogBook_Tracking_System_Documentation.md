# STUDENT INTERNSHIP LOGBOOK SYSTEM

## FINAL YEAR PROJECT DOCUMENTATION

**Prepared by:** [Your Full Name]  
**Registration Number:** [Your Reg No]  
**Supervisor:** [Supervisor's Name]  
**Institution:** [Your Institution Name]  
**Date:** [Submission Date]

---

## ABSTRACT

The Student Internship LogBook System is a web‑based application developed to replace traditional paper‑based logbooks used by students during industrial attachment. The system allows students to record daily activities, supervisors to monitor progress and provide feedback, and administrators to manage users and assignments. Built using procedural PHP, MySQL, HTML, CSS (Bootstrap), and running on XAMPP, the system offers a simple, secure, and user‑friendly interface. It addresses the challenges of lost logbooks, delayed feedback, and lack of centralised monitoring. The system was developed following the waterfall methodology, with thorough testing and validation. The result is a fully functional online logbook that enhances communication between students and supervisors and provides a reliable record for the institution.

---

## TABLE OF CONTENTS

1. Introduction  
   1.1 Background of the Study  
   1.2 Problem Statement  
   1.3 Objectives  
   1.4 Scope and Limitations  
   1.5 Significance of the Study  

2. Literature Review  
   2.1 Introduction  
   2.2 Review of Existing Systems  
   2.3 Technologies Used  
   2.4 Summary  

3. Methodology  
   3.1 Introduction  
   3.2 System Development Life Cycle (Waterfall Model)  
   3.3 Requirements Gathering  
   3.4 System Design  
   3.5 Database Design  
   3.6 Development Tools and Environment  

4. System Implementation  
   4.1 Introduction  
   4.2 System Architecture  
   4.3 Module Description  
   4.4 User Interfaces  
   4.5 Code Structure  
   4.6 Testing  

5. Conclusion and Recommendations  
   5.1 Conclusion  
   5.2 Recommendations for Future Work  

6. References  

7. Appendices  
   Appendix A: User Manual  
   Appendix B: Sample Screenshots  
   Appendix C: Viva Preparation Questions and Answers  

---

## CHAPTER 1: INTRODUCTION

### 1.1 Background of the Study

Industrial attachment (internship) is a critical component of many academic programmes, providing students with practical experience in their field of study. During this period, students are required to maintain a logbook documenting daily activities, skills acquired, and reflections. Traditionally, these logbooks are paper‑based, which poses several challenges: they can be lost or damaged, feedback from supervisors is often delayed, and institutions lack a centralised way to monitor student progress.

The advancement of information technology offers an opportunity to digitise this process. A web‑based logbook system can provide real‑time access, secure storage, and efficient communication between students, supervisors, and administrators.

### 1.2 Problem Statement

The current manual logbook system suffers from:

- **Physical vulnerability:** Paper logbooks can be misplaced, damaged, or destroyed.
- **Delayed feedback:** Supervisors may not review logs promptly, and students may not receive timely comments.
- **Lack of monitoring:** Institutions cannot easily track student attendance or activity patterns across multiple students.
- **Inefficiency:** Manual submission and review processes are time‑consuming.

Therefore, there is a need for an online system that allows students to submit logs, supervisors to comment, and administrators to manage users and assignments, all in a secure and accessible platform.

### 1.3 Objectives

**Main Objective:**  
To design and develop a web‑based Student Internship LogBook System that streamlines the recording, monitoring, and feedback process during industrial attachment.

**Specific Objectives:**

1. To create a platform where students can easily add, edit, and delete daily log entries.
2. To enable supervisors to view logs of assigned students and provide comments.
3. To allow administrators to manage users (students, supervisors, admins) and assign supervisors to students.
4. To implement a secure login system with role‑based access control.
5. To design a responsive and user‑friendly interface using Bootstrap.

### 1.4 Scope and Limitations

**Scope:**

- The system supports three user roles: Admin, Supervisor, and Student.
- Students can perform CRUD (Create, Read, Update, Delete) operations on their logs.
- Supervisors can view logs of students assigned to them and add comments (one comment per log).
- Administrators can add, edit, delete users, and assign supervisors to students.
- The system uses procedural PHP, MySQL, and Bootstrap.

**Limitations:**

- The system does not support file uploads (e.g., attaching documents to logs).
- It does not include email notifications (e.g., when a comment is added).
- There is no password reset feature; passwords must be changed by admin or via direct database update.
- The system is designed for a single institution; scaling to multiple institutions would require modifications.

### 1.5 Significance of the Study

- **For Students:** Provides a convenient, always‑available platform to record activities and receive timely feedback.
- **For Supervisors:** Enables easy monitoring of multiple students and quick comment submission.
- **For Administrators:** Centralises user management and supervisor‑student assignments.
- **For the Institution:** Offers a digital archive of internship activities for accreditation and quality assurance purposes.

---

## CHAPTER 2: LITERATURE REVIEW

### 2.1 Introduction

This chapter reviews existing logbook systems, both manual and digital, and the technologies used in developing the proposed system.

### 2.2 Review of Existing Systems

Several institutions still rely on paper logbooks. While some have adopted spreadsheet‑based logs (e.g., Excel), these lack real‑time collaboration and security. Commercial solutions like **Internship Tracker** and **Logbook Pro** exist, but they are often expensive and not tailored to specific institutional needs. Open‑source alternatives like **Moodle** have logbook plugins, but they require extensive configuration and may be overkill for a simple logbook.

The proposed system fills the gap by offering a lightweight, custom‑built solution that is easy to deploy and use.

### 2.3 Technologies Used

- **PHP (Procedural):** A server‑side scripting language ideal for web development. Procedural PHP was chosen for its simplicity and beginner‑friendliness.
- **MySQL:** A relational database management system used to store user data, logs, assignments, and comments. It is reliable, free, and integrates well with PHP.
- **HTML/CSS:** For structuring and styling web pages.
- **Bootstrap 5:** A front‑end framework that ensures responsive design and provides pre‑built components (navbar, cards, tables) for a professional look.
- **XAMPP:** A cross‑platform local server environment that includes Apache, MySQL, and PHP, making development and testing easy.

### 2.4 Summary

The literature confirms that a web‑based logbook system can address the limitations of paper‑based methods. The chosen technologies are mature, well‑documented, and suitable for a final year project.

---

## CHAPTER 3: METHODOLOGY

### 3.1 Introduction

This chapter describes the software development methodology used, requirements gathering, system design, database design, and development tools.

### 3.2 System Development Life Cycle (Waterfall Model)

The Waterfall model was adopted due to its linear and sequential nature, which is suitable for small‑scale projects with well‑defined requirements. The phases were:

1. **Requirements Analysis:** Gathering functional and non‑functional requirements from students, supervisors, and administrators.
2. **System Design:** Designing the database, user interfaces, and system architecture.
3. **Implementation:** Coding the system using PHP, MySQL, HTML, CSS, and Bootstrap.
4. **Testing:** Performing unit testing, integration testing, and user acceptance testing.
5. **Deployment:** Installing the system on XAMPP and configuring it for use.
6. **Maintenance:** Ongoing bug fixes and updates (future phase).

### 3.3 Requirements Gathering

Requirements were collected through interviews with students who had completed internships, discussions with faculty supervisors, and analysis of existing paper logbooks. The key requirements were:

- **User Management:** Admin can add, edit, delete users.
- **Assignment:** Admin can assign a supervisor to a student.
- **Log Management:** Student can add, view, edit, delete logs.
- **Commenting:** Supervisor can view logs of assigned students and add comments.
- **Authentication:** Secure login with role‑based redirection.

### 3.4 System Design

The system follows a three‑tier architecture:

- **Presentation Tier:** HTML pages with Bootstrap styling, served by Apache.
- **Business Logic Tier:** PHP scripts handling user requests, session management, and data processing.
- **Data Tier:** MySQL database storing all persistent data.

### 3.5 Database Design

The database `logbook_db` consists of four tables:

- **users:** Stores user information (id, name, email, password, role, created_at).
- **assignments:** Links students and supervisors (student_id, supervisor_id, assigned_date).
- **logs:** Stores student log entries (id, student_id, log_date, description, hours, created_at).
- **comments:** Stores supervisor comments on logs (id, log_id, supervisor_id, comment_text, created_at).

Foreign keys ensure data integrity (e.g., a comment cannot exist without a log).

### 3.6 Development Tools and Environment

- **Operating System:** Ubuntu (or Windows with XAMPP)
- **Local Server:** XAMPP (Apache + MySQL + PHP)
- **Code Editor:** VS Code / Sublime Text / gedit
- **Browser:** Google Chrome / Firefox for testing
- **Version Control:** Git (optional)

---

## CHAPTER 4: SYSTEM IMPLEMENTATION

### 4.1 Introduction

This chapter details how the system was built, including the architecture, modules, user interfaces, and testing.

### 4.2 System Architecture

The system follows a client‑server architecture. The client (browser) sends HTTP requests to the Apache server, which executes PHP scripts. These scripts interact with the MySQL database and return HTML responses.

### 4.3 Module Description

| Module | Description |
|--------|-------------|
| **Authentication Module** | Handles login, session creation, and logout. Verifies user credentials against the database. |
| **Admin Module** | Allows admin to manage users (add, edit, delete) and assign supervisors to students. |
| **Supervisor Module** | Displays assigned students, allows viewing of student logs, and adding comments. |
| **Student Module** | Enables students to perform CRUD operations on their own logs and view supervisor comments. |
| **Database Module** | Provides database connection (`config/db.php`) and common query functions. |

### 4.4 User Interfaces

**![LoginPage](/images/Login.png)**
*Figure 4.1: Login Page – Users enter email and password.*

**![Admin Dashboard](/images/AdminDashboard.png)**  
*Figure 4.2: Admin Dashboard – Options to manage users and assign supervisors.*

**![ Manage Users Page](/images/ManageUsers.png)**  
*Figure 4.3: Admin can view, add, edit, delete users.*

**![Assign Supervisor Page](/images/AssignSupervisor.png)**  
*Figure 4.4: Admin assigns a supervisor to a student.*

**![ Student Dashboard](/images/StudentDashboard.png)**  
*Figure 4.5: Student can add new logs and view existing logs with comments.*

**![Supervisor Dashboard](/images/SupervisorDashboard.png)**  
*Figure 4.6: Supervisor sees assigned students and can view their logs.*

**![View Student Logs (Supervisor)](/images/LogReview.png)**  
*Figure 4.7: Supervisor views logs and adds comments.*

### 4.5 Code Structure

The project folder is organised as follows:

```
LogBook/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── images/
│   └── js/
│       └── script.js
├── config/
│   └── db.php
├── includes/
│   ├── header.php
│   └── footer.php
├── pages/
│   ├── dashboard_admin.php
│   ├── manage_users.php
│   ├── add_user.php
│   ├── add_user_process.php
│   ├── edit_user.php
│   ├── edit_user_process.php
│   ├── delete_user.php
│   ├── assign_supervisor.php
│   ├── assign_supervisor_process.php
│   ├── dashboard_supervisor.php
│   ├── view_student_logs.php
│   ├── add_comment_process.php
│   ├── dashboard_student.php
│   ├── add_log_process.php
│   ├── edit_log.php
│   ├── edit_log_process.php
│   ├── delete_log.php
├── index.php
├── login_process.php
└── logout.php
```

**Key Code Snippets:**

- **Database Connection (config/db.php):** Establishes connection using `mysqli_connect()`.
- **Login Processing (login_process.php):** Validates credentials, starts session, redirects based on role.
- **Add User (add_user_process.php):** Hashes password with `password_hash()` before insertion.
- **View Student Logs (view_student_logs.php):** Joins `logs` and `comments` tables to display logs with comments.

### 4.6 Testing

Testing was conducted in phases:

- **Unit Testing:** Each PHP script was tested individually for correct output.
- **Integration Testing:** Combined modules (e.g., adding a log and viewing it) were tested.
- **User Acceptance Testing:** Sample users (students, supervisors, admin) tested the system and provided feedback.

All test cases passed, and the system functions as expected.

---

## CHAPTER 5: CONCLUSION AND RECOMMENDATIONS

### 5.1 Conclusion

The Student Internship LogBook System successfully achieves its objectives. It provides a secure, user‑friendly platform for students to record daily activities, for supervisors to give feedback, and for administrators to manage users and assignments. The use of procedural PHP, MySQL, and Bootstrap made development straightforward and efficient. The system eliminates the drawbacks of paper‑based logbooks and enhances communication between stakeholders.

### 5.2 Recommendations for Future Work

- **Email Notifications:** Implement automated emails to notify supervisors when a student submits a log and students when a comment is added.
- **File Attachments:** Allow students to upload supporting documents (e.g., photos, certificates) to log entries.
- **Reporting Module:** Generate PDF reports of student logs for submission to the institution.
- **Password Reset:** Add a "Forgot Password" feature with email verification.
- **Mobile App:** Develop a mobile version for Android/iOS.
- **Multi‑institution Support:** Extend the system to support multiple institutions with separate databases.

---

## REFERENCES

1. Welling, L., & Thomson, L. (2008). *PHP and MySQL Web Development*. Addison‑Wesley.
2. Duckett, J. (2011). *HTML and CSS: Design and Build Websites*. John Wiley & Sons.
3. Bootstrap Team. (2023). *Bootstrap Documentation*. Retrieved from https://getbootstrap.com/docs/
4. Apache Friends. (2023). *XAMPP Documentation*. Retrieved from https://www.apachefriends.org/docs/

---

## APPENDICES

### Appendix A: User Manual

**How to Use the System**

1. **Login:** Open `http://localhost/LogBook` and enter your email and password.
2. **Admin Functions:**
   - Click "Manage Users" to add, edit, or delete users.
   - Click "Assign Supervisor" to link a student to a supervisor.
3. **Supervisor Functions:**
   - After login, view your assigned students.
   - Click "View Logs" next to a student to see their entries.
   - Add a comment on any log that does not already have one.
4. **Student Functions:**
   - Add a new log using the form at the top of the dashboard.
   - View your logs; edit or delete them using the buttons.
   - Read supervisor comments below each log.
5. **Logout:** Click the "Logout" link in the navigation bar.

### Appendix B: Sample Screenshots

**![LoginPage](/images/Login.png)**
*Figure 4.1: Login Page – Users enter email and password.*

**![Admin Dashboard](/images/AdminDashboard.png)**  
*Figure 4.2: Admin Dashboard – Options to manage users and assign supervisors.*

**![ Manage Users Page](/images/ManageUsers.png)**  
*Figure 4.3: Admin can view, add, edit, delete users.*

**![Assign Supervisor Page](/images/AssignSupervisor.png)**  
*Figure 4.4: Admin assigns a supervisor to a student.*

**![ Student Dashboard](/images/StudentDashboard.png)**  
*Figure 4.5: Student can add new logs and view existing logs with comments.*

**![Supervisor Dashboard](/images/SupervisorDashboard.png)**  
*Figure 4.6: Supervisor sees assigned students and can view their logs.*

**![View Student Logs (Supervisor)](/images/LogReview.png)**  
*Figure 4.7: Supervisor views logs and adds comments.*

### Appendix C: Viva Preparation Questions and Answers

| Question | Suggested Answer |
|----------|------------------|
| **1. What is the purpose of your project?** | The project is an online logbook system for students on internship. It allows students to record daily activities, supervisors to monitor and comment, and administrators to manage users and assignments. |
| **2. Why did you choose procedural PHP instead of OOP or a framework?** | As a beginner, I wanted to keep the code simple and understandable. Procedural PHP is easier to learn and sufficient for a project of this scope. It also ensures that the core logic is transparent and easy to modify. |
| **3. How did you ensure data security?** | Passwords are hashed using PHP's `password_hash()`. SQL injection is mitigated by using `mysqli_real_escape_string()` on user inputs. Session management prevents unauthorized access to pages. |
| **4. Explain your database design.** | The database has four tables: `users` (stores all users), `assignments` (links students to supervisors), `logs` (student daily entries), and `comments` (supervisor feedback). Foreign keys maintain referential integrity. |
| **5. How did you handle user roles?** | A `role` column in the `users` table stores 'admin', 'supervisor', or 'student'. After login, the role determines which dashboard the user sees and what actions they can perform. |
| **6. What challenges did you face during development?** | Initially, I struggled with file paths and session management. I also had to learn how to properly hash passwords and verify them. Through testing and online resources, I overcame these issues. |
| **7. How did you test the system?** | I performed unit testing on each script, integration testing on workflows (e.g., add log → view log → comment), and user acceptance testing with sample users. All features work as expected. |
| **8. What are the limitations of your system?** | The system does not support email notifications, file uploads, or password reset. It is designed for a single institution. |
| **9. How would you improve the system in the future?** | I would add email notifications, a reporting module for PDF generation, and a password reset feature. I might also consider converting to a framework like Laravel for better scalability. |
| **10. Can this system be deployed on a live server?** | Yes, with minor changes (database connection settings, absolute paths). It requires a web server with PHP and MySQL, which is available on most hosting platforms. |

---

**END OF DOCUMENTATION**

---
