# Role-Based Content Approval System (Laravel 12)

## 🚀 Overview

This project is a role-based content approval system where users can create posts and managers/admins approve or reject them.

## 👥 Roles

* Author
* Manager
* Admin

## 📌 Features

### Author

* Create post
* Update own post
* View only own posts

### Manager/Admin

* View all posts
* Approve post
* Reject post with reason

### Admin Only

* Delete post

## 📝 Activity Logs

Tracks:

* Post created
* Post updated
* Post approved
* Post rejected
* Post deleted

## 🧱 Tech Stack

* Laravel 12
* MySQL
* REST API
* Laravel Policies
* Service Layer Architecture

## ⚙️ Installation

```bash
git clone <repo_url>
cd role-approval
composer install
cp .env.example .env
php artisan key:generate
```

## 🗄️ Setup Database

Update `.env` and run:

```bash
php artisan migrate --seed
```

## 🔐 API Authentication

Using Laravel Sanctum.

```bash
php artisan install:api
```

## 📡 API Endpoints

| Method | Endpoint                | Description  |
| ------ | ----------------------- | ------------ |
| GET    | /api/posts              | List posts   |
| POST   | /api/posts              | Create post  |
| PUT    | /api/posts/{id}         | Update post  |
| POST   | /api/posts/{id}/approve | Approve post |
| POST   | /api/posts/{id}/reject  | Reject post  |
| DELETE | /api/posts/{id}         | Delete post  |

## 🧠 Architecture

* Controller → Service → Model
* Policy-based authorization
* Database transactions
* Activity logging

## 🧪 Test Users

| Role    | Email                                       | Password |
| ------- | ------------------------------------------- | -------- |
| Author  | [author@test.com](mailto:author@test.com)   | 123456 |
| Manager | [manager@test.com](mailto:manager@test.com) | 123456 |
| Admin   | [admin@test.com](mailto:admin@test.com)     | 123456 |

## ✅ Notes

* Only authors can create/update posts
* Only managers/admins can approve/reject
* Only admin can delete posts

---

## 📌 Author

Sudipta Patra
