# Веб сайт Автосалон «Мир Тазиков»

## Описание проекта
Веб-сайт автосалона "Мир Тазиков" представляет собой полнофункциональную платформу для просмотра автомобилей, записи на тест-драйв и управления личным кабинетом. Сайт разработан с использованием PHP, MySQL и современных веб-технологий.

### Основные возможности
- Регистрация и авторизация пользователей
- Просмотр каталога автомобилей с фильтрацией по категориям
- Запись на тест-драйв
- Личный кабинет пользователя
- Автоматическая генерация Excel-отчетов
- Управление сессиями и cookies
- Контактная форма с сохранением сообщений
- Адаптивный дизайн

## Структура проекта
```
webcardeal/
├── actions/                 # Обработчики форм и действий
│   ├── auth_users.php      # Авторизация пользователей
│   ├── login_process.php   # Обработка входа
│   ├── logout.php          # Выход из системы
│   ├── register_process.php # Обработка регистрации
│   ├── save_drive.php      # Сохранение записи на тест-драйв
│   └── submit_contact.php  # Обработка контактной формы
├── html/                   # HTML шаблоны
│   ├── index.html         # Главная страница
│   ├── index_auth.html    # Главная страница для авторизованных
│   └── footer.html        # Подвал сайта
├── scripts/               # JavaScript файлы
├── src/                   # Статические ресурсы
│   ├── icons/            # Иконки
│   └── images/           # Изображения
├── styles/               # CSS стили
├── vendor/              # Зависимости Composer
├── excel_docs/          # Генерируемые Excel файлы
├── account.php          # Личный кабинет
├── auth.php            # Страница авторизации
├── catalog.php         # Каталог автомобилей
├── drive.php           # Запись на тест-драйв
├── index.php           # Главная страница
├── index_auth.php      # Главная для авторизованных
├── register.php        # Страница регистрации
└── success_drive.php   # Страница успешной записи
```

## Управление сессиями
Проект использует PHP сессии для управления состоянием пользователя. Структура сессии:

```php
$_SESSION['user'] = [
    'id' => $user_id,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email
];
```

### Особенности реализации сессий:
- Сессии стартуют в начале каждого PHP файла через `session_start()`
- Проверка авторизации: `isset($_SESSION['user'])`
- Доступ к данным пользователя: `$_SESSION['user']['field_name']`
- При выходе: полная очистка сессии и cookies
- Cookies для "запомнить меня" (30 дней)

## База данных
### Структура таблиц:

1. **users**
   - id (PRIMARY KEY)
   - first_name
   - last_name
   - email (UNIQUE)
   - phone
   - password (hashed)

2. **cars**
   - id (PRIMARY KEY)
   - brand
   - model
   - price
   - photo_url
   - class

3. **test_drives**
   - id (PRIMARY KEY)
   - user_id (FOREIGN KEY)
   - brand
   - model
   - booking_date
   - booking_time
   - status

4. **contact_messages**
   - id (PRIMARY KEY)
   - user_id (FOREIGN KEY)
   - name
   - email
   - message
   - created_at

## Безопасность
- Все пароли хешируются с использованием `password_hash()`
- Защита от SQL-инъекций через подготовленные запросы
- Экранирование вывода через `htmlspecialchars()`
- Валидация входных данных
- Защита от XSS-атак
- Безопасное управление сессиями

## Технический стек
- **Backend**: PHP 8.0+
- **Frontend**: HTML5, CSS3, JavaScript
- **База данных**: MySQL 8.0
- **Дополнительные технологии**:
  - PHPSpreadsheet для работы с Excel
  - Composer для управления зависимостями

## Установка и настройка окружения

### Windows

