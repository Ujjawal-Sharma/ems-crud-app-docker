# Employee CRUD APIs

This project is set up using Docker Compose to manage its containers. Below are instructions on how to run and manage the containers using Docker Compose.

## Prerequisites

Make sure you have Docker and Docker Compose installed on your machine.

- [Docker Installation](https://docs.docker.com/get-docker/)
- [Docker Compose Installation](https://docs.docker.com/compose/install/)

## Usage

### 1. Clone the Repository

```bash
git clone https://github.com/Ujjawal-Sharma/ems-crud-app-docker.git
cd ems-crud-app-docker
```

### 2. Build and Start Containers

```bash
docker-compose up -d
```

### 3. Accessing Services

- Web App: http://localhost:8080/index.php
- Database: http://localhost:3306

### 5. Stop and Remove Containers

```bash
docker-compose down
```
## API Requests

### 1. Get All Employees

```bash
curl http://localhost:8080/index.php?action=getAllEmployees
```

### 2. Get Employee by Id

```bash
curl http://localhost:8080/index.php?action=getEmployeeById&employeeId=<id>
```

### 3. Add Employee

```bash
curl -X POST -d "action=addEmployee&first_name=John&last_name=Doe&email=john.doe@example.com" http://localhost:8080/index.php
```

### 4. Update Employee

```bash
curl -X PUT -d "action=updateEmployee&employeeId=1&first_name=UpdatedJohn&last_name=UpdatedDoe&email=updated.john.doe@example.com" http://localhost:8080/index.php
```

### 4. Delete Employee

```bash
curl -X DELETE -d "action=deleteEmployee&employeeId=1" http://localhost:8080/index.php
```
