<?php 
  session_start();
  require('new-connection-thewall.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> PHP3 Advance - the Wall</title>
    <style type="text/css">

      #wrapper {
        width: 1000px;
        margin: 30px auto;
        font-family: sans-serif;
      }

      #header-fix {
        width:100%;
        height: 70px;
        background-color: white;
        border-bottom: 2px solid navy;
        position: fixed;
        top:0px;
        left: 0px;
      }

        #header-fix h1 {
          display: inline-block;
          margin:0px;
          padding: 15px 0px 0px 15px;
          color: navy;
        }

        #header-fix p {
          display: inline-block;
          margin: 0px 0px 0px 840px;
          padding: 0px;
        }

        #header-fix span {
          font-size: 25px;
          color: blue;
        }

        #header-fix a {
          display: inline-block;
          margin-left: 80px;
        }
      
          #header-fix .post-box {
            width: 985px;
            height: 143px;
            background-color: white;
            border-bottom: 2px solid navy;
            margin: 20px 0px 0px 190px;
            padding: 15px;
            display: block;
          }

            #header-fix .post-box form {
              margin: 0px 0px 10px;
              padding: 0px;
              color: blue;
            }

            #header-fix .post-box form textarea{
              width: 935px; 
              height: 60px;
              border-radius: 5px;
              display: block;
              margin: 15px 0px 15px 30px; 
            }

            #header-fix .post-box textarea.empty {
              border: 2px solid tomato;
            }

            #header-fix .post-box form input {
              background-color: blue;
              border: none;
              border-radius: 5px;
              margin-left: 800px;
              padding: 5px 15px;
              font-size: 12px;
              color: white;
            }
      
      #body {
        margin-top: 250px;
      }
        #body .message-box {
          width: 900px;
          border-bottom: 2px solid navy;
          margin-top: 20px;
          padding: 15px;

        }

          #body .message-box h4 {
            margin:0px;
          }

          #body .message-box form {
            color: green;
          } 

          #body .message-box textarea {
            width: 935px; 
            height: 60px;
            border-radius: 5px;
            display: block;
            margin: 15px 0px 15px 0px; 
          }

          #body .message-box textarea.empty {
            border: 2px solid tomato;
          }  

          #body .message-box input {
            background-color: green;
            border: none;
            border-radius: 5px;
            margin-left: 770px;
            padding: 5px 15px;
            font-size: 12px;
            color: white;
          }


        #body .comment-box {
          width: 885px;
          border-bottom: 2px solid navy;
          margin: 0px 0px 0px 70px;
          padding: 15px;
        }

          #body .comment-box h4 {
            margin: 0px;
          }       
    </style>
  </head>
  <body>
    <div id="wrapper">
      <div id="header-fix">
        <h1>Coding Dojo Wall</h1>
        <p>Welcome <span><?=$_SESSION['user_firstname'];?></span></p>
        <a href="php3advance.login.process.php?user_id=<?=$_SESSION['user_id'];?>">Log off</a>
        <div class="post-box">
          <form action="php3advance.login.process.php" method="POST">
            Post a message:
            <textarea
          <?php 
            if(isset($_SESSION['postEmpty']) && $_SESSION['postEmpty']=='highlight'){
                echo ' class="empty" ';
              }
           ?>
            name="message" placeholder="Message here."></textarea>
            <input type="submit" name="submit" value="Post a message">
            <input type="hidden" name="action" value="postMessage">
          </form>
        </div>
      </div>
      <div id="body">
      <?php 
        $messageQuery = "SELECT messages.id, messages.message, messages.created_at, users.first_name, comments.message_id AS com_msg_id FROM thewall.messages LEFT JOIN users ON thewall.messages.user_id=users.id LEFT JOIN comments ON thewall.comments.message_id=messages.id GROUP BY messages.id;";
        $message_result = fetch_all($messageQuery);

        for($i=count($message_result)-1; $i>=0; $i--){
          echo '<div class="message-box">';
          echo '<h4>'.$message_result[$i]['first_name'].'- '.$message_result[$i]['created_at'].'</h4>';
          echo '<p>'. $message_result[$i]['message'].'</p>';
          echo '<form action="php3advance.login.process.php" method="POST">';
          echo 'Post a comment: ';
          echo '<textarea';
              if(isset($_SESSION['commentEmpty']) && $_SESSION['commentEmpty']=='highlight') {
                echo ' class="empty" ';
              } 
          echo ' name="comment" placeholder="Comment here."></textarea>';
          echo '<input type="submit" name="submit" value="Add a Comment"/>';
          echo '<input type="hidden" name="action" value="addComment"/>'; 
          echo '<input type="hidden" name="msgId" value="'.$message_result[$i]['id'].'"/>';
          echo '</form>';
          echo '</div>'; 
          
          if($message_result[$i]['id']==$message_result[$i]['com_msg_id']){
            $commentQuery = "SELECT comments.comment, comments.created_at, users.first_name AS com_first_name FROM comments LEFT JOIN messages ON comments.message_id = messages.id LEFT JOIN users ON comments.user_id=users.id WHERE messages.id='{$message_result[$i]['com_msg_id']}';";
            $comment_result = fetch_all($commentQuery);
            foreach($comment_result as $comment) {
              echo '<div class="comment-box">';
              echo '<h4>'.$comment['com_first_name'].' - '.$comment['created_at'].'</h4>';
              echo '<p>'.$comment['comment'].'</p>';
              echo '</div>';
            }
          }
        }

      ?>
        </div>
      </div>
    </div>
  </body>
</html>