<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Forgot Password</h4>
                    </div>
                    <div class="card-body">
                        <!-- Flash messages -->
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>

                        <form action="<?php echo base_url('auth/send_reset_link'); ?>" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
