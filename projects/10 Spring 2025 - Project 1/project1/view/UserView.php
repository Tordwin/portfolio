<?php
    // Start the session
    session_name('user');
    session_start();
    $_SESSION['username'] = $_GET['username'];

    //Checks if the User is logged in
    if (!isset($_SESSION['username'])) {
        if ($_SESSION['username'] != 'user') {
            header("Location: LoginView.php");
        }
    }
    
    // Grabbing Controllers
    require_once '../controller/BugController.php';
    require_once '../controller/StaffController.php';

    //CONNECTION TO THE DATABASE
    $staffDB = new StaffController();
    $bugDB = new BugController();

    $userId = $staffDB->getUserId($_GET['username']);
    $roleId = $staffDB->getRoleId($userId);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Page</title>
    </head>
    <body>
        <h1>User Page - <?php echo $_SESSION['username']; ?> <button onclick="window.location.href=`LoginView.php`">Logout</button> </h1>
        
        <!-- Current Bugs -->
        <h2>Current Bugs</h2>
        <?php echo $bugDB->getAllBugs();?>
        <br />

        <!-- BUTTONS -->
        <button onclick="showTable('allBugsByProject')">Assigned Bugs By Project</button>
        <button onclick="showTable('openBugsByProject')">Assigned Open Bugs By Project</button>
        <button onclick="showTable('overdueBugsByProject')">Assigned Overdue Bugs By Project</button>

        <div id="allBugsByProject" class="bugTable" style="display:none"><?php echo $bugDB->getAllBugsByProjectUser($userId);?></div>
        <div id="openBugsByProject" class="bugTable" style="display:none"><?php echo $bugDB->getAllOpenBugsByProjectUser($userId);?></div>
        <div id="overdueBugsByProject" class="bugTable" style="display:none"><?php echo $bugDB->getOverdueBugsByProjectUser($userId);?></div>        
        
        <!-- Script for Tables -->
        <script>
            function showTable(table) {
                document.querySelectorAll('.bugTable').forEach(table => {
                    table.style.display = 'none';
                });
                document.getElementById(table).style.display = 'block';
            }
        </script>
        <!-- End of Script -->

        <!-- SPLITTER -->
        <h2>-------------------------------------------------------------------------------------------------------------------</h2>
        <!-- SPLITTER -->

        <!-- Create Bug Method -->
        <h2>CREATE BUG</h2>
        <form method="POST">
            <label for="projectId">Project ID:</label>
            <input type="text" id="projectId" name="projectId" required>
            <label for="ownerId">Owner ID:</label>
            <input type="text" id="ownerId" name="ownerId" required>
            <label for="statusId">Status ID:</label>
            <select id="statusId" name="statusId" required>
                <option value="1">Unassigned</option>
                <option value="2">Assigned</option>
                <option value="3">Closed</option>
            </select>
            <label for="priorityId">Priority ID:</label>
            <select id="priorityId" name="priorityId" required>
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
                <option value="4">Urgent</option>
            </select>
            <label for="summary">Summary:</label>
            <input type="text" id="summary" name="summary" required>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
            <label for="dateRaised">Date Raised:</label>
            <input type="text" id="dateRaised" name="dateRaised" placeholder="yyyy-mm-dd hh:mm:ss" required>
            <label for="targetDate">Target Date:</label>
            <input type="text" id="targetDate" name="targetDate" placeholder="yyyy-mm-dd hh:mm:ss" required>
            <button type="submit" name="createBug">Create Bug</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['createBug'])) {
                $projectId = $_POST['projectId'];
                $ownerId = $_POST['ownerId'];
                $statusId = $_POST['statusId'];
                $priorityId = $_POST['priorityId'];
                $summary = $_POST['summary'];
                $description = $_POST['description'];
                $dateRaised = $_POST['dateRaised'];
                $targetDate = $_POST['targetDate'];
                echo $staffDB->createBug($projectId, $ownerId, $statusId, $priorityId, $summary, $description, $dateRaised, $targetDate);
            }
        ?>
        <br />
        <!-- End of Create Bug Method -->
    </body>
</html>