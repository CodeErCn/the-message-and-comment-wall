<?php 
  session_start();
  // $_SESSION=array();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> PHP3 Advance - The Wall</title>
    <style type="text/css">
      
      
      #wrapper {
        width: 800px;
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
          margin:0px;
          padding: 15px 0px 0px 15px;
          color: navy;
        }

      #redBorder {
        border: 2px solid red;
      }

      .msg-box {
        width: 500px;
        height: 120px;
        background-color: whitesmoke;
        border: 1.5px solid darkgray;
        border-radius: 5px;
        margin: 100px auto 0px;
        text-align: center;
        color: black;
      }

        .msg-box p {
          margin: 5px;
          font-size: 15px;
        }

        .msg-box p.red {
          color: red;
        }

        .msg-box p.green {
          color: green;
        }

      .login {
        background-color: whitesmoke;
        width: 500px;
        height: 173px;
        margin: 10px auto 10px;
      } 
        .login fieldset {
          width: 450px;
          height: 143px;
          margin: 0px auto;
          text-align: center;
        }
        
        .login fieldset table {
          margin: 10px auto 0px;
          text-align: right;
        } 
          .login fieldset table tr {
            height: 30px;
          }

          .login fieldset table td {
            padding: 0px 15px;
          }

          .login fieldset table input {
            width: 150px;
            height: 17px;
            border-radius: 5px;
          }

         .login fieldset>input {
          width: 100px;
          margin-top: 20px;
        }


      .register {
        width: 500px;
        height: 280px;
        background-color: whitesmoke;
        margin: 10px auto 0px;
      }
        .register fieldset{
          width: 450px;
          height: 250px;
          margin: 0px auto;
          text-align: center;
        }

        .register fieldset table {
          margin: 20px auto 0px;
          text-align: right;
        }
         .register fieldset table tr {
            height: 30px;
          }

          .register fieldset table td {
            padding: 0px 15px;
          }

          .register fieldset table input {
            width: 175px;
            height: 17px;
            border-radius: 5px;
          }

         .register fieldset>input {
          width: 100px;
          margin-top: 25px;
        }
    </style>
  </head>
  <body>
    
    <div id="wrapper">
      <div id="header-fix">
        <h1>Coding Dojo Wall</h1>
      </div>
      <div class="msg-box">
      <?php
        if(isset($_SESSION['Msg'])) {
          foreach($_SESSION['Msg'] AS $message) {
            echo $message;
          }
        } else {
          echo "<p>* field is required to login or register.</p>";
        }
      ?>
      </div>
      <div class="login">
        <form action="php3advance.process.php" method="POST">
          <fieldset>
            <legend>Login</legend>
            <table>
              <tbody>
                <tr>
                  <td>Email*:</td>
                  <td><input 
                 <?php
                      if(isset($_SESSION['loginEmailFlag']) && $_SESSION['loginEmailFlag']) {
                        echo 'id="redBorder"';
                      }
                  ?> 
                  type="text" name="email" placeholder="Please enter your email."/></td>
                </tr>
                <tr> 
                  <td>Password*:</td>
                  <td><input 
                  <?php
                    if(isset($_SESSION['loginPasswordFlag']) && $_SESSION['loginPasswordFlag']) {
                      echo 'id="redBorder"';
                    }
                  ?>  
                  type="password" name="password" placeholder="Please enter your password."/></td>
                </tr>
              </tbody>
            </table>
            <input type="submit" name="submit" value="submit"/>
            <input type="hidden" name="action" value="login"/>
          </fieldset>
        </form>
      </div>
      <div class="register">
        <form action="php3advance.process.php" method="POST">
          <fieldset>
            <legend>Register</legend>
            <table>
              <tbody>
                <tr>
                  <td>Email*:</td>
                  <td><input 
                  <?php
                    if(isset($_SESSION['registerEmailFlag']) && $_SESSION['registerEmailFlag']) {
                      echo 'id="redBorder"';
                    }  
                  ?>
                  type="email" name="email" placeholder="Please enter your email here."/>
                  </td>
                </tr>
                <tr>
                  <td>First Name*:</td>
                  <td><input
                  <?php
                    if(isset($_SESSION['registerFirstNameFlag']) && ($_SESSION['registerFirstNameFlag'])) {
                      echo "id='redBorder'";
                    }
                  ?>
                   type="text" name="firstname" placeholder="Please enter your first name here."/>
                  </td>
                </tr>
                <tr>
                  <td>Last Name*:</td>
                  <td><input 
                  <?php  
                  if(isset($_SESSION['registerLastNameFlag']) && $_SESSION['registerLastNameFlag']) {
                    echo "id='redBorder'";
                  }
                  ?>
                  type="text" name="lastname" placeholder="Please enter your last name here."/>
                  </td>
                </tr>
                <tr>
                  <td>Password*:</td>
                  <td><input 
                 <?php
                    if(isset($_SESSION['registerPasswordFlag']) && $_SESSION['registerPasswordFlag']) {
                      echo 'id="redBorder"';
                    }  
                  ?>
                  type="password" name="password" placeholder="Please enter your password."/>
                  </td>
                </tr>
                <tr>
                  <td>Confirm Password*:</td>
                  <td><input 
                  <?php
                    if(isset($_SESSION['registerConfirmFlag']) && $_SESSION['registerConfirmFlag']) {
                      echo 'id="redBorder"';
                    }  
                  ?>
                  type="password" name="confirmPW" placeholder="Please confirm your password."/>
                  </td>
                </tr>
              </tbody>
            </table>
            <input type="submit" name="submit" value="submit"/>
            <input type="hidden" name="action" value="register"/>
          </fieldset>
        </form>
      </div>
    </div>
  </body>
</html>