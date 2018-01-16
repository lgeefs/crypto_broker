<?php
    require_once('header.php');
?>

<div class='col-sm-2'></div>

    <form id='register-form' class='form col-sm-8 text-center' action='' method='POST'>

        <div class='content col-sm-6'>
            <label for='first_name'>First Name</label><input class='form-control' type='text' name='first_name' required />
        </div>
        <div class='content col-sm-6'>
            <label for='last_name'>Last Name</label><input class='form-control' type='text' name='last_name' required />
        </div>
        <div class='content col-sm-6'>
            <label for='email'>Email</label><input class='form-control' type='email' name='email' required />
        </div>
        <div class='content col-sm-6'>
            <label for='password'>Password</label><input class='form-control' type='password' name='password' required />
        </div>      

        <div class='col-sm-12 text-center'>

            <div class='spacer-40'></div>
            <div class='text-center error'></div>
            <div class='spacer-40'></div>
            <div class='text-center'>
                <input id='register-submit' class='submit' type='button' name='submit' value='Go' />
            </div>
            <div class='spacer-40'></div>

        </div>

    </form>

</div>
    
<div class='col-sm-2'></div>

<?php require_once('footer.php'); ?>