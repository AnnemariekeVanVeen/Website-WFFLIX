<!-- Login -->
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <div class="text-center pb-3" style="text-decoration-line:underline "><?php
                                echo Session::getFlash('alert');
                                ?>
                            </div>
                            <h3 class="login-heading mb-4 text-center">Welcome back!</h3>
                            <form action="index.php?do=check" method="post">
                                <div class="form-label-group">
                                    <input class="form-control mb-2" type="text" id="username" name="username"
                                           placeholder="User Name" required autofocus>
                                    <label for="username">User Name</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="password" class="form-control" name="password"
                                           placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
                                        type="submit">Sign in
                                </button>
                                <div class="text-center">
                                    <a class="small" href="#">Forgot password?</a>
                                </div>
                            </form>
                            <h6 class="login-heading m-5 text-center">Not registered yet? <a
                                        href="index.php?do=registerform">Register here</a></h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>