<?php
    /* BugController */
    /* This controller connects to the BugModel and grabs the data that is stored
    from the database in the BugModel and in here it runs the functions to display
    the data. */

    require_once '../model/BugModel.php';

    class BugController {
        private $model;

        public function __construct(){
            $this->model = new BugModel();
        }

        public function getDescription($id){
            return $this->model->getDescription($id);
        }

        public function getSummary($id){
            return $this->model->getSummary($id);
        }

        public function getOwner($id){
            return $this->model->getOwner($id);
        }

        public function getDateRaised($id){
            return $this->model->getDateRaised($id);
        }

        public function getAssignedTo($id){
            return $this->model->getAssignedTo($id);
        }

        public function getStatus($id){
            return $this->model->getStatus($id);
        }

        public function getPriority($id){
            return $this->model->getPriority($id);
        }

        public function getTargetDate($id){
            return $this->model->getTargetDate($id);
        }

        public function getResolutionDate($id){
            return $this->model->getResolutionDate($id);
        }

        public function getFixDescription($id){
            return $this->model->getFixDescription($id);
        }

        public function getAllBugsByProject(){
            return $this->model->getAllBugsByProject();
        }
        
        public function getAllOpenBugsByProject(){
            return $this->model->getAllOpenBugsByProject();
        }

        public function getOverdueBugsByProject(){
            return $this->model->getOverdueBugsByProject();
        }

        public function getAllOverdueBugs(){
            return $this->model->getAllOverdueBugs();
        }

        public function getAllUnassignedBugs(){
            return $this->model->getAllUnassignedBugs();
        }

        public function getAllBugs(){
            return $this->model->getAllBugs();
        }

        public function getAllBugsByProjectUser($userId){
            return $this->model->getAllBugsByProjectUser($userId);
        }

        public function getAllOpenBugsByProjectUser($userId){
            return $this->model->getAllOpenBugsByProjectUser($userId);
        }

        public function getOverdueBugsByProjectUser($userId){
            return $this->model->getOverdueBugsByProjectUser($userId);
        }
    }
?>