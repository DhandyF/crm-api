# CRM-API (Laravel 12)

CRM-API is a backend RESTful API built with **Laravel 12** and **PHP 8.2**. It provides endpoints to manage contact data, mark contacts as favorite, retrieve call logs, and log mock VoIP call activity.

This API is designed to work with the companion [CRM-UI frontend](https://github.com/DhandyF/crm-ui) built in Vue.js.

---

## 📋 Features

- Retrieve contact list
- Filter contacts by name, company, or role
- Mark/unmark contact as favorite
- Get call logs
- Add new call logs (simulated VoIP)

---

## ⚙️ Requirements

- PHP 8.2
- Composer
- MySQL (or compatible DB)
- Laravel CLI
- Node.js (for optional asset build)
- Docker + Docker Compose (optional for containerized setup)

---

## 🚀 Getting Started (Local)

1. **Clone the Repository**

    ```bash
    git clone https://github.com/DhandyF/crm-api.git
    cd crm-api
    ```

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Generate App Key**

    ```bash
    php artisan key:generate
    ```

4. **Run Migrations**

    ```bash
    php artisan migrate
    ```

5. **Start the Server**

    ```bash
    php artisan serve
    ```

API will be available at:
http://localhost:8000/api

---

## 🐳 Docker Setup
If you prefer using Docker:

**Using Docker Compose**

1. **Start services**

    ```bash
    docker-compose up -d --build
    ```

2. **Stop services**

    ```bash
    docker-compose down
    ```

## 🔌 API Endpoints

Base URL: http://localhost:8000/api

### Contact
| Method | Endpoint                  | Description                |
| ------ | ------------------------- | -------------------------- |
| GET    | `/contacts`               | Get all contacts           |
| GET    | `/contacts?`              | Filter contacts by keyword |
| PUP    | `/contacts/{id}/`         | Toggle favorite status     |

### Call Logs
| Method | Endpoint     | Description                          |
| ------ | ------------ | ------------------------------------ |
| GET    | `/log`.      | Get all call logs                    |
| POST   | `/log`.      | Add a new call log (VoIP simulation) |

Example request body for creating a call log:
```json
{
  "name": "John Doe",
  "phone": "+62 812-3456-7890",
  "duration": 120,
  "timestamp": "2024-07-14T15:30:00",
  "status": "completed"
}
```

## 🧪 Testing

You can use Postman or curl to test endpoints manually.

Example:
```bash
curl http://localhost:8000/api/contacts
```
