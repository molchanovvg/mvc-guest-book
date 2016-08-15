<form class="form-signin" role="form" action="" method="post">
    <h2 class="form-signin-heading">Please sign in (admin:123)</h2>
    <input type="text" class="form-control" placeholder="login" name="login" required autofocus>
    <input type="password" class="form-control" placeholder="password" name="password" required>
    <button class="btn btn-md btn-info btn-block" type="submit">Sign in</button>

    <?php if($data["login_status"]=="access_denied") { ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Не удалось авторизоваться!</strong>
        </div>
    <?php }  ?>

</form>




