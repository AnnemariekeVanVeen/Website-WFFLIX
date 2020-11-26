<?php
/***
 * @authors Annemarieke van Veen and Katja Liotto
 * @copyright All rights reserved.
 */

/***
 * Class BaseModel; connects with the database
 */
abstract class BaseModel
{
    private $config;
    protected $conn;

    // Information of the database and login
    public function construct()
    {
        $this->config = [
            'hostname' => 'localhost',
            'user' => 'USERNAME',
            'passwd' => 'PASSWORD',
            'dbname' => 'DATABASENAME',
        ];
        $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
        $dsn = 'mysql:host=localhost;dbname=' . $this->config['dbname'];
        $this->conn = new PDO($dsn, $this->config['user'], $this->config['passwd'], $options);
    }
}
