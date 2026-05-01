# Amelia Hantaran - Project Summary

## Overview
Website company profile dan e-commerce lengkap untuk usaha hantaran pernikahan, dibangun dengan Laravel 12, Blade Template, dan Tailwind CSS.

## File Structure

```
amelia-hantaran/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # 8 Admin Controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── TestimonialController.php
│   │   │   │   ├── GalleryController.php
│   │   │   │   └── SettingController.php
│   │   │   ├── Auth/               # 9 Auth Controllers (Laravel Breeze)
│   │   │   ├── HomeController.php
│   │   │   ├── ProductController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── OrderController.php
│   │   │   └── TestimonialController.php
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/               # 6 Form Request Validations
│   ├── Models/                     # 10 Eloquent Models
│   │   ├── User.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── ProductImage.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── PaymentProof.php
│   │   ├── Testimonial.php
│   │   ├── Gallery.php
│   │   └── Setting.php
│   └── Providers/
│       └── AppServiceProvider.php
├── bootstrap/
│   └── app.php
├── config/
│   ├── app.php
│   ├── database.php
│   └── filesystems.php
├── database/
│   ├── migrations/                 # 12 Migration Files
│   ├── factories/                  # 4 Model Factories
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/                # 4 Layout Files
│       │   ├── app.blade.php
│       │   ├── admin.blade.php
│       │   ├── navigation.blade.php
│       │   └── footer.blade.php
│       ├── components/             # Reusable Components
│       │   └── product-card.blade.php
│       ├── admin/                  # 8 Admin Views
│       │   ├── dashboard.blade.php
│       │   ├── products/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── orders/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   ├── categories/
│       │   │   └── index.blade.php
│       │   └── settings/
│       │       └── index.blade.php
│       ├── auth/                   # 2 Auth Views
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── products/               # 2 Product Views
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── cart/
│       │   └── index.blade.php
│       ├── checkout/               # 2 Checkout Views
│       │   ├── index.blade.php
│       │   └── payment.blade.php
│       ├── orders/                 # 2 Order Views
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── testimonials/           # 2 Testimonial Views
│       │   ├── index.blade.php
│       │   └── create.blade.php
│       ├── home.blade.php
│       ├── about.blade.php
│       ├── contact.blade.php
│       └── gallery.blade.php
├── routes/
│   ├── web.php
│   └── auth.php
├── storage/                        # Laravel Storage
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
├── phpunit.xml
├── .env.example
├── .gitignore
├── artisan
├── README.md
└── PANDUAN.md
```

## Features Implemented

### User Side (Public)
1. ✅ Home Page - Hero, Features, Featured Products, Testimonials, CTA
2. ✅ About Us - Company profile, Vision & Mission, Values
3. ✅ Contact - Contact info, Google Maps
4. ✅ Product Catalog - Grid view, Filter by category, Search, Sort, Pagination
5. ✅ Product Detail - Gallery, Description, Price, Stock, Add to Cart
6. ✅ Shopping Cart - Session-based, Update quantity, Remove item
7. ✅ Checkout - Customer info form, Order summary
8. ✅ Payment - QR Code display, Bank transfer info, Upload payment proof
9. ✅ Order History - List orders, Track status, Order details
10. ✅ Testimonials - View approved testimonials, Submit testimoni (auth)
11. ✅ Gallery - Photo gallery with lightbox

### Admin Panel
1. ✅ Dashboard - Statistics cards, Sales chart (Chart.js), Recent orders, Low stock alert
2. ✅ Product Management - CRUD, Multiple images, Stock management
3. ✅ Category Management - CRUD with modal
4. ✅ Order Management - View all orders, Detail view, Update status, Verify payment
5. ✅ Testimonial Management - Approve/reject, Toggle featured
6. ✅ Gallery Management - CRUD gallery photos
7. ✅ Settings - Company info, Contact, Payment, Shipping cost

### Authentication
1. ✅ Login/Register - Laravel Breeze style
2. ✅ Role-based access - Admin middleware
3. ✅ Password reset

### Database (12 Tables)
1. ✅ users
2. ✅ categories
3. ✅ products
4. ✅ product_images
5. ✅ orders
6. ✅ order_items
7. ✅ payment_proofs
8. ✅ testimonials
9. ✅ galleries
10. ✅ settings
11. ✅ password_reset_tokens
12. ✅ sessions

## Tech Stack
- **Framework:** Laravel 12 (PHP 8.2+)
- **Frontend:** Blade Template Engine + Tailwind CSS (CDN)
- **Database:** MySQL/MariaDB
- **Authentication:** Laravel Breeze (customized)
- **Storage:** Laravel Storage (local/public)
- **Icons:** Lucide Icons
- **Charts:** Chart.js

## Design System
- **Primary Color:** Pink (#ec4899)
- **Secondary Color:** Gold/Amber (#f59e0b)
- **Background:** Cream (#fdfbf7)
- **Fonts:** Playfair Display (headings), Poppins (body)
- **Style:** Wedding/Elegant theme

## API/Routes Summary

### Public Routes
- GET / - Home
- GET /tentang-kami - About
- GET /kontak - Contact
- GET /katalog - Product catalog
- GET /produk/{slug} - Product detail
- GET /keranjang - Cart
- POST /keranjang/tambah/{product} - Add to cart
- PUT /keranjang/update/{product} - Update cart
- DELETE /keranjang/hapus/{product} - Remove from cart

### Auth Routes
- GET /login
- POST /login
- GET /register
- POST /register
- POST /logout

### Protected Routes (User)
- GET /checkout
- POST /checkout
- GET /checkout/pembayaran/{orderNumber}
- GET /pesanan
- GET /pesanan/{orderNumber}
- POST /pesanan/{orderNumber}/upload-bukti
- POST /pesanan/{orderNumber}/batal

### Admin Routes (Prefix: /admin)
- GET / - Dashboard
- Resource /categories
- Resource /products
- GET/POST /orders
- GET /orders/{order}
- POST /orders/{order}/status
- POST /payments/{paymentProof}/verify
- GET /testimonials
- POST /testimonials/{testimonial}/approve
- POST /testimonials/{testimonial}/reject
- Resource /galleries
- GET/POST /settings

## Installation Steps
1. `composer install`
2. `npm install`
3. `cp .env.example .env`
4. `php artisan key:generate`
5. Setup database in .env
6. `php artisan migrate --seed`
7. `php artisan storage:link`
8. `php artisan serve`

## Default Credentials
- **Admin:** admin@ameliahantaran.com / password
- **User:** Register via /register

## Status Order Flow
```
pending → waiting_payment → payment_verification → diproses → dikirim → selesai
   ↑           ↑                    ↑
   └───────────┴────────────────────┘ (can be cancelled)
```

## File Count Summary
- **PHP Controllers:** 24 files
- **PHP Models:** 10 files
- **PHP Migrations:** 12 files
- **Blade Views:** 30+ files
- **Config Files:** 5 files
- **Total Lines of Code:** ~15,000+ lines

---

**Project Location:** `/mnt/okcomputer/output/amelia-hantaran/`

**Created:** April 2025
**Version:** 1.0.0
