<?php 
  session_start();
  require('new-connection-thewall.php');
  $_SESSION['postEmpty']='';
  $_SESSION['commentEmpty']='';

  if(isset($_POST['action']) && $_POST['action']=='postMessage') {
    if(!empty($_POST['message'])) {
      $date = date('g:ia F j Y');
      $esc_postMessage = escape_this_string($_POST['message']);
      $esc_userId = escape_this_string($_SESSION['user_id']);
      $messageQuery = "INSERT INTO thewall.messages (message, created_at, updated_at, user_id) VALUES ('$esc_postMessage', '$date', NOW(), '$esc_userId');";
      run_mysql_query($messageQuery);
      header('location:php3advance.loginsuccess.php');
      exit;
    } else {
      $_SESSION['postEmpty']='highlight';
      header('location:php3advance.loginsuccess.php');
      exit;
    }
  }

  if(isset($_POST['action']) && $_POST['action']=='addComment') {
    if(!empty($_POST['comment'])){
      $date = date('g:ia F j Y');
      $esc_addComment = escape_this_string($_POST['comment']);
      $esc_userId = escape_this_string($_SESSION['user_id']);
      $commentQuery = "INSERT INTO thewall.comments (comment, created_at, updated_at, user_id, message_id) VALUES ('$esc_addComment', '$date', NOW(), '$esc_userId', '{$_POST['msgId']}');";
      run_mysql_query($commentQuery); 
      header('location:php3advance.loginsuccess.php'); 
      exit;                                       
    } else {
      $_SESSION['commentEmpty']='highlight';
      header('location:php3advance.loginsuccess.php'); 
      exit;  
    }                                                            
  }

  if(isset($_GET['user_id']) && $_SESSION['user_id'] == $_GET['user_id']) {
    $_SESSION = array();
    header('location:php3advance.index.php');
    exit;
  }
?>