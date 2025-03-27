# Tax Calculator

This is a modular and extensible tax calculator application built with Symfony.  
It is designed with Domain-Driven Design (DDD), a hexagonal architecture, and Command-Query Responsibility Segregation (CQRS).  
It supports dynamic tax band configuration and real-time salary breakdown computation.

## Features

- Compute annual and monthly gross/net/tax values
- Uses configurable tax bands (YAML or database)
- Hexagonal architecture with DDD principles
- Clear separation between read (Query) and write (Command) models
- REST API with GET endpoint
- Frontend built with Stimulus.js and Bootstrap 5
- Dockerized environment for consistent local development
- Unit and functional tests with PHPUnit

## Technologies Used

### Implementation

| Technology              | Purpose                                 |
|--------------------------|------------------------------------------|
| Symfony 7                | Main PHP framework                       |
| Doctrine ORM             | Database persistence                     |
| MySQL 8                  | Relational database                      |
| YAML                     | Tax band configuration file              |
| Docker / Docker Compose  | Containerization and service orchestration |
| Webpack Encore           | Asset compilation (JS/CSS)               |
| Stimulus.js              | Lightweight JavaScript frontend framework |
| Bootstrap 5              | Frontend styling and layout              |
| Makefile                 | Build and automation scripts             |

### Testing

| Tool                    | Purpose                                  |
|--------------------------|------------------------------------------|
| PHPUnit                 | Unit and functional tests                |
| Symfony Test Client     | Simulate HTTP requests in test context   |
| Custom bootstrap script | Manual loading of `.env` for test env    |

## Project Structure
```
src/
├── Application/ 
├── Command/ 
│ └── Query/ 
├── Domain/ 
│ ├── Model/ 
│ └── Repository/ 
├── Infrastructure/ 
│ ├── Controller/ 
│ ├── Doctrine/ 
│ └── Persistence/ tests/ 
├── Functional/ 
│ └── TaxApiTest.php 
├── bootstrap.php
```

## Installation

Run the full setup using:

```bash
make install
```
This command performs the following steps:

1. **Docker Build**  
   Builds the PHP, Nginx, and Node-based containers using the `Dockerfile` and `docker-compose.yml`.

2. **Container Startup**  
   Launches the containers in detached mode (`docker-compose up -d`), including:
   - PHP-FPM container (Symfony)
   - MySQL container (with default credentials)
   - Nginx container (serving the Symfony app on port 8080)

3. **PHP Dependencies Installation**  
   Runs `composer install` inside the PHP container to install all required Symfony components and libraries.

4. **JavaScript Dependencies Installation**  
   Uses `yarn install` to install frontend dependencies such as Bootstrap, Stimulus, and Webpack Encore.

5. **Asset Compilation**  
   Compiles assets using Webpack Encore: JavaScript, CSS (including Bootstrap), and Stimulus controllers.

6. **Database Migrations**  
   Executes Doctrine migrations to create or update the database schema using:
   ```bash
   php bin/console doctrine:migrations:migrate --no-interaction
    ```
7. **Run Tests**
   Executes all unit and functional tests via PHPUnit to ensure the system behaves as expected.
## Project Usage

After installation, you can access the application from your browser:

- **Frontend Interface**:  
  Accessible at [http://localhost:8080](http://localhost:8080)  
  This page includes a salary input form powered by Stimulus.js and styled with Bootstrap. It submits a get request to the backend and dynamically renders the results.

- **API Endpoints**:
  - `GET /api/tax/{salary}`  
    Returns a salary breakdown in JSON format based on the value in the URL.
  
  - `GET /healthcheck`  
    Basic endpoint to verify the application is running. Returns HTTP 200.

Example JSON response:
```json
{
  "gross_annual": 40000,
  "net_annual": 29000,
  "tax_annual": 11000,
  "gross_monthly": 3333.33,
  "net_monthly": 2416.67,
  "monthly_tax": 916.67,
  "tax_ratio": "27.5%"
}
```

### Workflow

1. `app.js` loads Bootstrap styles and registers the Stimulus controllers.
2. `tax_controller.js` listens to the form submission, sends a GET request, and displays the result dynamically.
3. The final JavaScript bundle is compiled by `yarn encore dev` and placed in `public/build`.

### Example: app.js

```javascript
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import { Application } from '@hotwired/stimulus';
import TaxController from './controllers/tax_controller';

const application = Application.start();
application.register('tax', TaxController);
```

## Testing Strategy

This project follows a layered testing approach, aligned with its hexagonal architecture. It includes both **unit tests** for domain logic and **functional tests** for HTTP endpoints.

### Test Structure
```
tests/
├── Functional/
│   └── TaxApiTest.php       # API tests using Symfony's WebTestCase
├── Unit/
│   └── SalaryBreakdownTest.php  # Pure domain logic
├── bootstrap.php            # Loads .env if needed
```

### Functional Tests

Located in tests/Functional/, these tests simulate real HTTP requests against the application using Symfony’s test client.

They validate:

  - Route configuration
  - Request/response formats
  - JSON structure
  - Integration with service layers and infrastructure

Run all tests:
```bash
make test
```

