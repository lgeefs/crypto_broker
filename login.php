<?php require_once('header.php'); ?>

<div class='spacer-60'></div>

<div class='col-lg-4 col-md-3 col-sm-2 col-xs-2'></div>

<div class='form-group col-lg-4 col-md-6 col-sm-8 col-xs-8'>

    <form id='login-form' class='form' action='./' method='POST'>

        <h1>Login</h1>

        <div class='content'>
        
            <label for='email'>Email</label><input class='form-control' type='email' name='email' required /><br>
            <label for='password'>Password</label><input class='form-control' type='password' name='password' required />
            
            <div class="spacer-20"></div>
            <div class='error'></div>
            <div class="text-center">
                <input id='login-submit' class='submit' type='submit' name='submit' value='Go' /><br>
                <!--<a href="forgotPassword.php">Forgot Password?</a>-->
            </div>

        </div>

    </form>

</div>

<div class='col-lg-4 col-md-3 col-sm-2 col-xs-2'></div>

<?php require_once('footer.php'); ?>