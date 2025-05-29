<?php
    // Start the session
    session_name('admin');
    session_start();
    $_SESSION['username'] = $_GET['username'];

    //Checks if the Admin is logged in
    if (!isset($_SESSION['username'])) {
        if ($_SESSION['username'] != 'admin') {
            header("Location: LoginView.php");
            exit();
        }
    }

    // Grabbing Controllers
    require_once '../controller/BugController.php';
    require_once '../controller/StaffController.php';

    //CONNECTION TO THE DATABASE
    $staffDB = new StaffController();
    $bugDB = new BugController();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
    </head>
    <body>
        <!-- Introduction with logout button -->
        <h1>Admin Page - <?php echo $_SESSION['username']; ?> <button onclick="window.location.href=`LoginView.php`">Logout</button> </h1>        

        <!-- Current Bugs -->
        <h2>Current Bugs</h2>
        <?php echo $bugDB->getAllBugs();?>
        <br />

        <!-- Current Users -->
        <h2>Current Users</h2>
        <?php echo $staffDB->getAllUsers();?>
        <br />

        <!-- BUTTONS -->
        <button onclick="showTable('allBugsByProject')">Bugs By Project</button>
        <button onclick="showTable('openBugsByProject')">Open Bugs By Project</button>
        <button onclick="showTable('overdueBugsByProject')">Overdue Bugs By Project</button>
        <button onclick="showTable('allOverdueBugs')">All Overdue Bugs</button>
        <button onclick="showTable('unassignedBugs')">Unassigned Bugs</button>

        <div id="allBugsByProject" class="bugTable" style="display:none"><?php echo $bugDB->getAllBugsByProject();?></div>
        <div id="openBugsByProject" class="bugTable" style="display:none"><?php echo $bugDB->getAllOpenBugsByProject();?></div>
        <div id="overdueBugsByProject" class="bugTable" style="display:none"><?php echo $bugDB->getOverdueBugsByProject();?></div>
        <div id="allOverdueBugs" class="bugTable" style="display:none"><?php echo $bugDB->getAllOverdueBugs();?></div>
        <div id="unassignedBugs" class="bugTable" style="display:none"><?php echo $bugDB->getAllUnassignedBugs();?></div>
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
        
        <!-- BUTTONS -->
        <form method="POST">
            <label for="bugId">Bug ID:</label>
            <input type="text" id="bugId" name="bugId" required>
            <button type="submit" name="getDescription">Get Description</button>
            <button type="submit" name="getSummary">Get Summary</button>
            <button type="submit" name="getFixDescription">Get Fix Description</button>
            <button type="submit" name="getOwner">Get Owner</button>
            <button type="submit" name="getAssignedTo">Get Assigned To</button>
            <button type="submit" name="getStatus">Get Status</button>
            <button type="submit" name="getPriority">Get Priority</button>
            <button type="submit" name="getDateRaised">Get Date Found</button>
            <button type="submit" name="getTargetDate">Get Target Date</button>
            <button type="submit" name="getResolutionDate">Get Resolution Date</button>
        </form>
        
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $output = '';
                if (isset($_POST['bugId']) && !empty($_POST['bugId'])) {
                    if (isset($_POST['getDescription'])) {
                        $output = $bugDB->getDescription($_POST['bugId']);
                    }
                    if (isset($_POST['getSummary'])) {
                        $output = $bugDB->getSummary($_POST['bugId']);
                    }
                    if (isset($_POST['getFixDescription'])) {
                        $output = $bugDB->getFixDescription($_POST['bugId']);
                    }
                    if (isset($_POST['getOwner'])) {
                        $output = $bugDB->getOwner($_POST['bugId']);
                    }
                    if (isset($_POST['getAssignedTo'])) {
                        $output = $bugDB->getAssignedTo($_POST['bugId']);
                    }
                    if (isset($_POST['getStatus'])) {
                        $output = $bugDB->getStatus($_POST['bugId']);
                    }
                    if (isset($_POST['getPriority'])) {
                        $output = $bugDB->getPriority($_POST['bugId']);
                    }
                    if (isset($_POST['getDateRaised'])) {
                        $output = $bugDB->getDateRaised($_POST['bugId']);
                    }
                    if (isset($_POST['getTargetDate'])) {
                        $output = $bugDB->getTargetDate($_POST['bugId']);
                    }
                    if (isset($_POST['getResolutionDate'])) {
                        $output = $bugDB->getResolutionDate($_POST['bugId']);
                    }
                }
                echo $output;
            }
        ?>

        <!-- SPLITTER -->
        <h2>-------------------------------------------------------------------------------------------------------------------</h2>
        <!-- SPLITTER -->

        <!-- Add User Method -->
        <h2>ADD USER</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br />
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br />
            <label for="name">Name:</label>
            <input type="name" id="name" name="name" required>
            <br />
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="1">Admin</option>
                <option value="2">Manager</option>
                <option value="3">User</option>
            </select>
            <button type="submit" name="addUser">Add User</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addUser'])) {
                if (isset($_POST['addUser'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $name = $_POST['name'];
                    $role = $_POST['role'];
                    echo $staffDB->addUser($username, $role, $password, $name);
                }
            }
        ?>

        <br />
        <!-- End of Add User Method -->

        <!-- Change Password Method -->
        <h2>Change Password</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br />
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br />
            <button type="submit" name="updatePassword">Change Password</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePassword'])) {
                if (isset($_POST['updatePassword'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    echo $staffDB->updatePassword($username, $password);
                }
            }
        ?>
        <!-- End of Change Password Method -->
        
        <!-- Delete User Method -->
        <h2>DELETE USER</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <button type="submit" name="deleteUser">Delete User</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteUser'])) {
                $username = $_POST['username'];
                echo $staffDB->deleteUser($username);
            }
        ?>
        <br />
        <!-- End of Delete User Method -->
        
        <!-- Add Project Method -->
        <h2>ADD PROJECT</h2>
        <form method="POST">
            <label for="projectName">Project Name:</label>
            <input type="text" id="projectName" name="projectName" required>
            <button type="submit" name="createProject">Create Project</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['createProject'])) {
                $projectName = $_POST['projectName'];
                echo $staffDB->createProject($projectName);
            }
        ?>
        <br />
        <!-- End of Add Project Method -->

        <!-- Update Project Method -->
        <h2>UPDATE PROJECT</h2>
        <form method="POST">
            <label for="projectId">Project ID:</label>
            <input type="text" id="projectId" name="projectId" required>
            <label for="projectName">New Project Name:</label>
            <input type="text" id="projectName" name="projectName" required>
            <button type="submit" name="updateProject">Update Project</button>
        </form>
        
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProject'])) {
                $projectId = $_POST['projectId'];
                $projectName = $_POST['projectName'];
                echo $staffDB->updateProject($projectId, $projectName);
            }
        ?>
        <br />
        <!-- End of Update Project Method -->

        <!-- Assign User Method -->
        <h2>ASSIGN USER</h2>
        <form method="POST">
            <label for="userId">User ID:</label>
            <input type="text" id="userId" name="userId" required>
            <label for="projectId">Project ID:</label>
            <input type="text" id="projectId" name="projectId" required>
            <button type="submit" name="assignUser">Assign User</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assignUser'])) {
                $userId = $_POST['userId'];
                $projectId = $_POST['projectId'];
                echo $staffDB->assignProject($userId, $projectId);
            }
        ?>
        <br />
        <!-- End of Assign User Method -->

        <!-- Assign Bug Method -->
        <h2>ASSIGN BUG</h2>
        <form method="POST">
            <label for="userID">User ID:</label>
            <input type="text" id="userID" name="userID" required>
            <label for="bugID">Bug ID:</label>
            <input type="text" id="bugID" name="bugID" required>
            <button type="submit" name="assignBug">Assign Bug</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assignBug'])) {
                $userID = $_POST['userID'];
                $bugID = $_POST['bugID'];
                echo $staffDB->assignBug($userID, $bugID);
            }
        ?>
        <br />
        <!-- End of Assign Bug Method -->

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

        <!-- Update Bug Method -->
        <h2>UPDATE BUG</h2>
        <form method="POST">
            <label for="bugID">Bug ID:</label>
            <input type="text" id="bugID" name="bugID" required>
            <label for="area">Area:</label>
            <select id="area" name="area" required>
                <option value="summary">Summary</option>
                <option value="description">Description</option>
                <option value="fixDescription">Fix Description</option>
            </select>
            <label for="input">Change to:</label>
            <input type="text" id="input" name="input" required>
            <button type="submit" name="updateBug">Update Bug</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateBug'])) {
                $bugID = $_POST['bugID'];
                $area = $_POST['area'];
                $input = $_POST['input'];
                echo $staffDB->updateBug($bugID, $area, $input);
            }
        ?>
        <br />
        <!-- End of Update Bug Method -->
    </body>
</html>