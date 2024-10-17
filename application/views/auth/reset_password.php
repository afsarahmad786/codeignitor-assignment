<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>

                        <form action="<?php echo base_url('auth/update_password'); ?>" method="post">
                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <input type="hidden" name="email" value="<?php echo $email; ?>">

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirm" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirm" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
