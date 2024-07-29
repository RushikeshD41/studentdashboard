<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Student Dashboard</h1>
    <form action="update.php" method="POST">
        <input type="text" name="name" placeholder="Name" value="<?php echo $student['name'] ?? ''; ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo $student['email'] ?? ''; ?>" required>
        <input type="text" name="course" placeholder="Course" value="<?php echo $student['course'] ?? ''; ?>" required>
        <button type="submit">Update</button>
    </form>
    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
