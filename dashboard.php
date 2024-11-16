<?php
include "config.php"; // Include your database connection file

$joinType = ''; // Variable to hold the type of join
$query = ''; // Initialize the query variable
$result = null; // Initialize the result variable

// Check if a join type button was clicked
if (isset($_POST['join_type'])) {
    $joinType = $_POST['join_type'];

    // Determine the SQL query based on the selected join type
    switch ($joinType) {
        case 'inner':
            $query = "
                SELECT user_form.id, user_form.name, user_form.email, item_form.item_name, item_form.user_type 
                FROM user_form 
                INNER JOIN item_form ON user_form.user_type = item_form.user_type
            ";
            break;
        case 'left':
            $query = "
                SELECT user_form.id, user_form.name, user_form.email, item_form.item_name, item_form.user_type 
                FROM user_form 
                LEFT JOIN item_form ON user_form.user_type = item_form.user_type
            ";
            break;
        case 'right':
            $query = "
                SELECT user_form.id, user_form.name, user_form.email, item_form.item_name, item_form.user_type 
                FROM user_form 
                RIGHT JOIN item_form ON user_form.user_type = item_form.user_type
            ";
            break;
        case 'full':
            $query = "
                SELECT user_form.id, user_form.name, user_form.email, item_form.item_name, item_form.user_type 
                FROM user_form 
                LEFT JOIN item_form ON user_form.user_type = item_form.user_type

                UNION

                SELECT user_form.id, user_form.name, user_form.email, item_form.item_name, item_form.user_type 
                FROM user_form 
                RIGHT JOIN item_form ON user_form.user_type = item_form.user_type
            ";
            break;
    }

    // Execute the query if it's not empty
    if (!empty($query)) {
        $result = mysqli_query($conn, $query);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<body style="background-color: #1A1A19">
<center>
    <h1 style="color: #F6FCDF;">Lestine's Dashboard</h1>

    <!-- Buttons for different join types -->
    <form method="post">
        <button type="submit" name="join_type" value="inner">INNER JOIN</button>
        <button type="submit" name="join_type" value="left">LEFT JOIN</button>
        <button type="submit" name="join_type" value="right">RIGHT JOIN</button>
        <button type="submit" name="join_type" value="full">FULL OUTER JOIN</button>
    </form>

    <h2 style="color: #F6FCDF;">Current Query: <?php echo htmlspecialchars($query); ?></h2> <!-- Display the current query -->

    <table border="3" style="background-color: #F6FCDF;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Item Name</th>
            <th>User Type</th>
        </tr>

        <?php
        // Display results if a query was executed
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><?php echo $row['user_type']; ?></td>
                </tr>
                <?php
            }
        } else {
            // Optional: Display a message if no results are found or no query was executed
            if ($joinType) {
                echo "<tr><td colspan='5'>No results found for the selected join type.</td></tr>";
            }
        }
        ?>
    </table>

    <!-- Logout Button -->
    <form method="post" action="logout.php" style="margin-top: 20px;">
        <button type="submit">Logout</button>
    </form>