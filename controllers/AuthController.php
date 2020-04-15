<?php
/***
 * @authors Annemarieke van Veen and Katja Liotto
 * @copyright All rights reserved.
 */

/**
 * Class AuthController; connects with the authentication view
 */
class AuthController extends BaseController
{
    public $file = './views/auth/';
    public $style = 'src/css/';
    public $status;

    // If a user exist he can login
    public function login()
    {
        $this->file .= 'login.view.php';
        $this->style .= 'login.css';
        $this->render();
    }

    // user logs out and is redirect to the default page
    public function logout()
    {
        $_SESSION = [];
        header('location: index.php?do=default');
        Session::clearFlash();
    }

    // Checks if the email exist and checks in the session of the user is admin
    public function check()
    {
        //die(var_dump($_POST));
        if ($user = UserModel::find_by('username', $_POST['username'])):
            //die(var_dump($user));
            if ($_SESSION['is_admin'] = $user->getIsAdmin()):
                if (password_verify($_POST['password'], $user->getPassword())):
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_name'] = $user->getUsername();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['first_name'] = $user->getFirstName();
                    $_SESSION['last_name'] = $user->getLastName();
                    $_SESSION['login'] = true;
                    $_SESSION['is_admin'] = true;
                    Session::flash('alert', 'Login Successful');
                    header('location: index.php?do=adminpage');
                else:
                    Session::flash('alert', 'Login Failed');
                    header('location: index.php?do=login');
                endif;
            else:
                if (!empty(password_verify($_POST['password'], $user->getPassword()))):
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_name'] = $user->getUsername();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['first_name'] = $user->getFirstName();
                    $_SESSION['last_name'] = $user->getLastName();
                    $_SESSION['login'] = true;
                    $_SESSION['is_admin'] = false;
                    header('location: index.php?do=default');
                else:
                    Session::flash('alert', 'Login Failed');
                    header('location: index.php?do=login');
                endif;
            endif;
        // Password is not valid
        else:
            Session::flash('alert', 'Login Failed');
            header('location: index.php?do=login');
        endif;
    }

    // registers user
    public function addUser()
    {
        //die(var_dump($_POST));
        if (UserModel::create($_POST)):
            Session::flash('alert', 'Registration is successful');
            header('location: index.php?do=login');
        // registration is failed
        else:
            Session::flash('alert', 'Registration failed');
            header('location: index.php?do=registerform');
        endif;
    }

    // Shows registerform
    public function showCreateForm()
    {
        $this->file .= 'registration.view.php';
        $this->style .= 'contact.css';
        $this->render();
    }

    // User can modify account settings
    public function accountPage()
    {
        if (isset($_POST["email"]) && isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["user_name"])) {
            // Usermodel updates account settings
            if ($_SESSION["email"] !== $_POST["email"]) {
                $this->status = "You can only change your own account";
            } else {
                $user = UserModel::find_by('email', $_POST["email"]);
                $user->setFirstName($_POST["first_name"]);
                $user->setLastName($_POST["last_name"]);
                $user->setUsername($_POST["user_name"]);
                if (isset($_POST["password"]) && !empty($_POST["password"])) {
                    // User model updates password
                    $user->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
                }
                // Shows that the update had been successful
                if ($user->update()) {

                    $_SESSION["first_name"] = $_POST["first_name"];
                    $_SESSION["last_name"] = $_POST["last_name"];
                    $_SESSION["user_name"] = $_POST["user_name"];
                    $this->status = "Changes has been succesful updated";
                } else {
                    $this->status = "Unknown Error";
                }

            }
        }

        $this->file .= 'account.view.php';
        $this->style .= 'contact.css';
        $this->render();
    }
}
