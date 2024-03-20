<?php
// session_start();

// require_once 'UserData.php';

//     if ($_SERVER["REQUEST_METHOD"] == "POST") {
//         if (isset($_SESSION['id_utilisateur'])) {
//             $dataUser = $_SESSION['dataUser'];

//             if (isset($_POST['update_nom'])) {
//                 $dataUser->updateNom($_POST['nom']);
//             }
//             if (isset($_POST['update_prenom'])) {
//                 $dataUser->updatePrenom($_POST['prenom']);
//             }
//             if (isset($_POST['update_email'])) {
//                 $dataUser->updateEmail($_POST['email']);
//             }
//             if (isset($_POST['update_password'])) {
//                 $dataUser->updatePassword($_POST['password']);
//             }
//             $_SESSION['dataUser'] = $dataUser;
//         }
//     } else {
//         if (!isset($_SESSION['dataUser'])) {
//             $dataUser = new UserData();
//             $_SESSION['dataUser'] = $dataUser;
//         }
//     }

//     include 'profile.view.php';
?>