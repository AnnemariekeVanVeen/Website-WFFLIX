<!-- Account settings (user interface)-->

<div class="container mt-5 pt-4 mb-3">
    <div class="row">
        <div class="col-lg-12 my-3">
            <h1 class="text-center">Welcome, <?= $_SESSION["first_name"] ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4" style="border:0;">
                <div class="card-body">

                    <!-- CRUD Customer Data -->
                    <form action="index.php?do=account" method="post">
                        <div class="container">
                            <div class="row <?= !isset($this->status) ? "d-none" : ""; ?>">
                                <div class="col-md-5 mx-auto rounded-pill mb-3"
                                     style="border: 3px solid green; background-color: lightgreen;">
                                    <h5 class="my-4 text-center"><?= isset($this->status) ? $this->status : ""; ?></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mx-auto">
                                    <h3 class="my-4 text-center">My account settings:</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mx-auto">
                                    <div class="form-label-group">
                                        <input type="email" id="email" class="form-control mb-2" name="email"
                                               value="<?= $_SESSION["email"]; ?>"
                                               placeholder="Email" value="<?= $_SESSION["email"] ?>"
                                               required autofocus readonly>
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input class="form-control mb-2" type="text" id="first_name" name="first_name"
                                               value="<?= $_SESSION["first_name"]; ?>"
                                               placeholder="First Name" required autofocus>
                                        <label for="first_name">First Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input class="form-control mb-2" type="text" id="last_name" name="last_name"
                                               value="<?= $_SESSION["last_name"]; ?>"
                                               placeholder="Last Name" required autofocus>
                                        <label for="last_name">Last Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="user_name" class="form-control mb-2" name="user_name"
                                               value="<?= $_SESSION["user_name"]; ?>"
                                               placeholder="User Name"
                                               required autofocus>
                                        <label for="city">User Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" id="password" class="form-control" name="password"
                                               placeholder="Password">
                                        <label for="password">Change Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mx-auto">
                                    <button class="btn btn-lg btn-secondary btn-block btn-login text-uppercase font-weight-bold mb-2"
                                            type="submit">Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
