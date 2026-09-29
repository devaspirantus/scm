# 🎓 نظام إدارة الكورسات والتدريب

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-4.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![AdminLTE](https://img.shields.io/badge/AdminLTE-3.0-00C0EF?style=for-the-badge&logo=adminlte&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

نظام متكامل لإدارة الكورسات والتدريبات مبني بـ Laravel مع واجهة تحكم احترافية باستخدام AdminLTE 3، متوافق مع معايير هيئة الحكومة الرقمية السعودية (DGA).

---

## 📋 جدول المحتويات

- [عن المشروع](#-عن-المشروع)
- [المميزات](#-المميزات)
- [التقنيات المستخدمة](#-التقنيات-المستخدمة)
- [المتطلبات](#-المتطلبات)
- [التثبيت والإعداد](#️-التثبيت-والإعداد)
- [التشغيل](#-التشغيل)
- [هيكل المشروع](#-هيكل-المشروع)
- [قاعدة البيانات](#-قاعدة-البيانات)
- [المسارات المتاحة](#-المسارات-المستخدمة)
- [لقطات الشاشة](#-لقطات-الشاشة)
- [المساهمة](#-المساهمة)
- [الترخيص](#-الترخيص)
- [المطور](#-المطور)

---

## 🎯 عن المشروع

نظام إدارة الكورسات والتدريب هو تطبيق ويب متكامل يتيح إدارة شاملة لـ:

| الوحدة | الوصف |
|--------|-------|
| 📚 **الكورسات** | إدارة كاملة للكورسات (إضافة، تعديل، حذف، عرض) |
| 🎯 **التدريبات** | ربط التدريبات بالكورسات مع الأسعار والمواعيد |
| 🌍 **الدول والوجهات** | إدارة الدول والوجهات السياحية المرتبطة بها |
| ✈️ **الرحلات** | نظام إدارة الرحلات الجوية |
| 📊 **لوحة التحكم** | واجهة إدارية احترافية بإحصائيات شاملة |

---

## ✨ المميزات

### 🎨 واجهة المستخدم
- ✅ تصميم عصري باستخدام **AdminLTE 3**
- ✅ دعم كامل للغة العربية (**RTL**)
- ✅ خطوط **IBM Plex Sans Arabic** المعتمدة من DGA
- ✅ تصميم متجاوب (**Responsive**) لجميع الأجهزة
- ✅ إشعارات **Toast** تفاعلية تختفي تلقائياً
- ✅ أيقونات **Font Awesome 5** احترافية

### 🔧 الوظائف الأساسية
- ✅ عمليات **CRUD** كاملة لجميع البيانات
- ✅ تحقق من صحة البيانات (**Form Requests**)
- ✅ رسائل نجاح وخطأ تفاعلية مع إخفاء تلقائي
- ✅ بحث وفلترة متقدمة
- ✅ ترقيم تلقائي للصفحات (**Pagination**)
- ✅ **Eager Loading** لتحسين الأداء

### 🛡️ الأمان
- ✅ حماية **CSRF** لجميع النماذج
- ✅ حماية من حقن SQL عبر **Eloquent ORM**
- ✅ تحقق من صحة المدخلات قبل الحفظ
- ✅ منع تكرار البيانات الحساسة

### 🔗 العلاقات في قاعدة البيانات
- ✅ علاقة **واحد إلى كثير** (Country → Destinations)
- ✅ علاقة **ينتمي إلى** (Training → Course)
- ✅ استخدام **Foreign Keys** مع **Cascade Delete**

---

## 🚀 التقنيات المستخدمة

| التقنية | الوصف | الإصدار |
|---------|-------|---------|
| **Laravel** | إطار عمل PHP | 13.x |
| **PHP** | لغة البرمجة | 8.5 |
| **MySQL** | قاعدة البيانات | 8.0 |
| **AdminLTE** | قالب لوحة التحكم | 3.0 |
| **Bootstrap** | إطار CSS | 4.x |
| **jQuery** | مكتبة JavaScript | 3.x |
| **Font Awesome** | الأيقونات | 5.x |
| **Laravel Sail** | بيئة التطوير (Docker) | Latest |
| **IBM Plex Sans Arabic** | الخطوط (معتمدة من DGA) | Latest |

---

## 📦 المتطلبات

قبل البدء، تأكد من توفر المتطلبات التالية:

```bash
# التحقق من الإصدارات
php -v          # >= 8.2
composer -V     # Latest
docker -v       # Latest
git --version   # Latest
node -v         # >= 18.x
npm -v          # >= 9.x

# إيقاف التشغيل
./vendor/bin/sail down

# إعادة التشغيل
./vendor/bin/sail restart

# عرض السجلات
./vendor/bin/sail logs -f

# الدخول إلى الحاوية
./vendor/bin/sail shell

# فتح phpMyAdmin
# http://localhost:8080

#Structure
scm/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CoursesController.php          # إدارة الكورسات
│   │   │   ├── TrainingsController.php        # إدارة التدريبات
│   │   │   ├── CountriesController.php        # إدارة الدول
│   │   │   ├── DestinationsController.php     # إدارة الوجهات
│   │   │   ├── FlightsController.php          # إدارة الرحلات
│   │   │   └── HomeController.php             # الصفحة الرئيسية
│   │   └── Requests/
│   │       ├── CreateCourseValidationRequest.php
│   │       └── CreateFlightRequest.php
│   └── Models/
│       ├── Course.php
│       ├── Training.php
│       ├── Country.php
│       ├── Destination.php
│       └── Flight.php
│
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_courses_table.php
│   │   ├── xxxx_create_trainings_table.php
│   │   ├── xxxx_create_countries_table.php
│   │   ├── xxxx_create_destinations_table.php
│   │   └── xxxx_create_flights_table.php
│   ├── factories/
│   │   └── FlightFactory.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── CreateFlightsSeeder.php
│
├── resources/
│   └── views/
│       ├── admin/
│       │   └── layouts/
│       │       └── master.blade.php           # القالب الرئيسي
│       ├── courses/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── trainings/
│       ├── countries/
│       ├── destinations/
│       └── flights/
│
├── public/
│   └── admin/
│       ├── dist/
│       │   ├── css/
│       │   │   ├── adminlte.min.css
│       │   │   └── custom.css                 # تنسيقات DGA المخصصة
│       │   ├── js/
│       │   └── img/
│       └── plugins/
│           ├── fontawesome-free/
│           ├── jquery/
│           ├── bootstrap/
│           └── ...
│
├── routes/
│   └── web.php
│
└── docker-compose.yml                         

#Relation
┌─────────────────┐         ┌─────────────────┐
│     courses     │         │    trainings    │
├─────────────────┤         ├─────────────────┤
│ id (PK)         │◄────────│ courseID (FK)   │
│ name            │         │ price           │
│ link            │         │ start_date      │
│ active          │         │ end_date        │
│ created_at      │         │ notes           │
│ updated_at      │         │ created_at      │
└─────────────────┘         └─────────────────┘

┌─────────────────┐         ┌─────────────────┐
│    countries    │         │  destinations   │
├─────────────────┤         ├─────────────────┤
│ id (PK)         │◄────────│ country_id (FK) │
│ name            │         │ destination     │
│ active          │         │ created_at      │
│ created_at      │         │ updated_at      │
└─────────────────┘         └─────────────────┘

┌─────────────────┐
│     flights     │
├─────────────────┤
│ id (PK)         │
│ name            │
│ created_at      │
│ updated_at      │
└─────────────────┘

#ORM
// Training Model
public function course()
{
    return $this->belongsTo(Course::class, 'courseID');
}

// Course Model
public function trainings()
{
    return $this->hasMany(Training::class, 'courseID');
}

// Country Model
public function destinations()
{
    return $this->hasMany(Destination::class);
}

// Destination Model
public function country()
{
    return $this->belongsTo(Country::class);
}

#Routes
Method
	
URL
	
الاسم
	
الوصف
GET
	
/courses
	
courses.index
	
عرض قائمة الكورسات
GET
	
/courses/create
	
courses.create
	
فورم إضافة كورس
POST
	
/courses
	
courses.store
	
حفظ كورس جديد
GET
	
/courses/{id}
	
courses.show
	
عرض تفاصيل كورس
GET
	
/courses/{id}/edit
	
courses.edit
	
فورم تعديل كورس
PUT
	
/courses/{id}
	
courses.update
	
حفظ التعديلات
DELETE
	
/courses/{id}
	
courses.destroy
	
حذف كورس
التدريبات:
Method
	
URL
	
الاسم
	
الوصف
GET
	
/trainings
	
trainings.index
	
عرض قائمة التدريبات
GET
	
/trainings/create
	
trainings.create
	
فورم إضافة تدريب
POST
	
/trainings
	
trainings.store
	
حفظ تدريب جديد
PUT
	
/trainings/{id}
	
trainings.update
	
حفظ التعديلات
DELETE
	
/trainings/{id}
	
trainings.destroy
	
حذف تدريب
الدول والوجهات:
Method
	
URL
	
الاسم
	
الوصف
GET
	
/countries
	
countries.index
	
عرض قائمة الدول
GET
	
/destinations
	
destinations.index
	
عرض قائمة الوجهات
