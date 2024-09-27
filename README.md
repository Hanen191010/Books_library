▎مشروع إدارة الكتب والفئات باستخدام Laravel API

هذا المشروع هو نظام API لإدارة الكتب والفئات باستخدام إطار العمل Laravel. يتيح النظام إدارة الكتب والفئات، بالإضافة إلى إدارة المستخدمين والأدوار والصلاحيات. كل كتاب ينتمي إلى فئة معينة، ويجب أن يتمتع المستخدمون بامتيازات محددة لإجراء عمليات معينة.

▎المميزات

- إدارة الكتب:
  - إضافة كتاب (POST)
  - تعديل بيانات كتاب (PUT/PATCH)
  - حذف كتاب (DELETE)
  - عرض قائمة الكتب (GET)
  - إضافة كتاب مع تحديد الفئة التي ينتمي إليها
  - عرض قائمة الكتب حسب الفئة
  - تعديل بيانات كتاب وفئته

- إدارة الفئات:
  - إضافة فئة جديدة (POST)
  - تعديل بيانات فئة (PUT/PATCH)
  - حذف فئة (DELETE)
  - عرض قائمة الفئات (GET)

- إدارة المستخدمين:
  - إضافة مستخدم جديد مع تحديد دوره وصلاحياته
  - تعديل بيانات مستخدم، دوره وصلاحياته
  - عرض قائمة المستخدمين مع أدوارهم وصلاحياتهم
  - حذف مستخدم

- إدارة الأدوار والصلاحيات:
  - إنشاء أدوار وصلاحيات جديدة
  - ربط صلاحيات معينة بدور محدد
  - السماح فقط للمستخدمين المصرح لهم بإجراء عمليات معينة بناءً على الصلاحيات الممنوحة لهم

▎الصلاحيات الموجودة

- manage-books: لادارة كل ما يخص الكتب من إضافة وحذف وتعديل وعرض كتاب وقائمة الكتب.
- manage-categories: لادارة كل ما يخص الفئات من إضافة وحذف وتعديل وعرض فئة وقائمة الفئات.

▎المتطلبات

- PHP >= 7.3
- Composer
- Laravel >= 8.x
- قاعدة بيانات (MySQL أو SQLite)

▎إعداد المشروع

1. استنساخ المشروع:
      git clone https://github.com/Hanen191010/Books_library.git
   cd Books_library
   

2. تثبيت الاعتماديات:
      composer install
   

3. إعداد ملف البيئة:
   نسخ ملف .env.example إلى .env وتحديث إعدادات قاعدة البيانات:
      cp .env.example .env
   

4. توليد مفتاح التطبيق:
      php artisan key:generate
   

5. تشغيل المهاجرات:
      php artisan migrate
   

6. تشغيل الخادم المحلي:
      php artisan serve
   

▎استخدام API

يمكنك استخدام أدوات مثل Postman لاختبار API. النقاط النهائية الأساسية هي:

- كتب:
  - POST /api/books
  - PUT /api/books/{id}
  - DELETE /api/books/{id}
  - GET /api/books
  - GET /api/categories/{categoryId}/books

- فئات:
  - POST /api/categories
  - PUT /api/categories/{id}
  - DELETE /api/categories/{id}
  - GET /api/categories

- مستخدمون:
  - POST /api/users
  - PUT /api/users/{id}
  - DELETE /api/users/{id}
  - GET /api/users

- أدوار :
  - POST /api/roles
  - PUT /api/roles/{id}
  - DELETE /api/roles/{id}
  - GET /api/roles

- الصلاحيات:
  - POST /api/permissions
  - PUT /api/permissions/{id}
  - DELETE /api/permissions/{id}
  - GET /api/permissions
  - POST /api/roles/{roleid}/permissions

