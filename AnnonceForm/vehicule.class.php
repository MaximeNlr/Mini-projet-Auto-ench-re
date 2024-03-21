<?php
    class Vehicule {
        private $titre;
        private $model;
        private $marque;
        private $puissance;
        private $annee;
        private $description;
        private $prix_depart;
    

        public function __construct($titre, $model, $marque, $puissance, $annee, $description, $prix_depart) {
            $this->titre = $titre;
            $this->model = $model;
            $this->marque = $marque;
            $this->puissance = $puissance;
            $this->annee = $annee;
            $this->description = $description;
            $this->prix_depart = $prix_depart;

        }

        public function getTitle() {
            return $this->titre;
        }

        public function getModel() {
            return $this->model;
        }

        public function getMarque() {
            return $this->marque;
        }

        public function getPuissance() {
            return $this->puissance;
        }

        public function getDescription() {
            return $this->description;
        } 
        
        public function getprix_depart() {
            return $this->prix_depart;
        }

    }
?>
