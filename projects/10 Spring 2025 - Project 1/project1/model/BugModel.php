<?php
    require_once 'DB.php';

    class BugModel {
        private $dbh;

        public function __construct() {
            $db = new DB();
            $this->dbh = $db->getConn();
        }

        //Function that gives description of the bug
        function getDescription($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT description FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return "bugID " . $bugId . ": " . $row['description'] ?? '';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            //Returns description of the bug
            //EX: "$bugId: Causes the program to crash."
        }//getDescription

        //Function that gives summary of the bug
        function getSummary($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT summary FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return "bugID " . $bugId . ": " . $row['summary'] ?? '';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns where it is located and what it does
            //EX: "$bugId: Located in the login page. Supposed to display 'Welcome Home'"
        }//getSummary

        //Function that identifies who found the bug
        function getOwner($bugId){
            try {
                $stmt1 = $this->dbh->prepare(
                    "SELECT ownerId FROM bugs WHERE id = :id"
                );
                $stmt1->execute(['id' => $bugId]);
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                $ownerId = $row1['ownerId'];

                $stmt2 = $this->dbh->prepare(
                    "SELECT * FROM user_details WHERE Id = :ownerId"
                );
                $stmt2->execute(['ownerId' => $ownerId]);
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                return "bugID " . $bugId . ": Found by " .  $row2['Name'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns the name of the person who found the bug
            //EX: "$bugId: Found by John Doe"
        }//getOwner

        //Function that displays the date the bug was found
        function getDateRaised($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT dateRaised FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return "bugID " . $bugId . ": Found on " . $row['dateRaised'] ?? '';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns the date the bug was found
            //EX: "$bugId: Found on 02/28/2025"
        }//getDate

        //Function that gets who the bug is assigned to
        function getAssignedTo($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT assignedToId FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                $personId = $row1['assignedToId'];
                
                if ($personId == NULL){
                    return "bugID " . $bugId . ": Assigned to N/A";
                }
                
                $stmt2 = $this->dbh->prepare(
                    "SELECT * FROM user_details WHERE Id = :personId"
                    );
                $stmt2->execute(['personId' => $personId]);
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                return "bugID " . $bugId . ": Assigned to " .  $row2['Name'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns the user in charge of the bug
            //EX: "$bugId: Assigned to John Doe"
        }//getAssignedTo

        //Function that displays the status of the bug
        function getStatus($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT statusId FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $statusId = $row['statusId'];
                if ($statusId == NULL) {
                    return "bugID " . $bugId . ": Status is Unassigned";
                }

                $stmt2 = $this->dbh->prepare(
                    "SELECT * FROM bug_status WHERE Id = :statusId"
                );
                $stmt2->execute(['statusId' => $statusId]);
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                return "bugID " . $bugId . ": Status is " . $row2['Status'] ?? '';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns the status of the bug
            // 1. Unassigned | 2. Assigned | 3. Closed
            //EX: "$bugId: Status is Closed (3)"
        }//getPriority

        //Function that displays the project related to the bug
        function getPriority($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT priorityId FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $priorityId = $row['priorityId'];

                $stmt2 = $this->dbh->prepare("SELECT * FROM `priority` WHERE Id = :priorityId");
                $stmt2->execute(['priorityId' => $priorityId]);
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                return "bugID " . $bugId . ": Priority is " . $row2['Priority'] ?? '';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns the priority of the bug
            // 1. Low | 2. Medium | 3. High | 4. Urgent
            //EX: "$bugId: Priority is High (3)"
        }//getPriority

        //Function that displays target resolution date
        function getTargetDate($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT targetDate FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['targetDate'] == NULL) {
                    return "bugID " . $bugId . ": No target date set";
                }
                return "bugID " . $bugId . ": Target resolution date is " . $row['targetDate'] ?? '';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns the target resolution date
            //EX: "$bugId: Target resolution date is 03/15/2025"
        }//getTargetDate
        
        //Function that displays actual resolution date
        function getResolutionDate($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT dateClosed FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['dateClosed'] == NULL) {
                    return "bugID " . $bugId . ": Not Closed";
                }
                return "bugID " . $bugId . ": Resolved on " . $row['dateClosed'] ?? '';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns the actual resolution date
            //EX: "$bugId: Resolved on 03/10/2025"
        }//getResolutionDate

        //Function that gets fix resolution summary 
        function getFixDescription($bugId){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT fixDescription FROM bugs WHERE id = :id"
                );
                $stmt->execute(['id'=>$bugId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['fixDescription'] == NULL) {
                    return "bugID " . $bugId . ": No fix description available";
                }
                return "bugID " . $bugId . ": " . $row['fixDescription'] ?? '';
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns the fix resolution summary
            //EX: "$bugId: Missing semi-colon in line 25"
        }//getFixDescription

        //******************************************************** */

        //Function that gets ALL bugs based on project
        function getAllBugsByProject(){
            try {
                $stmt = $this->dbh->prepare("SELECT Id, Project FROM project");
                $stmt->execute();
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$projects) {
                    return "No projects found.";
                }

                $output = "<h2>Projects and Associated Bugs</h2>";

                foreach ($projects as $project) {
                    $projectId = $project['Id'];
                    $projectName = $project['Project'];

                    $stmt2 = $this->dbh->prepare(
                        "SELECT id, description, dateRaised 
                        FROM bugs WHERE projectId = :projectId"
                        );
                    $stmt2->execute(['projectId'=>$projectId]);
                    $bugs = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                    $output .= "<h3>Project $projectId: $projectName</h3>";

                    if (!$bugs) {
                        $output .= "<p>No bugs found for Project $projectId: $projectName</p>";
                    }

                    $output .= "<table border='1'>";
                    $output .= "<tr>
                                    <th>Bug ID</th>
                                    <th>Description</th>
                                    <th>Date Raised</th>
                                </tr>";

                    foreach ($bugs as $bug) {
                        $bugId = $bug['id'];
                        $description = $bug['description'];
                        $dateRaised = $bug['dateRaised'];

                        $output .= "<tr>
                                        <td>$bugId</td>
                                        <td>$description</td>
                                        <td>$dateRaised</td>
                                    </tr>";
                    }
                    $output .= "</table>";
                }

                return $output;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns all bugs related to the project
        }//getAllBugsByProject

        //Function that gets ALL bugs
        function getAllOpenBugsByProject(){
            try {
                $stmt = $this->dbh->prepare("SELECT Id, Project FROM project");
                $stmt->execute();
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$projects) {
                    return "No projects found.";
                }

                $output = "<h2>Projects and Open Bugs</h2>";

                foreach ($projects as $project) {
                    $projectId = $project['Id'];
                    $projectName = $project['Project'];

                    $stmt2 = $this->dbh->prepare(
                        "SELECT id, description, dateRaised 
                        FROM bugs WHERE projectId = :projectId AND statusId = 1"
                        );
                    $stmt2->execute(['projectId'=>$projectId]);
                    $bugs = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                    $output .= "<h3>Project $projectId: $projectName</h3>";

                    if (!$bugs) {
                        $output .= "<p>No open bugs found for Project $projectId: $projectName</p>";
                        continue;
                    }

                    $output .= "<table border='1'>";
                    $output .= "<tr><th>Bug ID</th><th>Description</th><th>Date Raised</th></tr>";
    
                    foreach ($bugs as $bug) {
                        $bugId = $bug['id'];
                        $description = $bug['description'];
                        $dateRaised = $bug['dateRaised'];
    
                        $output .= "<tr>
                                        <td>$bugId</td>
                                        <td>$description</td>
                                        <td>$dateRaised</td>
                                    </tr>";
                    }
                    $output .= "</table>";
                }

                return $output;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns all open bugs that have not been resolved
        }//getAllOpenBugsByProject

        //Function that gets OVERDUE bugs based on inputted projectId
        function getOverdueBugsByProject(){
            try {
                $stmt = $this->dbh->prepare("SELECT Id, Project FROM project");
                $stmt->execute();
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$projects) {
                    return "No projects found.";
                }

                $output = "<h2>Overdue Bugs by Project</h2>";

                foreach ($projects as $project) {
                    $projectId = $project['Id'];
                    $projectName = $project['Project'];

                    $stmt2 = $this->dbh->prepare(
                        "SELECT id, description, dateRaised 
                        FROM bugs WHERE projectId = :projectId 
                        AND targetDate < CURDATE()"
                        );
                    $stmt2->execute(['projectId'=>$projectId]);
                    $bugs = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                    $output .= "<h3>Project $projectId: $projectName</h3>";

                    if (!$bugs) {
                        $output .= "<p>No overdue bugs found for Project $projectId: $projectName</p>";
                        continue;
                    }

                    $output .= "<table border='1'>";
                    $output .= "<tr><th>Bug ID</th><th>Description</th><th>Date Raised</th></tr>";
    
                    foreach ($bugs as $bug) {
                        $bugId = $bug['id'];
                        $description = $bug['description'];
                        $dateRaised = $bug['dateRaised'];
    
                        $output .= "<tr>
                                        <td>$bugId</td>
                                        <td>$description</td>
                                        <td>$dateRaised</td>
                                    </tr>";
                    }
                    $output .= "</table>";
                }

                return $output;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns all bugs that have passed the target resolution date
        }//getOverdueBugsByProject

        //Function that gets ALL overdue bugs
        function getAllOverdueBugs(){
            try {
                $output = "<h2>Overdue Bugs</h2>";
                $stmt2 = $this->dbh->prepare(
                    "SELECT id, description, dateRaised 
                    FROM bugs WHERE targetDate < CURDATE()"
                );
                $stmt2->execute();
                $bugs = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                if (!$bugs) {
                    $output .= "<p>No overdue bugs.</p>";
                }
                $output .= "<table border='1'>";
                $output .= "<tr>
                                <th>Bug ID</th>
                                <th>Description</th>
                                <th>Date Raised</th>
                            </tr>";
    
                foreach ($bugs as $bug) {
                    $bugId = $bug['id'];
                    $description = $bug['description'];
                    $dateRaised = $bug['dateRaised'];
    
                    $output .= "<tr>
                                    <td>$bugId</td>
                                    <td>$description</td>
                                    <td>$dateRaised</td>
                                </tr>";
                }
                $output .= "</table>";
                return $output;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns all bugs that have passed the target resolution date
        }//getAllOverdueBugs

        //Function that gets ALL UNASSIGNED bugs
        function getAllUnassignedBugs(){
            try {
                $output = "<h2>Unassigned Bugs</h2>";
                $stmt2 = $this->dbh->prepare(
                    "SELECT id, description, dateRaised 
                    FROM bugs WHERE statusId = 1"
                );
                $stmt2->execute();
                $bugs = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                if (!$bugs) {
                    $output .= "<p>No overdue bugs.</p>";
                }
                $output .= "<table border='1'>";
                $output .= "<tr>
                                <th>Bug ID</th>
                                <th>Description</th>
                                <th>Date Raised</th>
                            </tr>";
    
                foreach ($bugs as $bug) {
                    $bugId = $bug['id'];
                    $description = $bug['description'];
                    $dateRaised = $bug['dateRaised'];
    
                    $output .= "<tr>
                                    <td>$bugId</td>
                                    <td>$description</td>
                                    <td>$dateRaised</td>
                                </tr>";
                }
                $output .= "</table>";
                return $output;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns all bugs that have not been assigned to a user
        }//getUnassignedBugs
    
        //GET ALL FUNCTIONS

        //Function that gets ALL bugs
        function getAllBugs(){
            try {
                $stmt = $this->dbh->prepare(
                    "SELECT id, statusId, priorityId, summary, description, 
                    dateRaised, targetDate FROM bugs"
                    );
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (!$rows) {
                    return "<p>No bugs found.</p>";
                }
        
                $output = '<table border="1">
                            <thead>
                                <tr>
                                    <th>Bug ID</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Summary</th>
                                    <th>Description</th>
                                    <th>Date Raised</th>
                                    <th>Target Date</th>
                                </tr>
                            </thead>
                            <tbody>';
        
                foreach ($rows as $row) {
                    $id = $row['id'];
                    $statusId = $row['statusId'];
                    $priorityId = $row['priorityId'];
                    $summary = $row['summary'];
                    $description = $row['description'];
                    $dateRaised = $row['dateRaised'];
                    $targetDate = $row['targetDate'];
                    $output .= "<tr>
                                    <td>$id</td>
                                    <td>$statusId</td>
                                    <td>$priorityId</td>
                                    <td>$summary</td>
                                    <td>$description</td>
                                    <td>$dateRaised</td>
                                    <td>$targetDate</td>
                                </tr>";
                }
                $output .= '</tbody></table>';
                return $output;
                
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }//getAllBugs


        // USER FUNCTIONS

        //Function that gets ALL bugs based on project
        function getAllBugsByProjectUser($userId){
            try {
                $stmt2 = $this->dbh->prepare("SELECT Id, Project FROM project");
                $stmt2->execute();
                $projects = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                if (!$projects) {
                    return "No projects found.";
                }

                $output = "<h2>Projects and Associated Bugs</h2>";

                foreach ($projects as $project) {
                    $projectId = $project['Id'];
                    $projectName = $project['Project'];

                    $stmt3 = $this->dbh->prepare(
                        "SELECT id, description, dateRaised 
                        FROM bugs WHERE projectId = :projectId AND assignedToId = :userId"
                        );
                    $stmt3->execute(['projectId'=>$projectId, 'userId'=>$userId]);
                    $bugs = $stmt3->fetchAll(PDO::FETCH_ASSOC); 

                    $output .= "<h3>Project $projectId: $projectName</h3>";

                    if (!$bugs) {
                        $output .= "<p>No assigned bugs</p>";
                        continue;
                    }

                    $output .= "<table border='1'>";
                    $output .= "<tr>
                                    <th>Bug ID</th>
                                    <th>Description</th>
                                    <th>Date Raised</th>
                                </tr>";

                    foreach ($bugs as $bug) {
                        $bugId = $bug['id'];
                        $description = $bug['description'];
                        $dateRaised = $bug['dateRaised'];

                        $output .= "<tr>
                                        <td>$bugId</td>
                                        <td>$description</td>
                                        <td>$dateRaised</td>
                                    </tr>";
                    }
                    $output .= "</table>";
                }

                return $output;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns all bugs related to the project
        }//getAllBugsByProject

        //Function that gets ALL bugs
        function getAllOpenBugsByProjectUser($userId){
            try {
                $stmt = $this->dbh->prepare("SELECT Id, Project FROM project");
                $stmt->execute();
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$projects) {
                    return "No projects found.";
                }

                $output = "<h2>Projects and Open Bugs</h2>";

                foreach ($projects as $project) {
                    $projectId = $project['Id'];
                    $projectName = $project['Project'];

                    $stmt2 = $this->dbh->prepare(
                        "SELECT id, description, dateRaised 
                        FROM bugs WHERE projectId = :projectId AND statusId = 1 AND assignedToId = :userId"
                        );
                    $stmt2->execute(['projectId'=>$projectId, 'userId'=>$userId]);
                    $bugs = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                    $output .= "<h3>Project $projectId: $projectName</h3>";

                    if (!$bugs) {
                        $output .= "<p>No assigned open bugs</p>";
                        continue;
                    }

                    $output .= "<table border='1'>";
                    $output .= "<tr><th>Bug ID</th><th>Description</th><th>Date Raised</th></tr>";
    
                    foreach ($bugs as $bug) {
                        $bugId = $bug['id'];
                        $description = $bug['description'];
                        $dateRaised = $bug['dateRaised'];
    
                        $output .= "<tr>
                                        <td>$bugId</td>
                                        <td>$description</td>
                                        <td>$dateRaised</td>
                                    </tr>";
                    }
                    $output .= "</table>";
                }

                return $output;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns all open bugs that have not been resolved
        }//getAllOpenBugsByProject

        //Function that gets OVERDUE bugs based on inputted projectId
        function getOverdueBugsByProjectUser($userId){
            try {
                $stmt = $this->dbh->prepare("SELECT Id, Project FROM project");
                $stmt->execute();
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$projects) {
                    return "No projects found.";
                }

                $output = "<h2>Overdue Bugs by Project</h2>";

                foreach ($projects as $project) {
                    $projectId = $project['Id'];
                    $projectName = $project['Project'];

                    $stmt2 = $this->dbh->prepare(
                        "SELECT id, description, dateRaised 
                        FROM bugs WHERE projectId = :projectId 
                        AND targetDate < CURDATE()
                        AND assignedToId = :userId"
                        );
                    $stmt2->execute(['projectId'=>$projectId, 'userId'=>$userId]);
                    $bugs = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                    $output .= "<h3>Project $projectId: $projectName</h3>";

                    if (!$bugs) {
                        $output .= "<p>No assigned overdue bugs</p>";
                        continue;
                    }

                    $output .= "<table border='1'>";
                    $output .= "<tr><th>Bug ID</th><th>Description</th><th>Date Raised</th></tr>";
    
                    foreach ($bugs as $bug) {
                        $bugId = $bug['id'];
                        $description = $bug['description'];
                        $dateRaised = $bug['dateRaised'];
    
                        $output .= "<tr>
                                        <td>$bugId</td>
                                        <td>$description</td>
                                        <td>$dateRaised</td>
                                    </tr>";
                    }
                    $output .= "</table>";
                }

                return $output;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            //Returns all bugs that have passed the target resolution date
        }//getOverdueBugsByProject

    }
?>