<?php
    class Utilisateur {
        private $nom;
        private $prenom;
        private $email;
        private $mot_de_passe;
       
    

        public function __construct($nom, $prenom, $email, $mot_de_passe) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->mot_de_pass = $mot_de_pass;
        }

        public function getTitle() {
            return $this->nom;
        }

        public function getprenom() {
            return $this->prenom;
        }

        public function getemail() {
            return $this->email;
        }

        public function getmot_de_pass() {
            return $this->mot_de_pass;
        }


    }
?>
