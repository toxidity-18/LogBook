# Student Internship LogBook System

![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)
![License](https://img.shields.io/badge/License-MIT-green)

A web-based application for students to record daily activities during industrial attachment, with supervisor monitoring and admin management.

**![LoginPage](/images/Login.png)**
*Figure 4.1: Login Page – Users enter email and password.*


---

## 📋 Table of Contents
- [Overview](#overview)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Prerequisites](#prerequisites)
- [Local Installation (XAMPP)](#local-installation-xampp)
- [Configuration](#configuration)
- [Live Deployment (InfinityFree)](#live-deployment-infinityfree)
- [Usage Guide](#usage-guide)
- [Project Structure](#project-structure)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

---

## 📌 Overview

The Student Internship LogBook System replaces traditional paper logbooks with a digital platform. Students can log daily tasks, supervisors can provide feedback, and administrators manage users and assignments. Built with procedural PHP and MySQL, it offers a simple yet effective solution for internship tracking.

---

## ✨ Features

### 👨‍🎓 Student
- Add new daily log entries (date, description, hours)
- View, edit, and delete own logs
- See supervisor comments on logs

### 👨‍🏫 Supervisor
- View list of assigned students
- View all logs of a specific student
- Add comments on logs (one comment per log)

### 👨‍💼 Admin
- Manage users (add, edit, delete)
- Assign supervisors to students
- View current assignments

### 🔒 General
- Secure login with password hashing
- Role-based access control (admin/supervisor/student)
- Responsive Bootstrap 5 UI
- Session management

---

## 🛠 Technologies Used

- **Backend:** PHP 8.2 (procedural)
- **Database:** MySQL 8.0 (or MariaDB)
- **Frontend:** HTML5, CSS3, Bootstrap 5, FontAwesome 6
- **Server:** Apache (XAMPP for local, shared hosting for live)
- **Tools:** phpMyAdmin, Git (optional)

---

## 📋 Prerequisites

Before you begin, ensure you have:
- **Local Development:** XAMPP (or any LAMP stack) installed
- **Live Deployment:** An InfinityFree account (free) or any PHP/MySQL hosting
- Basic knowledge of file management and database operations

---

## 💻 Local Installation (XAMPP)

### Step 1: Download XAMPP
- Visit [Apache Friends](https://www.apachefriends.org/) and download XAMPP for your OS (PHP 8.2 recommended).
- Install and start Apache & MySQL from the XAMPP control panel.

### Step 2: Clone or Download the Project
```bash
# Navigate to XAMPP's htdocs folder
cd /opt/lampp/htdocs   # Linux
# or C:\xampp\htdocs   # Windows

# Clone the repository (or download ZIP and extract)
git clone https://github.com/yourusername/logbook.git
# Rename folder to LogBook (optional)
mv logbook LogBook
```

### Step 3: Create Database
- Open phpMyAdmin: `http://localhost/phpmyadmin`
- Create a new database named `logbook_db`
- Import the `database.sql` file (provided in the project root) into `logbook_db`

### Step 4: Configure Database Connection
Edit `config/db.php` with your local credentials:
```php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'logbook_db';
```

### Step 5: Run the Project
- Open your browser and go to `http://localhost/LogBook`
- Default admin credentials (if you imported sample data):
  - Email: `admin@example.com`
  - Password: `password`

---

## ⚙️ Configuration

### Environment-Specific Settings
- **Local:** Use `localhost` as database host, `root` with empty password.
- **Live:** Update `config/db.php` with your hosting provider's database credentials (host, username, password, database name).

### File Permissions (Linux)
Ensure proper permissions for the project folder:
```bash
chmod -R 755 /path/to/LogBook
```

---

<!-- ## 🌐 Live Deployment (InfinityFree)

### Step 1: Sign Up at InfinityFree
- Go to [InfinityFree.net](https://www.infinityfree.net/) and create a free account.
- After verification, log in to the control panel.

### Step 2: Create a Hosting Account
- Click **"Create Account"**.
- Choose a free subdomain (e.g., `yourproject.infinityfreeapp.com`).
- Wait for the account to be created.

### Step 3: Create a MySQL Database
- In the control panel, go to **"MySQL Databases"**.
- Create a new database, user, and password.
- Note the **database name**, **username**, **password**, and **hostname** (e.g., `sql123.infinityfree.com`).

### Step 4: Upload Project Files
- Use the **File Manager** in the control panel or an FTP client (e.g., FileZilla) to upload all project files into the `htdocs` folder.
- **Important:** Ensure `index.php` is directly inside `htdocs`, not in a subfolder (or adjust accordingly).

### Step 5: Update Database Configuration
- Edit `config/db.php` via File Manager with your live database credentials:
```php
$db_host = 'sql123.infinityfree.com';   // your actual host
$db_user = 'if0_12345678_user';         // full username with prefix
$db_pass = 'YourPassword';
$db_name = 'if0_12345678_logbook_db';   // full database name with prefix
```

### Step 6: Import Database
- In phpMyAdmin (accessible from InfinityFree control panel), select your database.
- Click **"Import"**, choose your local `.sql` file, and execute.

### Step 7: Test Your Live Site
- Visit `http://yourproject.infinityfreeapp.com`
- Log in with existing credentials or use the default admin account. -->

---

## 📖 Usage Guide

### Admin
1. Log in with admin credentials.
2. **Manage Users:** Add, edit, or delete students/supervisors.
3. **Assign Supervisor:** Link a student to a supervisor.

### Supervisor
1. Log in to see assigned students.
2. Click **"View Logs"** next to a student.
3. Add comments on logs that have no comment yet.

### Student
1. Log in to access dashboard.
2. Use the form at the top to add a new log entry.
3. View, edit, or delete your logs below.
4. Read supervisor comments under each log.

---

## 📁 Project Structure

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
│   └── delete_log.php
├── index.php
├── login_process.php
└── logout.php
```

---

## 📸 Screenshots

*Add your own screenshots here.*


### Entity Relationship Diagram
**![EntityRelationshipDiagram](/images/EntityRelationshipDiagram.png)**
*Figure 3.1: Entity Relationship Diagram of the LogBook Database*

### Flowchart Diagram
**![FlowchartDiagram](/images/FlowchartDiagram.png)**
*Figure 3.2: System Flowchart of User Interactions*

### Login Page
**![LoginPage](/images/Login.png)**
*Figure 4.1: Login Page – Users enter email and password.*

### Admin Dashboard
**![Admin Dashboard](/images/AdminDashboard.png)**  
*Figure 4.2: Admin Dashboard – Options to manage users and assign supervisors.*

### Manage Users
**![ Manage Users Page](/images/ManageUsers.png)**  
*Figure 4.3: Admin can view, add, edit, delete users.*

### Assign Supervisor
**![Assign Supervisor Page](/images/AssignSupervisor.png)**  
*Figure 4.4: Admin assigns a supervisor to a student.*

### Student Dashboard
**![ Student Dashboard](/images/StudentDashboard.png)**  
*Figure 4.5: Student can add new logs and view existing logs with comments.*

### Supervisor Dashboard
**![Supervisor Dashboard](/images/SupervisorDashboard.png)**  
*Figure 4.6: Supervisor sees assigned students and can view their logs.*

### View Student Logs (Supervisor)
**![View Student Logs (Supervisor)](/images/LogReview.png)**  
*Figure 4.7: Supervisor views logs and adds comments.*

### Entity Relationship Diagram



---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Open a Pull Request.

---

## 📄 License

This project is licensed under the MIT License – see the [LICENSE](LICENSE) file for details.

