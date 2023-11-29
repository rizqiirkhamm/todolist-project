<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "skl_todo_list";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("koneksi gagal" . $conn->connect_error);
};

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM tasks ORDER BY id DESC";
    $result = $conn->query($sql);

    $todos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $todos[] = $row;
        }
    }
    echo json_encode($todos);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $task = $data->task;

    $sql = "INSERT INTO tasks (task_name) VALUES ('$task')";
    $conn->query($sql);

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];

    $sql = "DELETE FROM tasks WHERE id = $id";
    $conn->query($sql);

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = $_GET["id"];
    $sql = "UPDATE tasks SET completed = NOT completed WHERE id = $id";
    $conn->query($sql);

}  if ($_SERVER['REQUEST_METHOD'] === 'DELETE1') {
    $sql = "DELETE FROM `tasks`";
    $conn->query($sql);
    
}  if ($_SERVER['REQUEST_METHOD'] === 'PUT1') {
    // Ambil status sebelumnya dari database
    $sqlGetPreviousStatus = "SELECT completed FROM tasks LIMIT 1"; // Sesuaikan sesuai struktur tabel Anda
    $result = $conn->query($sqlGetPreviousStatus);

    if ($result) {
        $row = $result->fetch_assoc();
        $previousStatus = $row['completed'];

        // Ubah status sesuai dengan status sebelumnya
        $newStatus = ($previousStatus == 1) ? 0 : 1;

        // Update status
        $sqlUpdateStatus = "UPDATE tasks SET completed = $newStatus";
        $conn->query($sqlUpdateStatus);

        // Kirim status baru ke klien
        echo json_encode(['status' => 'success', 'newStatus' => $newStatus]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}
 if ($_SERVER['REQUEST_METHOD'] === 'PUT2') {
    $sql = "UPDATE `tasks` SET completed = 0";
    $conn->query($sql);
}

$conn->close();
