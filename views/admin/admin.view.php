<!-- Admin page, delete/promote users -->

<div class="container mt-5 pt-4 mb-3">
    <div class="row">
        <div class="col-lg-12 my-3">
            <h1 class="text-center">Welcome back, Admin!</h1>
        </div>
    </div>
    <!-- Manage Accounts -->
    <div class="row">
        <div class="col-lg-12">
            <table class='table table-hover text-white'>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Is admin</th>
                    <th>Promote/Demote</th>
                    <th>Delete user</th>
                </tr>
                <?php foreach ($this->users as $user) {
                    echo "<form method='post'><tr>";
                    echo "<td>" . $user->getFirstname() . "</td>";
                    echo "<td>" . $user->getLastname() . "</td>";
                    echo "<td>" . $user->getEmail() . "</td>";
                    echo "<td>" . $user->getUsername() . "</td>";
                    echo "<td>" . ($user->getIsadmin() ? "true" : "false") . "</td>";
                    echo "<td><input type='submit' name='setadmin' value='" . ($user->getIsadmin() ? "Demote" : "Promote") . "' /><input type='hidden' name='is_admin' value='" . ($user->getIsadmin() ? "true" : "false") . "'/></td>";
                    echo "<td><input type='submit' name='deleteuser' value='Delete' /><input type='hidden' name='id' value='" . $user->getId() . "'/></td>";
                    echo "</tr></form>";
                }
                echo "</table>";
                ?>
        </div>
    </div>
</div>
