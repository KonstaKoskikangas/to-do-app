<?php
$conn = new mysqli ("localhost","root","","todolist");
if ($conn->connect_error) {
    die("Connection failed " . $conn->connect_error);
}

if (isset($_POST["addtask"])) {
    $task = $_POST["task"];
    $conn -> query("INSERT INTO tasks (task) VALUES ('$task')");
    header("Location: index.php");
}
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $conn->query("DELETE FROM tasks WHERE id = '$id'");
    header("Location: index.php");
}
if (isset($_GET["complete"])) {
    $id = $_GET["complete"];
    $conn->query("UPDATE tasks SET status = 'completed' WHERE id = '$id'");
    header("Location: index.php");
} 
$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Tehtävät</h1>
        <form action="index.php" method="post">
            <input type="text" name="task" placeholder="Lisää uusi tehtävä" id="">
            <button type="submit" name="addtask" class="button">Lisää</button>
            </form>
<ul>
    <?php while($row = $result->fetch_assoc()): ?>
        <li class="<?php echo $row["status"]; ?>">               
            <div class="actions">
                <a href="index.php?complete=<?php echo $row['id']; ?>">
                <span class="material-icons">check_circle</span> </a>
            </div>
            <strong><?php echo $row["task"];?></strong>
            <a href="index.php?delete=<?php echo $row['id']; ?>">
            <span class="material-icons">cancel</span></a>
        </li>
    <?php endwhile ?>
</ul>
