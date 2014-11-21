<?php
  session_start();
  require('new-connection-thewall.php');
  $_SESSION = array();
  // var_dump($_POST);
  
  $loginEmailFlag='';
  $rtLoginEmail='';
  $loginPasswordFlag='';
  $rtLoginPassword='';
  $regiEmailFlag='';
  $rtRegiEmail='';
  $regiFirstNameFlag='';
  $rtRegiFirstName='';
  $regiLastNameFlag='';
  $rtRegiLastName='';
  $regiPasswordFlag='';
  $rtRegiPassword='';
  $regiConfirmFlag='';

  function salt_the_password($password) {
    $salt = bin2hex(openssl_random_pseudo_bytes(22));
    $hash = crypt($password,$salt);
    return $hash;
  }

  function unsalt_the_password($passwordLogin, $passwordDb) {
    $unsalt = crypt($passwordLogin,$passwordDb);
    return $unsalt;
  }

  // FOR LOGIN
  if(isset($_POST['action']) && $_POST["action"]=='login') {
    foreach($_POST as $KEY => $VALUE) {
      // LOGIN EMAIL VALIDATION
      if($KEY == 'email') {
        if(empty($VALUE)) {
          $_SESSION['loginEmailFlag'] = true;
          $_SESSION['Msg']['email'] = "<p class='red'>Email field cannot be blank.</p>";
        } else if (!filter_var($VALUE, FILTER_VALIDATE_EMAIL)) {
          $_SESSION['loginEmailFlag'] = true;
          $_SESSION['Msg']['email'] = "<p class='red'>Not a valid email address.</p>";
        } else {
          $loginEmailFlag = 'go';
          $rightLoginEmail = $VALUE;
        }
      }

      // LOGIN PASSWORD VALIDATION
      if($KEY == 'password')  {
        if(empty($VALUE)) {
          $_SESSION['loginPasswordFlag'] = true;
          $_SESSION['Msg']['password'] = "<p class='red'>Password Field cannot be blank.</p>";
        } else if (strlen($VALUE) < 6) {
          $_SESSION['loginPasswordFlag'] = true;
          $_SESSION['Msg']['password'] = "<p class='red'>Password cannot be less than 6 character.</p>";
        } else {
          $loginPasswordFlag = 'go';
          $rightLoginPassword =  $VALUE;
        }
      }
    }

    // CHECKING PASSWORD FOR USER LOGIN
    if($loginEmailFlag=='go' && $loginPasswordFlag=='go') {
      //escape
      $esc_loginEmail = escape_this_string($rightLoginEmail);
      $esc_loginPassword = escape_this_string($rightLoginPassword);
      //query for user password
      $loginQuery = "SELECT users.id, users.first_name, users.password FROM users WHERE users.email = '$esc_loginEmail';";
      //Get result from the DB    
      $resultLogin =fetch_record($loginQuery);
      //If Email input was not in the database
      if($resultLogin!=null){
        //Unsalte and match password
        $unsalted_esc_password = unsalt_the_password($esc_loginPassword,$resultLogin['password']);
        if($unsalted_esc_password == $resultLogin['password']){
          $_SESSION['user_id'] = $resultLogin['id'];
          $_SESSION['user_firstname'] = $resultLogin['first_name'];
          header('location:php3advance.loginsuccess.php');
          exit;
        }else {
          $_SESSION['Msg']['fail'] = '<p class="red">Password incorrect! Please try again.</p>';
          header('location:php3advance.index.php');
          exit;
        } 
      } else {
        $_SESSION['Msg']['noUser'] = '<p class="red">Email not in record, please register or try again.</p>';
        header('location:php3advance.index.php');
        exit;
      }
    }else {
        header('location:php3advance.index.php');
        exit;
      }
  }

  // FOR REGISTER
  if(isset($_POST['action']) && $_POST["action"]=='register') {
    foreach($_POST as $KEY => $VALUE) {
      // REGISTER EMAIL VALIDATION
      if($KEY == 'email') {
        if(empty($VALUE)) {
          $_SESSION['registerEmailFlag'] = true;
          $_SESSION['Msg']['email'] = '<p class="red">Email field cannot be blank.</p>';
        } else if (!filter_var($VALUE, FILTER_VALIDATE_EMAIL)) {
          $_SESSION['registerEmailFlag'] = true;
          $_SESSION['Msg']['email'] = '<p class="red">Not a valid email address.</p>';
        } else {
          $regiEmailFlag = 'go';
          $rtRegiEmail = $VALUE;
        }
      }
      
      // REGISTER FIRST NAME VALIDATION
       if($KEY == 'firstname') {
        if(empty($VALUE)) {
          $_SESSION['registerFirstNameFlag'] = true;
          $_SESSION['Msg']['firstname'] = '<p class="red">First name field cannot be blank.</p>';
        } else if (ctype_alpha($VALUE)==false) {
          $_SESSION['registerFirstNameFlag'] = true;
          $_SESSION['Msg']['firstname'] = '<p class="red">Name Field cannot content number.</p>';
        } else {
          $regiFirstNameFlag = 'go';
          $rtRegiFirstName = $VALUE;
        }
      }

      // REGISTER LAST NAME VALIDATOIN
      if($KEY == 'lastname') {
        if(empty($VALUE)) {
          $_SESSION['registerLastNameFlag'] = true;
          $_SESSION['Msg']['lastname'] = '<p class="red">Last name field cannot be blank.</p>';
        } else if (ctype_alpha($VALUE)==false) {
          $_SESSION['registerLastNameFlag'] = true;
          $_SESSION['Msg']['lastname'] = '<p class="red">Name Field cannot content number.</p>';
        } else {
          $regiLastNameFlag = 'go';
          $rtRegiLastName = $VALUE;
        }
      }

      // REGISTER PASSWORD VALIDATION
      if($KEY == 'password')  {
        if(empty($VALUE)) {
          $_SESSION['registerPasswordFlag'] = true;
          $_SESSION['Msg']['password'] = '<p class="red">Password Field cannot be blank.</p>';
        } else if (strlen($VALUE) < 6) {
          $_SESSION['registerPasswordFlag'] = true;
          $_SESSION['Msg']['password'] = '<p class="red">Password cannot be less than 6 character.</p>';
        } else {
          $regiPasswordFlag = 'go';
          $rtRegiPassword =  $VALUE;
        }
      }
      // REGISTER CONFIRM PASSWORD
      if($KEY == 'confirmPW')  {
        if(empty($VALUE)) {
          $_SESSION['registerConfirmFlag'] = true;
          $_SESSION['Msg']['confirmPW'] = '<p class="red">Confirm Password Field cannot be blank.</p>';
        } else if(strlen($VALUE) < 6) {
          $_SESSION['registerConfirmFlag'] = true;
          $_SESSION['Msg']['confirmPW'] = '<p class="red">Password cannot be less than 6 character.</p>';
        } else if($VALUE != $rtRegiPassword) {
          $_SESSION['registerPasswordFlag'] = true;
          $_SESSION['registerConfirmFlag'] = true;
          $_SESSION['Msg']['confirmPW'] = '<p class="red">Password does not match.</p>';
        } else {
          $regiConfirmFlag = 'go';
        }
      }
    }
    
    //STORE USER INFORMATION TO DATABASE
    if($regiEmailFlag=='go' && $regiFirstNameFlag=='go' && $regiLastNameFlag=='go' && $regiPasswordFlag=='go' && $regiConfirmFlag=='go') {
      $esc_regiFirstName = escape_this_string($rtRegiFirstName);
      $esc_regiLastName = escape_this_string($rtRegiLastName); 
      $esc_regiEmail = escape_this_string($rtRegiEmail);
      $esc_regiPassword = escape_this_string($rtRegiPassword);
      $salted_esc_password =salt_the_password($esc_regiPassword);
      $date = date('g:ia F j Y'); 

      $regiQuery = "INSERT INTO thewall.users (first_name, last_name, email, password, created_at, updated_at) VALUES ('$esc_regiFirstName','$esc_regiLastName','$esc_regiEmail','$salted_esc_password','$date',NOW());";
      run_mysql_query($regiQuery);

      $_SESSION['Msg']['success'] = '<p class="green">Registration successful! Thank you for registering.</p>';
      header('location:php3advance.index.php');
      exit;
    }
    else {
        header('location:php3advance.index.php');
        exit;
      }
  }
  // var_dump($_SESSION);
?>