<?php
$message="";
if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);
    $query =mysqli_query($con,"SELECT * FROM users WHERE username='".$username."' AND password='".$password."'");
    $numrows=mysqli_num_rows($query);

    if($numrows!=0)
    {
        while($row=mysqli_fetch_assoc($query))
        {
            $dbusername=$row['username'];
            $dbpassword=$row['password'];
        }
        if($username == $dbusername && $password == $dbpassword)
        {
            $_SESSION['session_username']=$username;
            header("Location: /");
        }
    } else {
            $message="Invalid username or password!";
    }
}
include_once ("header.php");
?>
<div class="container">
<div class="row vertical-offset-100">
    <div class="col-md-4 col-md-offset-4 d-block mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please sign in</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="username" name="username" required type="text">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" required type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                            </label>
                        </div>
                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
if(!empty($message)):?>
<div class="alert alert-danger my-4" role="alert">
    <?=$message;?>
</div>
<?php endif;

include_once ("footer.php");
?>

