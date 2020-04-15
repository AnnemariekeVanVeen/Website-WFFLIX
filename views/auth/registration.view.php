<!-- Registration Form -->
<div class="container">

    <div class="row">

        <div class="col-md-12">
            <div class="card mb-4" style="border:0; height: 100vh">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                                <h3 class="my-4">Fill in your details</h3>
                                <form action="index.php?do=createuser" method="post">
                                    <div class="form-label-group">
                                        <input class="form-control mb-2" type="text" id="first_name" name="first_name"
                                               placeholder="First Name" required autofocus>
                                        <label for="first_name">First Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input class="form-control mb-2" type="text" id="last_name" name="last_name"
                                               placeholder="Last Name" required autofocus>
                                        <label for="last_name">Last Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input class="form-control mb-2 " type="text" id="username" name="username"
                                               placeholder="User Name" required autofocus>
                                        <label for="username">User Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="email" id="email" class="form-control mb-2" name="email"
                                               placeholder="Email Address"
                                               required autofocus>
                                        <label for="email">Email Address</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" id="password" class="form-control" name="password"
                                               placeholder="Password" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
                                            type="submit">Register
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>