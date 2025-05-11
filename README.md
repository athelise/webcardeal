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

## Технический стек
- **Backend**: PHP
- **Frontend**: HTML5, CSS3, JavaScript
- **База данных**: MySQL
- **Дополнительные технологии**:
  - PHPSpreadsheet для работы с Excel

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