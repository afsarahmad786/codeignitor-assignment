<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <form action="<?php echo base_url('auth/send_reset_link'); ?>" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
