# CRM-API (Laravel 12)

CRM-API is a backend RESTful API built with **Laravel 12** and **PHP 8.2**. It provides endpoints to manage contact data, mark contacts as favorite, retrieve call logs, and log mock VoIP call activity.

This API is designed to work with:
- [crm-ui](https://github.com/DhandyF/crm-ui) (Frontend - Vue 2)
- [crm-db](https://github.com/DhandyF/crm-db) (Database - MySQL 8.0)

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
If you prefer using `docker-compose`:

1. **Start services**

    ```bash
    docker-compose up -d --build
    ```

2. **Stop services**

    ```bash
    docker-compose down
    ```

---

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

---

## 🧪 Testing

You can use Postman or curl to test endpoints manually.

Example:
```bash
curl http://localhost:8000/api/contacts
```

---

## 🧩 Running the Full CRM Stack in Docker
To run the entire CRM application including the frontend, backend, and database, follow this order:

### 1. Start the Database First (crm-db)
Go to your crm-db directory and run:
```bash
docker-compose up -d
```

### 2. Start the Laravel API (crm-api)
Go to your crm-api directory and run:
```bash
docker-compose up -d --build  # Run from this repo
```

### 3. Start the Vue Frontend (crm-ui)
Go to your crm-ui directory and run:
```bash
docker-compose up -d --build
```
___

## 📋 System Approach

### Overview
CRM system is builded into three independent services—crm-ui, crm-api, and crm-db —using Docker Compose to manage and isolate each service. This approach aligns with modern software engineering best practices, offering flexibility, scalability, and clean separation of concerns.

By adopting a microservices-inspired approach with Docker Compose, each service can be developed, tested, and deployed independently. This modular design not only accelerates development but also lays a solid foundation for building scalable, maintainable, and cloud-ready applications.

### 🔧 Service Breakdown
1. **crm-ui (Frontend)**
- Framework: Vue.js (v2)
- Role: Responsible for the user interface and client-side interaction.
- Deployment: Built and served via Docker using an Nginx container.
- Interaction: Makes API calls to crm-api using Axios.

2. **crm-api (Backend)**
- Framework: Laravel (v12)
- Role: Acts as the core API layer for business logic and data processing.
- Database Access: Connects to the crm-db MySQL instance.
- Endpoints: Exposes RESTful API routes (e.g., /api/contact) for consumption by the frontend.

3. **crm-db (Database)**
- Database Engine: MySQL 8.0
- Role: Persistent data storage for the application.
- Isolation: Runs as a separate container to maintain data portability and separation.

### ✅ The advantages of this approach
➕ **Modularity & Separation of Concerns**

- Each service runs in its own container, allowing independent development, testing, and scaling. For example:
    - You can update or rebuild the frontend (crm-ui) without affecting the API or database.
    - The backend (crm-api) can evolve or change technologies independently.

➕ **Network Isolation with Shared Communication**

- By connecting services to a shared Docker external network, inter-service communication is seamless (e.g., Laravel connects to the DB using DB_HOST=crm-db).

➕ **Scalability**
- This structure sets the foundation for future scalability. For example:
    - Deploying frontend via CDN or serverless.
    - Containerizing backend with auto-scaling in Kubernetes or Docker Swarm.
    - Replacing MySQL with another database without affecting other layers.
