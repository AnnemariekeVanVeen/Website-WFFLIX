<?php
/***
 * @authors Annemarieke van Veen and Katja Liotto
 * @copyright All rights reserved.
 */

/***
 * Class UserModel; connects with the database table users
 */
class UserModel extends BaseModel
{
    private $table = 'users';
    private $id;
    private $firstName, $lastName, $email, $username, $password, $is_admin;

    public function __construct()
    {
        parent::construct();
    }

    /**
     * @return string
     */
    public static function migrate()
    {

        $self = new self;

        try {
            $sql = 'CREATE TABLE IF NOT EXISTS ' . $self->getTable() . '(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,' .
                'first_name VARCHAR(50) NOT NULL,' .
                'last_name VARCHAR(50),' .
                'email VARCHAR(255),' .
                'username VARCHAR(50) UNIQUE,' .
                'password VARCHAR(255) NOT NULL,' .
                'is_admin BOOL NOT NULL DEFAULT(FALSE))';

            if ($stmt = $self->conn->prepare($sql)):
                $stmt->execute();

                return 'Users table created';
            else:
                return 'Error creating Users table';
            endif;
        } catch (PDOException $exception) {
            die($exception->getMessage()); // getting the message of the error
        }
    }

    /**
     * @param integer $id
     * @return bool|UserModel
     */
    public static function find($id)
    {
        $self = new self;

        $sql = "SELECT * FROM {$self->getTable()} WHERE id = :id";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $data = $stmt->fetch();
            $self = $self->loadData($self, $data);

            return $self;
        else:
            return false;
        endif;
    }

    /**
     * @param string $key
     * @param string $data
     * @return bool|UserModel
     */
    public static function find_by($key, $data)
    {
        $self = new self;

        $sql = "SELECT * FROM {$self->getTable()} WHERE $key = :value";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindParam(':value', $data);
            $stmt->execute();

            $row = $stmt->fetch();
            $self = $self->loadData($self, $row);

            return $self;
        else:
            return false;
        endif;
    }

    /**
     * @return array|bool
     */
    public static function all()
    {
        $self = new self;
        $result = [];

        $sql = "SELECT * FROM {$self->getTable()}";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->execute();

            $data = $stmt->fetchall();

            foreach ($data as $row):
                $tmp = new self;
                $tmp = $tmp->loadData($tmp, $row);

                array_push($result, $tmp);
            endforeach;

            return $result;
        else:
            return false;
        endif;
    }

    /**
     * @param string $key
     * @param string $data
     * @return bool|UserModel
     */
    public static function find_byAdmin($key, $data)
    {
        $self = new self;
        $sql = "SELECT * FROM {$self->getTable()} WHERE $key = :value";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindValue(':value', $data);
            $stmt->execute();

            $row = $stmt->fetch();
            $self = $self->loadData($self, $row);

            return $self;
        else:
            return false;
        endif;
    }

    /**
     * @return array|bool
     */
    public static function allAdmin()
    {
        $self = new self;
        $result = [];

        $sql = "SELECT * FROM {$self->getTable()}";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->execute();

            $data = $stmt->fetchall();

            foreach ($data as $row):
                $tmp = new self;
                $tmp = $tmp->loadData($tmp, $row);

                array_push($result, $tmp);
            endforeach;

            return $result;
        else:
            return false;
        endif;
    }

    /**
     * @param array $data
     * @return bool|UserModel
     */
    public static function create($data)
    {
        $self = new self;
        $sql = 'INSERT INTO ' . $self->getTable() . '(first_name, last_name, email, username, password)' .
            ' VALUES (:first_name, :last_name, :email, :username, :password)';

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindValue(':first_name', $data['first_name']);
            $stmt->bindValue(':last_name', $data['last_name']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT));
            $stmt->bindValue(':username', $data['username']);

            if ($stmt->execute()):
                $sql2 = "SELECT * FROM {$self->getTable()} WHERE username = :username";
                if ($stmt2 = $self->conn->prepare($sql2)):
                    $stmt2->bindParam(':username', $data['username'], PDO::PARAM_STR);
                    if (!$stmt2->execute()) {
                        print_r($self->conn->errorInfo());
                        return false;
                    }
                    return self::find($stmt2->fetch()['id']);
                endif;
            else:
                print_r($self->conn->errorInfo());
            endif;
        endif;
        return false;
    }

    public static function setAdmin($id, bool $is_admin)
    {
        $self = new self;
        $sql = 'UPDATE ' . $self->getTable() . ' SET is_admin = :is_admin WHERE id = :id';
        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':is_admin', $is_admin ? 1 : 0);
            if ($stmt->execute()):
                return true;
            endif;
        endif;
        return false;
    }

    /**
     * @return bool
     */
    public function update()
    {
        $sql = "UPDATE users SET first_name = :first_name, email = :email, last_name = :last_name, 
                username= :username, password= :password WHERE id = :id";

        if ($stmt = $this->conn->prepare($sql)):
            $stmt->bindValue(':first_name', $this->firstName);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':last_name', $this->lastName);
            $stmt->bindValue(':username', $this->username);
            $stmt->bindValue(':password', $this->password);
            $stmt->bindValue(':id', $this->id);

            return $stmt->execute();
        endif;
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function destroy($id)
    {
        $self = new self;
        $sql = "DELETE FROM users WHERE id = :id";

        if ($stmt = $self->conn->prepare($sql)):
            $stmt->bindValue(":id", $id);

            return $stmt->execute();
        endif;
        return false;
    }

    /**
     * @param UserModel $self
     * @param array $data
     * @return UserModel
     */
    private function loadData($self, $data)
    {
        $self->setId($data['id']);
        $self->setFirstName($data['first_name']);
        $self->setEmail($data['email']);
        $self->setLastName($data['last_name']);
        $self->setUsername($data['username']);
        $self->setPassword($data['password']);
        $self->setIsAdmin($data['is_admin']);

        return $self;
    }

    /*----------------------------- Getters and Setters ----------------------------------------*/

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;
    }
}