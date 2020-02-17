<?php

  if(isset($_POST['Login']))
  {
    require_once '../controllers/Authentication.php';
    $msg = Authentication::authenticate();
  }
?>
<style>
  *, *:before, *:after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

html, body {
  font-size: 62.5%;
  height: 100%;
  overflow: hidden;
}
@media (max-width: 768px) {
  html, body {
    font-size: 50%;
  }
}

svg {
  display: inline-block;
  width: 2rem;
  height: 2rem;
  overflow: visible;
}

.svg-icon {
  cursor: pointer;
}
.svg-icon path {
  stroke: rgba(255, 255, 255, 0.9);
  fill: none;
  stroke-width: 1;
}

input, button {
  outline: none;
  border: none;
}

.cont {
  position: relative;
  height: 100%;
  background-image: url("../assets/images/nature-plant-leaf-66869.jpg");
  background-size: cover;
  overflow: auto;
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
}

.demo {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-left: -15rem;
  margin-top: -26.5rem;
  width: 30rem;
  height: 53rem;
  overflow: hidden;
}

.login {
  position: relative;
  height: 100%;
  background: linear-gradient(to bottom, rgba(74, 101, 11, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
  transition: opacity 0.1s, -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
  transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
  transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25), -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
  -webkit-transform: scale(1);
          transform: scale(1);
}
.login.inactive {
  opacity: 0;
  -webkit-transform: scale(1.1);
          transform: scale(1.1);
}
.login__check {
  position: absolute;
  top: 16rem;
  left: 13.5rem;
  width: 14rem;
  height: 2.8rem;
  background: #fff;
  -webkit-transform-origin: 0 100%;
          transform-origin: 0 100%;
  -webkit-transform: rotate(-45deg);
          transform: rotate(-45deg);
}
.login__check:before {
  content: "";
  position: absolute;
  left: 0;
  bottom: 100%;
  width: 2.8rem;
  height: 5.2rem;
  background: #fff;
  box-shadow: inset -0.2rem -2rem 2rem rgba(0, 0, 0, 0.2);
}
.login__form {
  position: absolute;
  top: 50%;
  left: 0;
  width: 100%;
  height: 50%;
  padding: 1.5rem 2.5rem;
  text-align: center;
}
.login__row {
  height: 5rem;
  padding-top: 1rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}
.login__icon {
  margin-bottom: -0.4rem;
  margin-right: 0.5rem;
}
.login__icon.name path {
  stroke-dasharray: 73.50196075439453;
  stroke-dashoffset: 73.50196075439453;
  -webkit-animation: animatePath 2s 0.5s forwards;
          animation: animatePath 2s 0.5s forwards;
}
.login__icon.pass path {
  stroke-dasharray: 92.10662841796875;
  stroke-dashoffset: 92.10662841796875;
  -webkit-animation: animatePath 2s 0.5s forwards;
          animation: animatePath 2s 0.5s forwards;
}
.login__input {
  display: inline-block;
  width: 22rem;
  height: 100%;
  padding-left: 1.5rem;
  font-size: 1.5rem;
  background: transparent;
  color: #FDFCFD;
}
.login__submit {
  position: relative;
  width: 100%;
  height: 4rem;
  margin: 5rem 0 2.2rem;
  color: rgba(255, 255, 255, 0.8);
  background: #FF3366;
  font-size: 1.5rem;
  border-radius: 3rem;
  cursor: pointer;
  overflow: hidden;
  transition: width 0.3s 0.15s, font-size 0.1s 0.15s;
}
.login__submit:after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  margin-left: -1.5rem;
  margin-top: -1.5rem;
  width: 3rem;
  height: 3rem;
  border: 2px dotted #fff;
  border-radius: 50%;
  border-left: none;
  border-bottom: none;
  transition: opacity 0.1s 0.4s;
  opacity: 0;
}
.login__submit.processing {
  width: 4rem;
  font-size: 0;
}
.login__submit.processing:after {
  opacity: 1;
  -webkit-animation: rotate 0.5s 0.4s infinite linear;
          animation: rotate 0.5s 0.4s infinite linear;
}
.login__submit.success {
  transition: opacity 0.1s 0.3s, background-color 0.1s 0.3s, -webkit-transform 0.3s 0.1s ease-out;
  transition: transform 0.3s 0.1s ease-out, opacity 0.1s 0.3s, background-color 0.1s 0.3s;
  transition: transform 0.3s 0.1s ease-out, opacity 0.1s 0.3s, background-color 0.1s 0.3s, -webkit-transform 0.3s 0.1s ease-out;
  -webkit-transform: scale(30);
          transform: scale(30);
  opacity: 0.9;
}
.login__submit.success:after {
  transition: opacity 0.1s 0s;
  opacity: 0;
  -webkit-animation: none;
          animation: none;
}


.ripple {
  position: absolute;
  width: 15rem;
  height: 15rem;
  margin-left: -7.5rem;
  margin-top: -7.5rem;
  background: rgba(0, 0, 0, 0.4);
  -webkit-transform: scale(0);
          transform: scale(0);
  -webkit-animation: animRipple 0.4s;
          animation: animRipple 0.4s;
  border-radius: 50%;
}

@-webkit-keyframes animRipple {
  to {
    -webkit-transform: scale(3.5);
            transform: scale(3.5);
    opacity: 0;
  }
}

@keyframes animRipple {
  to {
    -webkit-transform: scale(3.5);
            transform: scale(3.5);
    opacity: 0;
  }
}
@-webkit-keyframes rotate {
  to {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}
@keyframes rotate {
  to {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}
@-webkit-keyframes animatePath {
  to {
    stroke-dashoffset: 0;
  }
}
@keyframes animatePath {
  to {
    stroke-dashoffset: 0;
  }
}

</style>







<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Scholarship Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <!-- <link rel="stylesheet" type="text/css" href="../assets/css/login.css"> -->
  <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  <link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
 
</head>
  <body>
    <form action=""  method="post">
      <div class="cont">
        <div class="demo">
          <div class="login">
            <div class="login__check"></div>

            <?php
              if (isset($msg)) {              
            ?>
              <div class="alert alert-danger loginAlert" >
                <button type="button" class="close" data-dismiss="alert">
                  <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-warning green"></i> 
                <?php echo $msg?>     
              </div>
            <?php
              }         
            ?>

            <div class="login__form">
              <div class="login__row">
                <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                  <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                </svg>
                <input type="text" class="login__input name" name="USERNAME" placeholder="Username"/>
              </div>
              <div class="login__row">
                <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                  <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                </svg>
                <input type="password" class="login__input pass" name="PASSWORD" placeholder="Password"/>
              </div>
              <button type="submit" name="Login" class="login__submit">Sign in</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>







