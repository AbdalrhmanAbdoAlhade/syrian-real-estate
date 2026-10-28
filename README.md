<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=0:0f2027,50:203a43,100:2c5364&height=220&section=header&text=Syrian%20Real%20Estate&fontSize=46&fontColor=ffffff&fontAlignY=38&desc=Scalable%20Real%20Estate%20Management%20System&descSize=20&descAlignY=58&animation=fadeIn" width="100%" alt="header" />

<a href="https://git.io/typing-svg">
  <img src="https://readme-typing-svg.demolab.com?font=JetBrains+Mono&weight=600&size=20&duration=3000&pause=900&color=38BDF8&center=true&vCenter=true&width=700&lines=Building+scalable+real-estate+platforms;Property+Management+%C2%B7+Advanced+Search+%C2%B7+Agencies;Laravel+%C2%B7+MySQL+%C2%B7+Redis+%C2%B7+RESTful+APIs" alt="Typing SVG" />
</a>

<br/>

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-0ea5e9?style=for-the-badge)](LICENSE)

<br/>

[![Portfolio](https://img.shields.io/badge/Portfolio-0ea5e9?style=for-the-badge&logo=vercel&logoColor=white)](https://abdalrhman-abdo-alhade.vercel.app/)
[![Email](https://img.shields.io/badge/Email-EA4335?style=for-the-badge&logo=gmail&logoColor=white)](mailto:abdo.king22227@gmail.com)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/abdalrhman-abdoalhade-6673312ba)
[![WhatsApp](https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white)](https://wa.me/201023402756)

</div>

---

## ⚡ About the Project

A **scalable, high-performance back-end system** designed for the Syrian real estate market. It provides robust APIs for property listings, advanced search filtering, user/agency management, and secure authentication, built to handle production-level traffic with elegance and efficiency.

<table>
<tr>
<td width="50%">

**🏗️ Production Ready**
Built with **Laravel** best practices, featuring expressive ORM, robust background job processing, and real-time event broadcasting.

**🌍 Regional Focus**
Tailored for the **Syrian** and **MENA** real estate market, supporting localized property types, currency, and search requirements.

</td>
<td width="50%">

**🔐 Secure & Scalable**
Role-based access control (RBAC), secure API authentication, and optimized database queries for fast property retrieval.

**📬 Maintainer**
[Abdalrhman AbdoAlhade](mailto:abdo.king22227@gmail.com) - Senior Back-End Systems Engineer

</td>
</tr>
</table>

---

## 🧰 Tech Stack

<div align="center">

**Back-end**

<img src="https://skillicons.dev/icons?i=php,laravel,mysql,redis&theme=dark" alt="backend" />

**Infrastructure & Tools**

<img src="https://skillicons.dev/icons?i=docker,git,postman,linux&theme=dark" alt="infra" />

**Front-end (Compatible)**

<img src="https://skillicons.dev/icons?i=react,ts,tailwind,vue&theme=dark" alt="frontend" />

**Core Features**

![RESTful API](https://img.shields.io/badge/RESTful_API-000000?style=for-the-badge&logo=api&logoColor=white)
![JWT Auth](https://img.shields.io/badge/JWT_Auth-000000?style=for-the-badge&logo=jsonwebtokens&logoColor=white)
![Eloquent ORM](https://img.shields.io/badge/Eloquent_ORM-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Real-time](https://img.shields.io/badge/Real_time-010101?style=for-the-badge&logo=socket.io&logoColor=white)

</div>

---

## ✨ Key Features

<div align="center">

`🏠 Property Management` · `🔍 Advanced Search & Filtering` · `🏢 Agency & Agent Profiles`  
`📸 Media & Image Uploads` · `📍 Location & Map Integration` · `🔐 Role-Based Access Control`  
`📊 Analytics & Reporting` · `⚡ High-Performance Caching (Redis)`

</div>

---

## 📂 Project Structure

| Directory | Description |
|:--|:--|
| `app/Http/Controllers` | API controllers handling property, user, and agency logic |
| `app/Models` | Eloquent models (Property, User, Agency, Category, etc.) |
| `database/migrations` | Database schema definitions and relationships |
| `routes/api.php` | Centralized, versioned RESTful API endpoints |
| `config/` | Application configuration (database, cache, auth) |
| `tests/` | Feature and unit tests ensuring system reliability |

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.1+
- Composer
- MySQL / PostgreSQL
- Redis (for caching and queues)

### Installation

```bash
# Clone the repository
git clone https://github.com/AbdalrhmanAbdoAlhade/syrian-real-estate.git

# Navigate to the project directory
cd syrian-real-estate

# Install PHP dependencies
composer install

# Copy environment file and configure your database
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations and seeders
php artisan migrate --seed

# Start the development server
php artisan serve
