<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <?php include "views/head.php"; ?>

</head>
<body> 
    <?php include "views/header.php"; ?>

    <div class="login container">
        <div class="inner-login">
            <div class="login-logo">
                <a href=""><svg class="pre-logo-svg" height="60px" width="60px" fill="#111" viewBox="0 0 69 32"><path d="M68.56 4L18.4 25.36Q12.16 28 7.92 28q-4.8 0-6.96-3.36-1.36-2.16-.8-5.48t2.96-7.08q2-3.04 6.56-8-1.6 2.56-2.24 5.28-1.2 5.12 2.16 7.52Q11.2 18 14 18q2.24 0 5.04-.72z"></path></svg></a>
            </div>
            <h3>your account for everything nike</h3>
            <form class="login-form" action="api/users/signin.php" method="POST">
                <fieldset class="fieldset">
                    <input class="input" type="text" name="email" placeholder="Email address">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="password" name="password" placeholder="Password">
                </fieldset>

                <div class="login-block">
                    <label for="" class="keepSignIn">
                        <input type="checkbox">
                        <span>keep me signed in</span>
                    </label>
                    <a href="">forgot password?</a>
                </div>

                <div class="login-privacy">
                    <p>By logging in, you agree to Nike's Privacy Policy and Terms of Use.</p>
                </div>            

                <fieldset class="fieldset">
                    <button class="button" type="submit">Sign in</button>
                </fieldset>

                <p class="login-member">Not a member? <a href="register.html">Join us</a></p>
            </form>
            <?php
                if(isset($_GET["error"]) && $_GET["error"] == 2){
            ?>
            <p style = "color:red; margin-top:20px;">Заполните все поля</p>
            <?php
                }else if(isset($_GET["error"]) && $_GET["error"] == 3){
            ?>
            <p style = "color:red; margin-top:20px;">Неправильный логин или пароль</p>
            <?php } ?>  
        </div>
    </div>



    <?php include "views/footer.php"; ?>
</body>
</html>