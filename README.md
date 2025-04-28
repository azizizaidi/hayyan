# 🎓 Hayyan Learning Management System (LMS)

A specialized Learning Management System designed for Quran learning centers. Hayyan LMS simplifies student management, course administration, and communication between instructors and students.

## ✨ Key Features

- **📊 Advanced Student Management** - Track student progress, attendance, and assessment results
- **📚 Quran Course Curriculum Builder** - Create structured courses with customizable modules
- **📝 Automated Assessment System** - Schedule and grade assessments automatically
- **👨‍🏫 Instructor Portal** - Dedicated interface for teachers to manage classes and student progress
- **👪 Parent Dashboard** - Real-time access to student performance and upcoming events
- **💬 WhatsApp Integration** - Automated reminders and notifications sent directly via WhatsApp
- **💳 Integrated Payment System** - Streamlined invoice generation and payment processing
- **📈 Comprehensive Reporting** - Generate detailed reports on student progress and center performance
- **🏢 Multi-Center Support** - Manage multiple learning centers from a single installation
- **🌟 5-Star UI/UX Design** - Intuitive user interface with seamless user experience across all devices

## 🔧 Technology Stack

- **⚙️ Backend**: Laravel 12 (API Only)
- **🖥️ Frontend**: Next.js 14
- **🔐 Authentication**: Laravel Sanctum
- **🎨 Styling**: TailwindCSS
- **🗃️ Database**: MySQL
- **⚡ Caching & Queues**: Redis
- **🔌 External Integrations**: WhatsApp API, Payment Gateway API
- **🎯 UI/UX**: 5-star design principles with accessibility focus

## 🏛️ System Architecture Overview

Hayyan LMS follows a decoupled architecture with a Laravel-based RESTful API backend and a Next.js frontend application. The system leverages Redis for efficient caching and background job processing, while MySQL provides robust data storage. External APIs (WhatsApp and Payment Gateway) are integrated through dedicated service layers to maintain separation of concerns. The frontend implements 5-star UI/UX design principles, ensuring intuitive navigation, responsive layouts, and accessible interfaces across all devices and screen sizes.

## 🖼️ Screenshots

*Coming Soon*

## 🚀 Installation Guide

### 📋 Prerequisites

- PHP 8.2+
- Composer 2.0+
- Node.js 18.0+
- npm 9.0+
- MySQL 8.0+
- Redis 6.0+

### 🔙 Backend Installation (Laravel)

1. Clone the repository:
   ```bash
   git clone https://github.com/your-org/hayyan-lms.git
   cd hayyan-lms/backend
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Copy the environment file and configure:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Set up the database:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

### 🖌️ Frontend Installation (Next.js)

1. Navigate to the frontend directory:
   ```bash
   cd ../frontend
   ```

2. Install JavaScript dependencies:
   ```bash
   npm install
   ```

3. Copy the environment file and configure:
   ```bash
   cp .env.example .env.local
   ```

4. Start the development server:
   ```bash
   npm run dev
   ```

### ⚙️ Environment Variables Setup

#### Backend (.env)

```
APP_NAME=HayyanLMS
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hayyan_lms
DB_USERNAME=root
DB_PASSWORD=

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

QUEUE_CONNECTION=redis
CACHE_DRIVER=redis
SESSION_DRIVER=redis

WHATSAPP_API_KEY=your_whatsapp_api_key
WHATSAPP_PHONE_NUMBER_ID=your_phone_number_id

PAYMENT_GATEWAY_API_KEY=your_payment_gateway_api_key
PAYMENT_GATEWAY_SECRET=your_payment_gateway_secret
```

#### Frontend (.env.local)

```
NEXT_PUBLIC_API_URL=http://localhost:8000/api
NEXT_PUBLIC_APP_NAME=Hayyan LMS
```

## 🔐 API Authentication Flow

Hayyan LMS uses Laravel Sanctum for API authentication. The flow works as follows:

1. User submits login credentials to the `/api/login` endpoint
2. Server validates credentials and returns a token if valid
3. Client stores token securely (usually in HTTP-only cookies)
4. All subsequent API requests include the token in the Authorization header
5. Protected routes validate the token before processing requests
6. On logout, token is invalidated on the server

## 📁 Project Folder Structure Overview

```
hayyan-lms/
├── backend/                  # Laravel API application
│   ├── app/                  # Core application code
│   │   ├── Http/             # Controllers, Middleware, Requests
│   │   ├── Models/           # Eloquent models
│   │   └── Services/         # Business logic services
│   ├── config/               # Configuration files
│   ├── database/             # Migrations and seeders
│   ├── routes/               # API routes
│   └── tests/                # Automated tests
│
├── frontend/                 # Next.js application
│   ├── components/           # Reusable UI components
│   ├── pages/                # Page components and routing
│   ├── public/               # Static assets
│   ├── styles/               # Global styles and Tailwind config
│   ├── contexts/             # React context providers
│   ├── services/             # API communication services
│   └── ui-system/            # 5-star UI/UX design system components
│
└── docs/                     # Documentation files
```

## 👥 Contribution Guide

We welcome contributions from the community! Here's how to get started:

1. **Fork the Repository** - Create your own fork of the project

2. **Create a Feature Branch**:
   ```bash
   git checkout -b feature/amazing-feature
   ```

3. **Commit Your Changes**:
   ```bash
   git commit -m 'Add some amazing feature'
   ```

4. **Push to Your Branch**:
   ```bash
   git push origin feature/amazing-feature
   ```

5. **Open a Pull Request** - Submit a PR from your fork to our main repository

6. **Issue Reporting** - Use the GitHub Issues tab to report bugs or suggest features

### 📝 Development Guidelines

- Follow PSR-12 coding standards for PHP
- Use ES6+ features with proper TypeScript typing
- Write tests for new features
- Update documentation as needed

## 📜 License

*License to be updated*

---

© 2025 Hayyan Learning Management System
