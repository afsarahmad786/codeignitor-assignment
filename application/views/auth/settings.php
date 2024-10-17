<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 15px;
        }

        .form-control {
            border-radius: 25px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #00aaff);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #0084d4);
        }

        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="d-flex align-items-center vh-100">
    <div class="container fade-in">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4>Account Settings</h4>
                    </div>
                    <div class="card-body p-5">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">
                                    Change Password
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                                    Update Profile
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="settingsTabContent">
                            <!-- Change Password Section -->
                            <div class="tab-pane fade show active" id="password" role="tabpanel">
                                <form action="<?php echo base_url('auth/change_password'); ?>" method="post">
                                    <div class="mb-4">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Update Password</button>
                                </form>
                            </div>

                            <!-- Update Profile Section -->
                                <div class="tab-pane fade" id="profile" role="tabpanel">
                                    <form action="<?php echo base_url('auth/update_profile'); ?>" method="post">
                                        <div class="mb-4">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="<?php echo isset($this->session->userdata('user')['name']) ? $this->session->userdata('user')['name'] : ''; ?>"
                                                placeholder="Enter your name" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control"
                                                value="<?php echo isset($this->session->userdata('user')['email']) ? $this->session->userdata('user')['email'] : ''; ?>"
                                                placeholder="Enter your email" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="phone" class="form-label">Phone Number (Optional)</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="<?php echo isset($this->session->userdata('user')['phone']) ? $this->session->userdata('user')['phone'] : ''; ?>"
                                                placeholder="Enter your phone number">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                                    </form>
                                </div>

                            </div>

                        </div>

                        <!-- Display Success/Error Messages -->
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger mt-4"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success mt-4"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>