<nav class='navbar navbar-fixed-top bg-nav col-md-12 text-right'>
    <div class='col-md-1'></div>
    <div class='col-md-10' style='margin-top:10px;'>

        <div class='navbar-header'>

            <a href='dashboard' class='navbar-brand padding-small'>
                <img style="height:40px;" class='' src='images/lunaris.jpg' />
            </a>

        </div>
        <ul class='custom-nav right padding-large hidden-xs'>
            <?php

                $navclass = 'light-gray padding-large padding-large-sides';
                
                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != null) { //if user is logged in, display these tabs:
                    
                    if ($_SESSION['admin']) {

                        echo "<li><a id='dashboard' href='dashboard' class='".$navclass."'>Dashboard</a></li>";
                        echo "<li><a id='admin' href='transactions' class='".$navclass."'>Transactions</a></li>";
                        echo "<li><a id='holdings' href='holdings' class='".$navclass."'>Holdings</a></li>";
                        echo "<li><a id='accounts' href='accounts' class='".$navclass."'>Accounts</a></li>";

                    }

                    echo "<li><a id='logout' href='logout' class='".$navclass."'>Logout</a></li>";

                } else { //if user is logged out, show these tabs:

                    echo "<li><a id='login' href='login' class='".$navclass."'>Login</a></li>";

                }

            ?>
        </ul>

    </div>
    <div class='col-md-1'></div>

</nav>