<?php

$errors = [];

if (!empty($_POST)) {
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];
   $message = $_POST['message'];
  
   if (empty($firstname)) {
       $errors[] = 'First Name is empty';
   }

   if (empty($lastname)) {
    $errors[] = 'First Name is empty';
}

   if (empty($email)) {
       $errors[] = 'Email is empty';
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[] = 'Email is invalid';
   }

   if (empty($message)) {
       $errors[] = 'Message is empty';
   }
}