1. **Установка PHP**:
   - Скачайте PHP 8.0 или выше с [официального сайта](https://windows.php.net/download/)
   - Распакуйте архив в `C:\php`
   - Настройка системных путей:
     ```batch
     # Откройте "Система" -> "Дополнительные параметры системы" -> "Переменные среды"
     # В разделе "Системные переменные" найдите PATH и добавьте:
     C:\php
     C:\php\ext
     ```
   - Альтернативный способ через командную строку (требуются права администратора):
     ```batch
     setx PATH "%PATH%;C:\php;C:\php\ext" /M
     ```
   - Скопируйте `php.ini-development` в `php.ini`
   - В `php.ini` раскомментируйте строки:
     ```ini
     extension=mysqli
     extension=pdo_mysql
     extension=openssl
     extension=fileinfo
     extension=mbstring
     extension=exif
     extension=gd
     ```

2. **Установка MySQL**:
   - Скачайте MySQL 8.0 с [официального сайта](https://dev.mysql.com/downloads/installer/)
   - Запустите установщик и следуйте инструкциям
   - При настройке root пароля:
     ```sql
     # После установки MySQL, откройте командную строку MySQL:
     mysql -u root -p
     # Если пароль не установлен, нажмите Enter
     
     # Установите новый пароль:
     ALTER USER 'root'@'localhost' IDENTIFIED BY 'Aicberg1337!_Aicberg1337!';
     FLUSH PRIVILEGES;
     ```
   - Убедитесь, что служба MySQL запущена:
     ```batch
     # Проверка статуса службы
     sc query MySQL80
     
     # Запуск службы если не запущена
     net start MySQL80
     ```

3. **Установка Composer**:
   - Скачайте установщик с [getcomposer.org](https://getcomposer.org/download/)
   - Запустите установщик и следуйте инструкциям
   - Проверьте установку: `composer --version`

4. **Установка PHPSpreadsheet**:
   ```bash
   composer require phpoffice/phpspreadsheet
   ```

### Linux (Ubuntu/Debian)

1. **Установка PHP**:
   ```bash
   sudo apt update
   sudo apt install php8.0 php8.0-mysql php8.0-mbstring php8.0-xml php8.0-zip
   ```

2. **Установка MySQL**:
   ```bash
   sudo apt install mysql-server
   sudo mysql_secure_installation
   # Установите пароль root: Aicberg1337!_Aicberg1337!
   ```

3. **Установка Composer**:
   ```bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
   rm composer-setup.php
   ```

4. **Установка PHPSpreadsheet**:
   ```bash
   composer require phpoffice/phpspreadsheet
   ```

### Linux (Fedora)

1. **Установка PHP**:
   ```bash
   sudo dnf update
   sudo dnf install php php-mysqlnd php-mbstring php-xml php-zip
   ```

2. **Установка MySQL**:
   ```bash
   sudo dnf install mysql-server
   sudo systemctl start mysqld
   sudo systemctl enable mysqld
   
   # Получение временного пароля
   sudo grep 'temporary password' /var/log/mysqld.log
   
   # Установка нового пароля
   mysql -u root -p
   # Введите временный пароль из предыдущего шага
   
   # В MySQL выполните:
   ALTER USER 'root'@'localhost' IDENTIFIED BY 'Aicberg1337!_Aicberg1337!';
   FLUSH PRIVILEGES;
   ```

3. **Установка Composer**:
   ```bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
   rm composer-setup.php
   ```

4. **Установка PHPSpreadsheet**:
   ```bash
   composer require phpoffice/phpspreadsheet
   ```

## Запуск локального сервера

### Windows

1. **Запуск PHP сервера**:
   ```batch
   # Перейдите в корневую директорию проекта
   cd path\to\webcardeal
   
   # Запустите PHP сервер
   php -S localhost:8000
   ```

2. **Проверка работы сервера**:
   - Откройте браузер
   - Перейдите по адресу: `http://localhost:8000`
   - Должна отобразиться главная страница сайта

### Linux (Ubuntu/Debian/Fedora)

1. **Запуск PHP сервера**:
   ```bash
   # Перейдите в корневую директорию проекта
   cd /path/to/webcardeal
   
   # Запустите PHP сервер
   php -S localhost:8000
   ```

2. **Проверка работы сервера**:
   - Откройте браузер
   - Перейдите по адресу: `http://localhost:8000`
   - Должна отобразиться главная страница сайта

## Дополнительные настройки

### Настройка виртуального хоста
Создайте файл `php.ini` в корневой директории проекта:
```ini
display_errors = On
error_reporting = E_ALL
memory_limit = 256M
max_execution_time = 300
post_max_size = 64M
upload_max_filesize = 64M
```

2. **Настройка прав доступа**:
   ```bash
   # Linux
   sudo chown -R www-data:www-data /path/to/webcardeal
   sudo chmod -R 755 /path/to/webcardeal
   
   # Windows (в PowerShell с правами администратора)
   icacls "C:\path\to\webcardeal" /grant "IUSR:(OI)(CI)(RX)" /T
   ```

3. **Проверка логов**:
   - Windows: `C:\php\logs\php_error.log`
   - Linux: `/var/log/apache2/error.log` или `/var/log/nginx/error.log`

## Проверка установки

После установки всех компонентов, выполните следующие команды для проверки:

```bash
# Проверка версии PHP
php -v

# Проверка версии MySQL
mysql --version

# Проверка версии Composer
composer --version

# Проверка подключения к MySQL
mysql -u root -p
# Введите пароль: Aicberg1337!_Aicberg1337!
```

## Настройка XAMPP и Apache

### Установка XAMPP

1. **Скачивание и установка**:
   - Скачайте XAMPP с [официального сайта](https://www.apachefriends.org/download.html)
   - Выберите версию с PHP 8.0 или выше
   - Запустите установщик от имени администратора
   - Выберите компоненты:
     - Apache
     - MySQL
     - PHP
     - phpMyAdmin
   - Установите в директорию по умолчанию:
     - Windows: `C:\xampp`
     - Linux: `/opt/lampp`
     - macOS: `/Applications/XAMPP`

2. **Запуск XAMPP Control Panel**:
   - Windows: Запустите `xampp-control.exe`
   - Linux: `sudo /opt/lampp/lampp start`
   - macOS: Запустите XAMPP из Applications

3. **Проверка установки**:
   - Откройте браузер
   - Перейдите по адресу: `http://localhost`
   - Должна отобразиться страница приветствия XAMPP

### Настройка Apache

1. **Базовая конфигурация**:
   - Откройте файл `httpd.conf`:
     - Windows: `C:\xampp\apache\conf\httpd.conf`
     - Linux: `/opt/lampp/etc/httpd.conf`
     - macOS: `/Applications/XAMPP/etc/httpd.conf`
   - Убедитесь, что следующие модули раскомментированы:
     ```apache
     LoadModule rewrite_module modules/mod_rewrite.so
     LoadModule headers_module modules/mod_headers.so
     LoadModule ssl_module modules/mod_ssl.so
     ```

2. **Настройка виртуального хоста**:
   - Откройте файл `httpd-vhosts.conf`:
     - Windows: `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
     - Linux: `/opt/lampp/etc/extra/httpd-vhosts.conf`
     - macOS: `/Applications/XAMPP/etc/extra/httpd-vhosts.conf`
   - Добавьте конфигурацию:
     ```apache
     <VirtualHost *:80>
         DocumentRoot "C:/xampp/htdocs/webcardeal"
         ServerName webcardeal.local
         <Directory "C:/xampp/htdocs/webcardeal">
             Options Indexes FollowSymLinks MultiViews
             AllowOverride All
             Require all granted
         </Directory>
     </VirtualHost>
     ```

3. **Настройка hosts файла**:
   - Windows: `C:\Windows\System32\drivers\etc\hosts`
   - Linux/macOS: `/etc/hosts`
   - Добавьте строку:
     ```
     127.0.0.1 webcardeal.local
     ```

4. **Настройка .htaccess**:
   - Создайте файл `.htaccess` в корневой директории проекта:
     ```apache
     Options -Indexes
     RewriteEngine On
     RewriteBase /webcardeal/
     
     # Перенаправление на HTTPS
     RewriteCond %{HTTPS} off
     RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
     
     # Защита файлов
     <FilesMatch "^\.">
         Order allow,deny
         Deny from all
     </FilesMatch>
     
     # Настройка PHP
     php_value upload_max_filesize 64M
     php_value post_max_size 64M
     php_value max_execution_time 300
     php_value max_input_time 300
     ```

### Часто встречающиеся проблемы и их решения

1. **Порт 80 занят**:
   - Проверьте, не запущен ли другой веб-сервер:
     ```bash
     # Windows
     netstat -ano | findstr :80
     
     # Linux/macOS
     sudo lsof -i :80
     ```
   - Измените порт Apache в `httpd.conf`:
     ```apache
     Listen 8080
     ```

2. **Ошибка доступа к директории**:
   - Проверьте права доступа:
     ```bash
     # Linux/macOS
     sudo chown -R daemon:daemon /opt/lampp/htdocs/webcardeal
     sudo chmod -R 755 /opt/lampp/htdocs/webcardeal
     
     # Windows (PowerShell с правами администратора)
     icacls "C:\xampp\htdocs\webcardeal" /grant "IUSR:(OI)(CI)(RX)" /T
     ```

3. **Ошибка mod_rewrite**:
   - Убедитесь, что модуль включен:
     ```apache
     LoadModule rewrite_module modules/mod_rewrite.so
     ```
   - Проверьте конфигурацию в .htaccess:
     ```apache
     RewriteEngine On
     RewriteBase /webcardeal/
     ```

4. **Проблемы с SSL**:
   - Создайте самоподписанный сертификат:
     ```bash
     # Windows
     cd C:\xampp\apache\makecert
     makecert -r -pe -n "CN=localhost" -b 01/01/2020 -e 01/01/2030 -eku 1.3.6.1.5.5.7.3.1 -ss my -sr localMachine -sky exchange -sp "Microsoft RSA SChannel Cryptographic Provider" -sy 12
     
     # Linux/macOS
     sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /opt/lampp/etc/ssl.key/server.key -out /opt/lampp/etc/ssl.crt/server.crt
     ```

5. **Проблемы с PHP**:
   - Проверьте версию PHP:
     ```bash
     php -v
     ```
   - Убедитесь, что все расширения включены в `php.ini`:
     ```ini
     extension=mysqli
     extension=pdo_mysql
     extension=openssl
     extension=fileinfo
     extension=mbstring
     extension=exif
     extension=gd
     ```

### Дополнительные настройки безопасности

1. **Защита директории**:
   - Создайте файл `.htpasswd`:
     ```bash
     # Windows
     C:\xampp\apache\bin\htpasswd -c C:\xampp\apache\conf\.htpasswd admin
     
     # Linux/macOS
     /opt/lampp/bin/htpasswd -c /opt/lampp/apache/conf/.htpasswd admin
     ```
   - Добавьте в `.htaccess`:
     ```apache
     AuthType Basic
     AuthName "Restricted Area"
     AuthUserFile /path/to/.htpasswd
     Require valid-user
     ```

2. **Настройка SSL**:
   - Включите SSL в `httpd.conf`:
     ```apache
     LoadModule ssl_module modules/mod_ssl.so
     ```
   - Добавьте виртуальный хост для HTTPS:
     ```apache
     <VirtualHost *:443>
         DocumentRoot "C:/xampp/htdocs/webcardeal"
         ServerName webcardeal.local
         SSLEngine on
         SSLCertificateFile "conf/ssl.crt/server.crt"
         SSLCertificateKeyFile "conf/ssl.key/server.key"
     </VirtualHost>
     ```

3. **Настройка кэширования**:
   - Добавьте в `.htaccess`:
     ```apache
     <IfModule mod_expires.c>
         ExpiresActive On
         ExpiresByType image/jpg "access plus 1 year"
         ExpiresByType image/jpeg "access plus 1 year"
         ExpiresByType image/gif "access plus 1 year"
         ExpiresByType image/png "access plus 1 year"
         ExpiresByType text/css "access plus 1 month"
         ExpiresByType application/javascript "access plus 1 month"
     </IfModule>
     ```

### Мониторинг и логирование

1. **Настройка логов**:
   - Проверьте конфигурацию в `httpd.conf`:
     ```apache
     ErrorLog "logs/error.log"
     CustomLog "logs/access.log" combined
     ```
   - Настройте ротацию логов:
     ```apache
     CustomLog "|bin/rotatelogs.exe logs/access_%Y%m%d.log 86400" combined
     ErrorLog "|bin/rotatelogs.exe logs/error_%Y%m%d.log 86400"
     ```

2. **Мониторинг производительности**:
   - Включите mod_status в `httpd.conf`:
     ```apache
     LoadModule status_module modules/mod_status.so
     ```
   - Добавьте конфигурацию:
     ```apache
     <Location /server-status>
         SetHandler server-status
         Require local
     </Location>
     ```
     
## Структура проекта
```
webcardeal/
├── actions/           # PHP скрипты для обработки действий
│   ├── auth_users.php
│   ├── login_process.php
│   ├── logout.php
│   ├── register_process.php
│   ├── save_drive.php
│   └── save_new_user.php
├── excel_docs/        # Excel документы для тест-драйвов
├── fonts/            # Шрифты
├── html/             # HTML шаблоны
├── scripts/          # JavaScript файлы
│   ├── auth.js
│   ├── catalog.js
│   ├── drive.js
│   ├── index.js
│   ├── index_auth.js
│   ├── register.js
│   └── success_drive.js
├── src/              # Статические ресурсы
├── styles/           # CSS стили
├── vendor/           # Зависимости проекта
├── account.php       # Личный кабинет
├── auth.php          # Страница авторизации
├── catalog.php       # Каталог автомобилей
├── composer.json     # Конфигурация Composer
├── composer.lock     # Зависимости Composer
├── drive.php         # Страница тест-драйва
├── index.php         # Главная страница
├── index_auth.php    # Главная страница для авторизованных пользователей
├── register.php      # Страница регистрации
└── success_drive.php # Страница подтверждения записи на тест-драйв
```

### Основные файлы и их назначение
- `index.php` - Главная страница сайта
- `index_auth.php` - Главная страница для авторизованных пользователей
- `account.php` - Личный кабинет пользователя
- `drive.php` - Страница записи на тест-драйв
- `auth.php` - Страница авторизации
- `register.php` - Страница регистрации
- `catalog.php` - Каталог автомобилей
- `success_drive.php` - Страница подтверждения записи на тест-драйв

## База данных
База данных называется `shop` и требует MySQL версии 8.0 или выше. Для корректной работы проекта необходимо иметь права root с паролем `Aicberg1337!_Aicberg1337!`.

### Настройка базы данных
1. Убедитесь, что у вас установлен MySQL 8.0+
2. Войдите в MySQL с правами root:
```bash
mysql -u root -p
# Введите пароль: Aicberg1337!_Aicberg1337!
```
3. Создайте базу данных:
```sql
CREATE DATABASE shop;
USE shop;
```

### Требования к базе данных
- MySQL версия: 8.0 или выше
- Кодировка: utf8mb4
- Сортировка: utf8mb4_unicode_ci
- Требуемые права: root
- Пароль для доступа: Aicberg1337!_Aicberg1337!

Данная база данных содержит следующие таблицы:

### Таблица users
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
);
```
**Описание полей:**
- `id`: Уникальный идентификатор пользователя
- `first_name`: Имя пользователя
- `last_name`: Фамилия пользователя
- `email`: Email пользователя (уникальный)
- `phone`: Номер телефона
- `password`: Хешированный пароль

### Таблица employees
```sql
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    position VARCHAR(100) NOT NULL,
    description TEXT,
    photo_url VARCHAR(255)
);
```
**Описание полей:**
- `id`: Уникальный идентификатор сотрудника
- `first_name`: Имя сотрудника
- `last_name`: Фамилия сотрудника
- `position`: Должность
- `description`: Описание обязанностей
- `photo_url`: Путь к фотографии

### Таблица cars
```sql
CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    class VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    photo_url VARCHAR(255)
);
```
**Описание полей:**
- `id`: Уникальный идентификатор автомобиля
- `brand`: Марка автомобиля
- `model`: Модель автомобиля
- `class`: Класс автомобиля (SUV, Sedan и т.д.)
- `price`: Цена в долларах
- `photo_url`: Путь к фотографии

### Таблица test_drives
```sql
CREATE TABLE test_drives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```
**Описание полей:**
- `id`: Уникальный идентификатор записи
- `user_id`: ID пользователя (внешний ключ)
- `brand`: Марка автомобиля
- `model`: Модель автомобиля
- `booking_date`: Дата тест-драйва
- `booking_time`: Время тест-драйва
- `status`: Статус записи
- `created_at`: Дата создания записи

## Примеры данных

### Создание сотрудников
```sql
INSERT INTO employees (first_name, last_name, position, description, photo_url) VALUES
('Алексей', 'Иванов', 'Директор', 'Руководитель компании, отвечает за стратегическое развитие.', 'https://example.com/photo1.jpg'),
('Мария', 'Петрова', 'Администратор', 'Управляет офисом и координирует работу сотрудников.', 'https://example.com/photo2.jpg'),
('Иван', 'Сидоров', 'Бухгалтер', 'Отвечает за финансовые операции и отчетность.', 'https://example.com/photo3.jpg'),
('Анна', 'Кузнецова', 'Пиар менеджер', 'Отвечает за связи с общественностью и маркетинг.', 'https://example.com/photo4.jpg'),
('Ольга', 'Смирнова', 'Менеджер по продажам', 'Работает с клиентами и увеличивает продажи.', 'https://example.com/photo5.jpg'),
('Дмитрий', 'Васильев', 'Менеджер по продажам', 'Развивает клиентскую базу и увеличивает объем продаж.', 'https://example.com/photo6.jpg'),
('Елена', 'Новикова', 'Менеджер по продажам', 'Занимается продвижением продуктов и услуг.', 'https://example.com/photo7.jpg'),
('Сергей', 'Морозов', 'Главный механик', 'Руководит механическим отделом и обслуживанием оборудования.', 'https://example.com/photo8.jpg'),
('Андрей', 'Волков', 'Механик', 'Обслуживает и ремонтирует оборудование.', 'https://example.com/photo9.jpg'),
('Наталья', 'Козлова', 'Механик', 'Занимается техническим обслуживанием.', 'https://example.com/photo10.jpg'),
('Ирина', 'Лебедева', 'Уборщица', 'Поддерживает чистоту в офисе.', 'https://example.com/photo11.jpg'),
('Алексей', 'Соколов', 'Уборщик', 'Отвечает за уборку производственных помещений.', 'https://example.com/photo12.jpg'),
('Виктор', 'Попов', 'Техник', 'Обслуживает электрические системы.', 'https://example.com/photo13.jpg'),
('Юлия', 'Михайлова', 'Техник', 'Занимается ремонтом и обслуживанием оборудования.', 'https://example.com/photo14.jpg');
```

### Создание машин
```sql
INSERT INTO cars (brand, model, class, price, photo_url) VALUES
('BMW', 'X5', 'SUV', 75000.00, 'https://example.com/bmw_x5.jpg'),
('BMW', '3 Series', 'Sedan', 45000.00, 'https://example.com/bmw_3_series.jpg'),
('Mercedes', 'GLE', 'SUV', 80000.00, 'https://example.com/mercedes_gle.jpg'),
('Mercedes', 'C-Class', 'Sedan', 50000.00, 'https://example.com/mercedes_c_class.jpg'),
('Audi', 'Q7', 'SUV', 70000.00, 'https://example.com/audi_q7.jpg'),
('Audi', 'A4', 'Sedan', 40000.00, 'https://example.com/audi_a4.jpg');
```

### Создание тест-драйвов
```sql
INSERT INTO drive (brand, model, photo_url) VALUES
('Kia', 'Sportage', 'https://example.com/kia_sportage.jpg'),
('Hyundai', 'Tucson', 'https://example.com/hyundai_tucson.jpg'),
('Toyota', 'RAV4', 'https://example.com/toyota_rav4.jpg');
```

## Заключение

Разработка веб-сайта автосалона "Мир Тазиков" стала интересным и познавательным опытом. В процессе создания проекта пришлось столкнуться с различными техническими вызовами и задачами:

- Реализация системы авторизации и регистрации потребовала тщательного изучения механизмов безопасности и хеширования паролей
- Разработка каталога автомобилей с фильтрацией по категориям потребовала оптимизации SQL-запросов и структуры базы данных
- Интеграция системы записи на тест-драйв с генерацией Excel-отчетов потребовала изучения работы с PHPSpreadsheet
- Реализация управления сессиями и cookies потребовала глубокого понимания механизмов работы веб-приложений

Каждый этап разработки приносил новые знания и опыт, что позволило не только создать функциональный веб-сайт, но и значительно улучшить навыки в области веб-разработки. Хотя проект может быть доработан в будущем для совершенствования навыков, в процессе его создания пришло понимание, что веб-разработка, возможно, не является тем направлением, в котором хотелось бы развиваться профессионально. Тем не менее, этот опыт оказался ценным для общего понимания принципов разработки программного обеспечения и работы с базами данных.