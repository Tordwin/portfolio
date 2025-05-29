<?php
    /* StaffController */
    /* This controller connects to the UserModel and grabs the data that is stored
    from the database in the UserModel and in here it runs the functions to display
    the data, add projects, update sql, etc.. */
    require_once '../model/StaffModel.php';

    class StaffController {
        private $model;

        public function __construct(){
            $this->model = new UserModel();
        }

        public function addUser($username, $roleId, $password, $name) {
            echo $this->model->addUser($username, $roleId, $password, $name);
        }

        public function deleteUser($username) {
            echo $this->model->deleteUser($username);
        }

        public function createProject($projectName) {
            echo $this->model->createProject($projectName);
        }

        public function updateProject($id, $projectName) {
            echo $this->model->updateProject($id, $projectName);
        }

        public function assignProject($userId, $projectId) {
            echo $this->model->assignProject($userId, $projectId);
        }

        public function assignBug($userId, $bugId) {
            echo $this->model->assignBug($userId, $bugId);
        }

        public function createBug($projectId, $ownerId, $statusId, $priorityId, $summary, $description, $dateRaised, $targetDate) {
            echo $this->model->createBug($projectId, $ownerId, $statusId, $priorityId, $summary, $description, $dateRaised, $targetDate);
        }

        public function updateBug($bugId, $area, $input) {
            echo $this->model->updateBug($bugId, $area, $input);
        }

        public function getRoleId($username) {
            return $this->model->getRoleId($username);
        }
        
        public function getUserId($username) {
            return $this->model->getUserId($username);
        }

        public function getValidUsernames() {
            return $this->model->getValidUsernames();
        }

        public function getValidPasswords($username) {
            return $this->model->getValidPasswords($username);
        }

        public function updatePassword($username, $password) {
            echo $this->model->updatePassword($username, $password);
        }

        public function getAllUsers(){
            echo $this->model->getAllUsers();
        }
    }
?>