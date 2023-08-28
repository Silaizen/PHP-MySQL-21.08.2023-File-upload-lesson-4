<h1>Sign in</h1>
<?php Message::get() ?>
<div class="container mt-5">
        <h2>Login</h2>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="action" value="validateLoginForm">Login</button>
        </form>
    </div>