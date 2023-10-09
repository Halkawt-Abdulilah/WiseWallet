<?php

return '

<div class="success-message">
    Logged in Successfully!
</div>
<form class="form mx-auto my-5" id="login-form" method="POST">
    <h1 class="h3  mb-3 fw-normal ">Login</h1>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="login-email" name="login-email" placeholder="">
        <label for="login-email">Email</label>
        <span id="login-email-error-msg" class="error-msg"></span>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="login-password" name="login-password" placeholder="">
        <label for="login-password">Password</label>
        <span id="login-password-error-msg" class="error-msg"></span>
    </div>
    <div class="d-flex my-2">
        <a href="#">Forgot Rassword?</a>
    </div>
    <button type="button" class="dark-gradient w-100 py-2 btn btn-primary" id="login-button">Login</button>
</form>
<script src="public\assets\js\login.js" defer></script>

';
?>