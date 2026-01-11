# 🛒 ShopEase - E-Commerce Platform

A full-stack e-commerce platform built with Laravel, featuring product management, shopping cart, checkout system, and order tracking.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC)

## 🎯 Project Overview

ShopEase is a modern e-commerce platform that demonstrates professional Laravel development practices. This project was built from scratch without using pre-built authentication packages, showcasing deep understanding of Laravel's core features.

## ✨ Features

### 👤 User Features
- **User Authentication** (Register, Login, Logout) - Built from scratch
- **Product Browsing** - View products by category or search
- **Product Details** - Detailed product pages with related items
- **Shopping Cart** - Add, update, remove items with real-time totals
- **Checkout System** - Complete order placement with validation
- **Order History** - Track all past orders and their status
- **Search Functionality** - Search products by name or description

### 🔐 Admin Features
- **Admin Dashboard** - Overview with key statistics (products, orders, revenue)
- **Product Management** - Full CRUD operations (Create, Read, Update, Delete)
- **Order Management** - View all orders and update status
- **Stock Management** - Track inventory levels automatically
- **Role-Based Access** - Middleware protection for admin routes

### 🛡️ Security & Validation
- Custom authentication system (no packages)
- Password hashing with bcrypt
- CSRF protection on all forms
- Role-based authorization (Customer vs Admin)
- Stock validation (prevents overselling)
- Input validation on all forms

## 🏗️ Technical Architecture

### Technologies Used
- **Backend:** Laravel 12.x
- **Database:** MySQL
- **Frontend:** Blade Templates, TailwindCSS
- **Authentication:** Custom implementation (no Breeze/Jetstream)
- **Session Management:** Laravel Sessions

### Database Schema
```
users
├── id
├── name
├── email
├── password
├── role (customer/admin)
└── timestamps

categories
├── id
├── name
├── slug
└── timestamps

products
├── id
├── category_id (FK)
├── name
├── slug
├── description
├── price
├── stock
├── image
└── timestamps

orders
├── id
├── user_id (FK, nullable)
├── total
├── status
├── name
├── email
├── address
├── phone
└── timestamps

order_items
├── id
├── order_id (FK)
├── product_id (FK)
├── quantity
├── price
└── timestamps
```

### Key Laravel Concepts Demonstrated

- **MVC Pattern** - Clean separation of concerns
- **Eloquent ORM** - Database relationships (hasMany, belongsTo)
- **Migrations** - Version-controlled database schema
- **Seeders** - Sample data for testing
- **Middleware** - Route protection (auth, admin)
- **Form Validation** - Server-side validation
- **Session Management** - Shopping cart storage
- **Route Model Binding** - Automatic model resolution
- **Blade Components** - Reusable UI elements
- **Query Builder** - Efficient database queries

## 📦 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL or MariaDB
- Git

### Setup Instructions

1. **Clone the repository**
```bash
git clone https://github.com/YOUR-USERNAME/shopease.git
cd shopease
```

2. **Install dependencies**
```bash
composer install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**

Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shopease
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations and seeders**
```bash
php artisan migrate --seed
```

6. **Start development server**
```bash
php artisan serve
```

Visit: `http://127.0.0.1:8000`

## 👥 Default Accounts

### Admin Account
- **Email:** admin@shopease.com
- **Password:** admin123

### Test Customer Account
- **Email:** john@example.com
- **Password:** password123

## 🗂️ Project Structure
```
shopease/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── OrderController.php
│   │   │   ├── ProductController.php
│   │   │   ├── CategoryController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── ProductController.php
│   │   │       └── OrderController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Product.php
│       ├── Category.php
│       ├── Order.php
│       └── OrderItem.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── auth/
│       ├── products/
│       ├── cart/
│       ├── checkout/
│       ├── orders/
│       ├── categories/
│       └── admin/
└── routes/
    └── web.php
```

## 🚀 Features in Detail

### Shopping Cart
- Session-based storage (works for guests)
- Real-time quantity updates
- Automatic total calculation
- Stock validation on add
- Persistent across page refreshes

### Checkout Process
1. Review cart items
2. Fill shipping information
3. Validate stock availability
4. Create order in database
5. Reduce product stock automatically
6. Display order confirmation
7. Clear shopping cart

### Admin Dashboard
- Total products count
- Total orders count
- Total customers count
- Total revenue calculation
- Quick access to product/order management

## 🧪 Testing Workflow

### As Customer
1. Register new account
2. Browse products by category
3. Search for specific items
4. Add products to cart
5. Update cart quantities
6. Proceed to checkout
7. Place order
8. View order history
9. Check order status

### As Admin
1. Login with admin credentials
2. View dashboard statistics
3. Create new products
4. Edit existing products
5. Delete products
6. View all customer orders
7. Update order status
8. Monitor inventory levels

## 💡 What I Learned

Building this project taught me:

- **Authentication from Scratch** - Understanding sessions, password hashing, and middleware
- **Database Relationships** - Implementing one-to-many and many-to-many relationships
- **E-commerce Logic** - Cart management, stock tracking, order processing
- **Role-Based Access Control** - Protecting routes with custom middleware
- **MVC Architecture** - Separating business logic, data, and presentation
- **Laravel Best Practices** - Following conventions and writing clean code

## 🔧 Future Enhancements

- [ ] Email notifications for order confirmations
- [ ] Payment gateway integration (Stripe/PayPal)
- [ ] Product image uploads
- [ ] Product reviews and ratings
- [ ] Wishlist functionality
- [ ] Discount codes/coupons
- [ ] Order tracking with shipment status
- [ ] Export orders to CSV
- [ ] Advanced search filters
- [ ] API for mobile app

## 🤝 Contributing

This is a portfolio project, but feedback is welcome! Feel free to open an issue if you find any bugs, and enhancments.

---

⭐ If you found this project helpful, please give it a star!

Built with ❤️ using Laravel