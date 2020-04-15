<?php


/**
 * Class Router; rotes HTTP request to the right controller
 */
class Router
{
    private $routes = [
        /* Routes for User*/
        'default' => ['controller' => 'HomeController', 'action' => 'index'],
        'registerform' => ['controller' => 'AuthController', 'action' => 'showCreateForm'],
        'createuser' => ['controller' => 'AuthController', 'action' => 'addUser'],
        'migrate' => ['controller' => 'MigrationController', 'action' => 'migrateUser'],
        'login' => ['controller' => 'AuthController', 'action' => 'login'],
        'contact' => ['controller' => 'ContactController', 'action' => 'index'],
        'check' => ['controller' => 'AuthController', 'action' => 'check'],
        'logout' => ['controller' => 'AuthController', 'action' => 'logout'],
        'account' => ['controller' => 'AuthController', 'action' => 'accountPage'],

        /* Routes for Admin*/
        'adminpage' => ['controller' => 'AdminController', 'action' => 'adminPage'],


        /*Routes for Videos*/
        'videos' => ['controller' => 'VideosController', 'action' => 'videos'],
        'migratevideos' => ['controller' => 'MigrationController', 'action' => 'migrateVideos']
    ];

    /**
     * Runs the router which chooses the right controller by "do" variable in GET method.
     */
    public static function run()
    {
        $self = new self;
        $do = "default";
        if (isset($_GET["do"]) && $_GET["do"] !== "") {
            $do = $_GET["do"];
        }

        // Chooses the right route from the array

        if (array_key_exists($do, $self->routes)):
            $route = $self->routes[$do];
            $controller = new $route['controller']();
            $controller->{$route['action']}();
        else:
            var_dump("false page");
        endif;

    }
}