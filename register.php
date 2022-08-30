<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <?php include "views/head.php"; ?>

</head>
<body> 
    <?php include "views/header.php"; ?>
    
    <div class="register container">
        <div class="inner-register">
            <div class="register-logo">
                <a href=""><svg class="pre-logo-svg" height="60px" width="60px" fill="#111" viewBox="0 0 69 32"><path d="M68.56 4L18.4 25.36Q12.16 28 7.92 28q-4.8 0-6.96-3.36-1.36-2.16-.8-5.48t2.96-7.08q2-3.04 6.56-8-1.6 2.56-2.24 5.28-1.2 5.12 2.16 7.52Q11.2 18 14 18q2.24 0 5.04-.72z"></path></svg></a>
            </div>
            <h3>become a nike member</h3>
            <p class="register-text">Create your Nike Member profile and get first access to the very best of Nike products, inspiration and community.</p>
            <!-- отправляем данные методом пост -->
            <form class="register-form" action="api/users/signup.php" method="POST">
                <fieldset class="fieldset">
                    <input class="input" type="text" name="email" placeholder="Email address">
                </fieldset>

                <fieldset class="fieldset">
                    <input class="input" type="password" name="password" placeholder="Password">
                </fieldset>

                <fieldset class="fieldset">
                    <input class="input" type="text" name="firstName" placeholder="First Name">
                </fieldset>

                <fieldset class="fieldset">
                    <input class="input" type="text" name="secondName" placeholder="Last Name">
                </fieldset>

                <div class="register-block">
                    <label for="" class="checkSignUp">
                        <input type="checkbox">
                        <span>Sign up for emails to get updates from Nike on products, offers, and your Member benefits</span>
                    </label>
                </div>          
                <p class="register-privacy">By creating an account, you agree to Nike's Privacy Policy and Terms of Use.</p>
                <fieldset class="fieldset">
                    <button class="button" type="submit">Join us</button>
                </fieldset>

                <p class="register-member">Alredy a member? <a href="login.html">Sign in</a></p>
            </form>
            <?php 
                if(isset($_GET["error"]) && $_GET["error"] == 1){
            ?> 
                <p style = "color:red; margin-top:20px;">заполните все поля</p>
            <?php }
                else if(isset($_GET["error"]) && $_GET["error"] == 2){
            ?>
                <p style = "color:red; margin-top:20px;">Пользователь уже существует</p>
            <?php }?>
        </div>
    </div>


    <?php include "views/footer.php"; ?>
</body>
</html>