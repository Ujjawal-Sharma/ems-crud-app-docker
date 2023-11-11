<?php

function queryDb($queryToExec) {
    // [Existing code for database connection]

    $servername = "mysql";
    $username = "root";
    $password = "root_password";
    $dbname = "test_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

   // echo "Connected to MySQL successfully";
    $result = $conn->query($queryToExec);
    $conn->close();
    return $result;
}

function getAllEmployees() {
    $query = "SELECT * FROM employee";
    $result = queryDb($query);

    if ($result->num_rows > 0) {
        $employees = array();
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        return json_encode($employees);
    } else {
        return json_encode([]);
    }
}

function getEmployeeById($employeeId) {
    $query = "SELECT * FROM employee WHERE id = $employeeId";
    $result = queryDb($query);

    if ($result->num_rows > 0) {
        return json_encode($result->fetch_assoc());
    } else {
        return json_encode([]);
    }
}

function addEmployee($first_name, $last_name, $email) {
    $query = "INSERT INTO employee (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";
    return json_encode(queryDb($query));
}

function updateEmployee($employeeId, $first_name, $last_name, $email) {
    $query = "UPDATE employee SET first_name='$first_name', last_name='$last_name', email='$email' WHERE id = $employeeId";
    return json_encode(queryDb($query));
}

function deleteEmployee($employeeId) {
    $query = "DELETE FROM employee WHERE id = $employeeId";
    return json_encode(queryDb($query));
}

// Define routes for CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['action'] === 'getAllEmployees') {
        echo getAllEmployees();
    } elseif ($_GET['action'] === 'getEmployeeById') {
        $employeeId = $_GET['employeeId'];
        echo getEmployeeById($employeeId);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'addEmployee') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        echo addEmployee($first_name, $last_name, $email);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $putParams);
    if ($putParams['action'] === 'updateEmployee') {
        $employeeId = $putParams['employeeId'];
        $first_name = $putParams['first_name'];
        $last_name = $putParams['last_name'];
        $email = $putParams['email'];
        echo updateEmployee($employeeId, $first_name, $last_name, $email);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteParams);
    if ($deleteParams['action'] === 'deleteEmployee') {
        $employeeId = $deleteParams['employeeId'];
        echo deleteEmployee($employeeId);
    }
}
?>

