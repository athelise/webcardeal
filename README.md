# Веб сайт Автосалон «Мир Тазиков»

## Описание проекта
Веб-сайт автосалона "Мир Тазиков" представляет собой полнофункциональную платформу для просмотра автомобилей, записи на тест-драйв и управления личным кабинетом. Сайт разработан с использованием PHP, MySQL и современных веб-технологий.

## Структура проекта
```
webcardeal/
├── actions/           # PHP скрипты для обработки действий
├── excel_docs/        # Excel документы для тест-драйвов
├── html/             # HTML шаблоны
├── scripts/          # JavaScript файлы
├── src/              # Статические ресурсы (иконки, изображения)
├── styles/           # CSS стили
└── vendor/           # Зависимости проекта
```

### Основные файлы и их назначение
- `index.php` - Главная страница сайта
- `index_auth.php` - Главная страница для авторизованных пользователей
- `account.php` - Личный кабинет пользователя
- `drive.php` - Страница записи на тест-драйв
- `auth.php` - Страница авторизации
- `register.php` - Страница регистрации

## База данных
База данных называется `shop` и содержит следующие таблицы:

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

## Функциональность
1. Регистрация и авторизация пользователей
2. Просмотр каталога автомобилей
3. Запись на тест-драйв
4. Личный кабинет с информацией о пользователе и истории тест-драйвов
5. Автоматическое создание Excel-отчетов по тест-драйвам
6. Управление сессиями и cookies для сохранения состояния авторизации