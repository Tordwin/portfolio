<?php
    require_once 'DB.php';

    class UserModel {
        private $dbh;

        public function __construct() {
            $db = new DB();
            $this->dbh = $db->getConn();
        }

        /* ADMIN POWERS */

        //Function that adds a new user (ONLY ADMIN)
        function addUser($username, $roleId, $password, $name){
            try {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $this->dbh->prepare(
                    "INSERT INTO user_details (Username, RoleID, Password, Name) 
                    VALUES (:username, :roleId, :password, :name)"
                    );
                if ($stmt->execute([
                    'username' => $username,
                    'roleId' => $roleId,
                    'password' => $hashPassword,
                    'name' => $name
                ])) {
                    return "User $username added successfully.";
                } else {
                    return "Failed to add user `$username`.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Adds user using sql command
        }//addUser

        //Function that deletes a user (ONLY ADMIN)
        function deleteUser($username){
            try {
                $stmt = $this->dbh->prepare(
                    "UPDATE bugs SET assignedToId = NULL 
                    WHERE assignedToId = 
                    (SELECT Id from user_details WHERE Username = :username)" 
                );
                $stmt->execute([
                    'username' => $username
                ]);
                $stmt2 = $this->dbh->prepare(
                    "DELETE FROM user_details WHERE Username = :username"
                );
                if ($stmt2->execute([
                    'username' => $username
                ])) {
                    return "User $username deleted successfully.";
                } else {
                    return "Failed to delete user `$username`.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Deletes user using sql command
        }//deleteUser

        /*-----------------------------------*/

        /* ADMIN AND MANAGER POWERS */

        //Function that gets ALL users (ONLY ADMIN AND MANAGERS)
        function getAllUsers(){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT Id, Username, RoleID, Name FROM user_details"
                );
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (!$users) {
                    return "NO USERS?????";
                }
        
                $output = "<table border='1'>";
                $output .= "<tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>RoleID</th>
                                <th>Name</th>
                            </tr>";
        
                foreach ($users as $user) {
                    $id = $user['Id'];
                    $username = $user['Username'];
                    $roleId = $user['RoleID'];
                    $name = $user['Name'];
        
                    $output .= "<tr>
                                    <td>$id</td>
                                    <td>$username</td>
                                    <td>$roleId</td>
                                    <td>$name</td>
                                </tr>";
                }
        
                $output .= "</table>";
                return $output;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        

        //Function that creates projects (ONLY ADMIN AND MANAGERS)
        function createProject($projectName){
            try {
                $stmt = $this->dbh->prepare(
                    "INSERT INTO project (Project) VALUES (:projectName)"
                );
                if ($stmt->execute(['projectName' => $projectName])) {
                    return "Project $projectName created successfully.";
                } else {
                    return "Failed to create project `$projectName`.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Creates project using sql command
        }//createProject

        //Function that updates projects (ONLY ADMIN AND MANAGERS)
        function updateProject($id, $projectName){
            try {
                $stmt = $this->dbh->prepare(
                    "UPDATE project SET Project = :projectName WHERE Id = :id"
                );
                if ($stmt->execute([
                    'projectName' => $projectName,
                    'id' => $id
                ])) {
                    return "Project $projectName updated successfully.";
                } else {
                    return "Failed to update project `$projectName`.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Updates project using sql command
        }//updateProject

        //Function that assigns users to a project (ONLY ADMIN AND MANAGERS)
        function assignProject($userId, $projectId){
            try {
                $stmt = $this->dbh->prepare(
                    "UPDATE user_details SET ProjectID = :projectId WHERE Id = :userId;"
                );
                if ($stmt->execute([
                    'projectId' => $projectId,
                    'userId' => $userId
                ])) {
                    return "User $userId assigned to project $projectId.";
                } else {
                    return "Failed to assign user `$userId` to project `$projectId`.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Assigns users to project using sql command
        }//assignProject

        //Function that assigns users to a bug (ONLY ADMIN AND MANAGERS)
        function assignBug($userId, $bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "UPDATE bugs SET assignedToId = :userId WHERE id = :bugId;"
                );
                if ($stmt->execute([
                    'userId' => $userId,
                    'bugId' => $bugId
                ])) {
                    return "User $userId assigned to bug $bugId.";
                } else {
                    return "Failed to assign user `$userId` to bug `$bugId`.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Assigns users to bug using sql command
        }//assignBug

        /*-----------------------------------*/

        /* ALL USER POWERS */

        //Function that creates new bug (ALL USERS)
        function createBug($projectId, $ownerId, $statusId, $priorityId, $summary, $description, $dateRaised, $targetDate){
            try {
                $stmt = $this->dbh->prepare(
                    "INSERT INTO bugs (projectId, ownerId, statusId, priorityId, summary, description, dateRaised, targetDate) 
                    VALUES (:projectId, :ownerId, :statusId, :priorityId, :summary, :description, :dateRaised, :targetDate)"
                );
                if ($stmt->execute([
                    'projectId' => $projectId,
                    'ownerId' => $ownerId,
                    'statusId' => $statusId,
                    'priorityId' => $priorityId,
                    'summary' => $summary,
                    'description' => $description,
                    'dateRaised' => $dateRaised,
                    'targetDate' => $targetDate
                ])) {
                    return "Bug $summary created successfully.";
                } else {
                    return "Failed to create bug `$summary`.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Creates new bug using sql command
        }//createBug

        //Function that updates bug (ONLY ASSIGNED USER OR MANAGER OR ADMIN)
        function updateBug($bugId, $area, $input){
            try {
                $stmt = $this->dbh->prepare(
                    "UPDATE bugs SET $area = :input WHERE id = :bugId"
                );
                if ($stmt->execute([
                    'input' => $input,
                    'bugId' => $bugId
                ])) {
                    return "Bug $bugId updated successfully.";
                } else {
                    return "Failed to update bug `$bugId`.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Updates bug information using sql command
            //ONLY USER ASSIGNED OR MANAGER OR ADMIN CAN CHANGE BUG 
        }//updateBug

        /*-----------------------------------*/

        /* LOGIN FUNCTIONS */

        function getRoleId($username) {
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT RoleID FROM user_details WHERE Username = :username"
                );
                $stmt->execute(['username' => $username]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($result) {
                    return $result['RoleID'];
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }//getRoleId

        function getUserId($username) {
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT Id FROM user_details WHERE Username = :username"
                );
                $stmt->execute(['username' => $username]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    return $result['Id'];
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }//getUserId

        function getValidUsernames() {
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT Username FROM user_details"
                );
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    return $result;
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }//getValidUsernames

        function getValidPasswords($user) {
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT Password FROM user_details WHERE `Username` = :user"
                );
                $stmt->execute(['user' => $user]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['Password'];
            } catch (PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }//getValidPasswords

        function updatePassword($user, $password) {
            try {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $this->dbh->prepare(
                    "UPDATE user_details SET Password = :password WHERE Username = :user"
                );
                if ($stmt->execute([
                    'password' => $hashedPassword,
                    'user' => $user
                ])) {
                    return "Password updated successfully.";
                } else {
                    return "Failed to update password.";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }//updatePassword
    }

?>