# 🚀 EarnRef – Laravel Referral System

A modern **User Referral Tree System** built with Laravel, featuring dynamic level-based income calculation, admin dashboard, and a clean SaaS UI.

---

## ✨ Features

* 🔐 Authentication (User & Admin roles)
* 👥 Referral Tree System (Unlimited Levels)
* 💰 Dynamic Income Calculation (No DB storage)
* 📊 User Dashboard (Referrals, Earnings, Levels)
* 🛠 Admin Panel (Users, Referrals, System Stats)
* ⚡ Livewire Powered UI
* 🎨 Modern Glass UI (Tailwind CSS)

---

## 🧠 Income Logic

Income is calculated dynamically:

| Level    | Income |
| -------- | ------ |
| Level 1  | ₹100   |
| Level 2  | ₹50    |
| Level 3  | ₹25    |
| Level 4+ | ₹10    |

> ⚠️ Income is **NOT stored in database**, calculated using tree traversal.

---

## 📦 Requirements

* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL / MariaDB
* Laravel 10+ / 11+ / 12

---

## ⚙️ Installation Guide

### 1️⃣ Clone Project

```bash
git clone https://github.com/your-username/earnref.git
cd earnref
```

---

### 2️⃣ Install Dependencies

```bash
composer install
npm install
```

---

### 3️⃣ Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

---

### 4️⃣ Configure Database

Edit `.env` file:

```env
DB_DATABASE=earnref
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5️⃣ Run Migration

```bash
php artisan migrate
```

---

### 6️⃣ Seed Admin (Optional)

```bash
php artisan db:seed
```

---

### 7️⃣ Run Project

```bash
php artisan serve
npm run dev
```

Visit:

```
http://127.0.0.1:8000
```

---

## 👤 Default Login (Example)

| Role  | Email                                         | Password |
| ----- | --------------------------------------------- | -------- |
| Admin | [admin@example.com](mailto:admin@example.com) | password |
| User  | [user@example.com](mailto:user@example.com)   | password |

---

## 🏗 Project Structure

```
app/
 ├── Models/User.php
 ├── Http/Controllers/
 ├── Helpers/
 └── Livewire/

resources/views/
 ├── dashboard.blade.php
 ├── admin/
 └── livewire/
```

---

## 🔁 Referral System Flow

1. User registers
2. New user is assigned:

   ```
   parent_id = auth()->id()
   ```
3. Tree structure is created
4. Income calculated dynamically via recursion

---

## 🧩 Key Functions

```php
getAllReferrals($user)
calculateIncome($referrals)
```

---

## 📊 Admin Features

* Total Users
* Today Registrations
* Total Referrals
* Total System Income
* View User Referral Tree

---

## 👨‍💻 Tech Stack

* Laravel
* Livewire
* Tailwind CSS
* MySQL

---

## 🔒 Security

* Role-based access (Admin/User)
* Secure referral validation
* No circular reference allowed

---

## 📈 Future Improvements

* 🌳 Tree Visualization UI
* 📊 Charts & Analytics
* ⚡ Caching for performance
* 📧 Email Invitations

---

## 🤝 Contributing

Feel free to fork and improve the project.

---

## 📄 License

This project is open-sourced under the **MIT License**.

---

## ❤️ Author

Developed by **Khushal Baraiya**
Laravel Developer 🚀

---
