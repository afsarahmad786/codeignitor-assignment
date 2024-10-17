<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <form action="<?php echo base_url('auth/update_password'); ?>" method="post">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">

        <label for="password">New Password:</label>
        <input type="password" name="password" required><br><br>

        <label for="password_confirm">Confirm Password:</label>
        <input type="password" name="password_confirm" required><br><br>

        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
