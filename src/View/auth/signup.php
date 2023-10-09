<?php

return '

<div class="success-message">
    Signed up successfully, <a href="login">Login here</a>
</div>
<form class="form mx-auto my-5" id="signup-form" method="POST">
    <h1 class="h3  mb-3 fw-normal ">Sign Up</h1>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-floating">
                <input type="text" class="form-control" name="signup-first-name" required>
                <label for="signup-firstname">First Name</label>
                <span id="signup-first-name-error-msg" class="error-msg"></span>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-floating">
                <input type="text" class="form-control" name="signup-last-name" required>
                <label for="signup-lastname">Last Name</label>
                <span id="signup-last-name-error-msg" class="error-msg"></span>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="signup-username" required>
        <label for="signup-username">Username</label>
        <span id="signup-username-error-msg" class="error-msg"></span>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" name="signup-email" required>
        <label for="signup-email">Email</label>
        <span id="signup-email-error-msg" class="error-msg"></span>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="signup-password" required>
        <label for="signup-password">Password</label>
        <span id="signup-password-error-msg" class="error-msg"></span>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="signup-repeat-password" required>
        <label for="signup-repeat-password">Confirm Password</label>
        <span id="signup-repeat-password-error-msg" class="error-msg"></span>
    </div>
    <button type="button" class="dark-gradient w-100 py-2 btn btn-primary" id="signup-button">Sign up</button>
    <div class="d-flex my-2">
        <a href="./login">Already Signed up?<a>
    </div>
</form>
<script src="public\assets\js\signup.js" defer></script>

';

?>