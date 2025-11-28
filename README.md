# 🍽️ Cooknice — Platform Berbagi Resep Masakan  
A simple culinary recipe-sharing web application built with **Laravel**, **Blade**, and **MySQL**.  
Users can register, upload recipes with step-by-step images, edit profiles, and explore recipes shared by others.  
Admin can manage users and recipes through a dedicated admin panel.

---

## 🚀 Features

### 👤 User Features
- **User Authentication** (Register, Login, Logout)
- **Edit Profile** with profile picture upload
- **Create Recipe** with:
  - Title
  - Category selection
  - Description
  - Main image
  - Ingredients list
  - Step-by-step instructions
  - Step-by-step images
- **Home Page** displaying all recipes
- **Recipe Details Page**
- **Profile Page** showing user info and posted recipes

### 🔧 Admin Features
- View all users and recipes
- **Delete user**
- **Delete recipe**
- Access protected admin dashboard

---

## 🗂️ Tech Stack
| Layer | Technology |
|------|------------|
| Backend | Laravel 12 |
| Frontend | Blade Templates, Tailwind CSS |
| Database | MySQL (XAMPP) |
| Storage | Laravel Storage (public link) |
| Dev Tools | NPM, Composer, Artisan |

---

## 📸 Screenshots
### 🔐 Login Page
<img width="1919" height="1032" alt="Screenshot 2025-11-25 180534" src="https://github.com/user-attachments/assets/9a88f72b-d368-4d97-953b-2eb07f609d0b" />

### 🆕 Register Page
<img width="1915" height="1022" alt="Screenshot 2025-11-25 180545" src="https://github.com/user-attachments/assets/7cbed0f5-8675-4e0b-a872-8fb1edac0344" />

### 🏠 Home / Beranda Page
<img width="1919" height="943" alt="Screenshot 2025-11-25 183134" src="https://github.com/user-attachments/assets/9c6a234d-44f2-4f0c-8c24-3af6ac57a5e1" />

### 🍳 Upload Recipe Form
<img width="1919" height="992" alt="Screenshot 2025-11-25 183701" src="https://github.com/user-attachments/assets/3fe33d13-5f6e-4bdc-9727-fb4d9915cc47" />

### 📄 Recipe Details
<img width="1919" height="943" alt="Screenshot 2025-11-25 183736" src="https://github.com/user-attachments/assets/04c88bd3-3a3a-471b-8e4b-6e2a33f65c5d" />

### 👤 User Profile
<img width="1918" height="939" alt="Screenshot 2025-11-28 165959" src="https://github.com/user-attachments/assets/f69e75c4-0757-4956-b99a-53b9ecae93a5" />

### ✏️ Edit And Delete Recipe Option
<img width="415" height="283" alt="Screenshot 2025-11-28 165926" src="https://github.com/user-attachments/assets/fe9addb3-dba6-47b6-9a89-afe4a1db8a16" />

### ✏️ Edit Recipe Page
<img width="1919" height="942" alt="Screenshot 2025-11-28 164340" src="https://github.com/user-attachments/assets/627dad80-6f16-4c2e-897e-bb5ed26e0dd5" />

### ✏️ Edit Profile Page
<img width="1916" height="1027" alt="Screenshot 2025-11-25 180634" src="https://github.com/user-attachments/assets/943c3c7d-04db-4c21-9ae6-2ab58a89a245" />

### 🛠️ Admin Dashboard
<img width="1919" height="942" alt="Screenshot 2025-11-25 183146" src="https://github.com/user-attachments/assets/b17212e7-338d-49e6-8d9f-b59c61239d3c" />

---

## 📁 Folder Structure (simplified)
```
Cooknice/
│── app/
│   └── Http/Controllers/
│── public/
│   └── storage/ (symlink)
│── resources/
│   └── views/
│── storage/
│   └── app/public/
│── routes/
│   └── web.php
│── .env
│── composer.json
│── package.json
```
