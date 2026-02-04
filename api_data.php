<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}
require_once 'lidhja.php';

$type = $_GET['type'] ?? 'employees';
$search = $_GET['search'] ?? '';

$allowed_types = ['employees', 'departments', 'countries'];
if (!in_array($type, $allowed_types)) {
    echo json_encode(['error' => 'Invalid type']);
    exit();
}

$query = "";
if ($type == 'employees') {
    $query = "SELECT EMPLOYEE_ID as id, FIRST_NAME as field1, LAST_NAME as field2, EMAIL as field3 FROM employees";
    if ($search) {
        $query .= " WHERE FIRST_NAME LIKE '%$search%' OR LAST_NAME LIKE '%$search%'";
    }
} elseif ($type == 'departments') {
    $query = "SELECT DEPARTMENT_ID as id, DEPARTMENT_NAME as field1, MANAGER_ID as field2, LOCATION_ID as field3 FROM departments";
    if ($search) {
        $query .= " WHERE DEPARTMENT_NAME LIKE '%$search%'";
    }
} elseif ($type == 'countries') {
    $query = "SELECT COUNTRY_ID as id, COUNTRY_NAME as field1, REGION_ID as field2, '' as field3 FROM countries";
    if ($search) {
        $query .= " WHERE COUNTRY_NAME LIKE '%$search%'";
    }
}

$result = $lidhja->query($query);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>