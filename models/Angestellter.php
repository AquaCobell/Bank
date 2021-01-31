<?php

require_once "DatabaseObject.php";

class Angestellter implements DatabaseObject
{
    private $id = 0;
    private $name = '';
    private $email = '';
    private $passwort = '';

    private $errors = [];

    public function validate()
    {
        return $this->validateHelper('Name', 'name', $this->name, 32) &
            $this->validateHelper('E-mail', 'email', $this->email, 28) &
            $this->validateHelper('passwort', 'passwort', $this->passwort, 28);
    }


    public function save()
    {
        if ($this->validate()) {
            if ($this->id != null && $this->id > 0) {
                // known Nr > 0 -> old object -> update
                $this->update();
            } else {
                // undefined Nr -> new object -> create
                $this->id = $this->create();
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function create()
    {
        $db = Database::connect();
        $sql = "INSERT INTO gast (name, email, passwort) values( ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->email, $this->passwort));
        $lastId = $db->lastInsertId();  // get ID of new database-entry
        Database::disconnect();

        return $lastId;
    }

    /**
     * @inheritDoc
     */
    public function update()
    {
        $db = Database::connect();
        $sql = "UPDATE gast set name = ?, email = ?, passwort = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->email, $this->passwort, $this->id));
        Database::disconnect();
    }

    /**
     * @inheritDoc
     */
    public static function get($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM gast WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        // fetch dataset (row) per ID, convert to Credentials-object (ORM)
        $guest = $stmt->fetchObject('Gast');
        Database::disconnect();

        return $guest !== false ? $guest : null;    }

    /**
     * @inheritDoc
     */
    public static function getAll()
    {
        $db = Database::connect();
        $sql = 'SELECT * FROM gast ORDER BY id ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // fetch all datasets (rows), convert to array of Credentials-objects (ORM)
        $guests = $stmt->fetchAll(PDO::FETCH_CLASS, 'Gast');
        Database::disconnect();

        return $guests;
    }

    /**
     * @inheritDoc
     */
    public static function delete($id)
    {
        $db = Database::connect();
        $sql = "DELETE FROM gast WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }
    private function validateHelper($label, $key, $value, $maxLength)
    {
        if (strlen($value) == 0) {
            $this->errors[$key] = "$label darf nicht leer sein";
            return false;
        } else if (strlen($value) > $maxLength) {
            $this->errors[$key] = "$label zu lang (max. $maxLength Zeichen)";
            return false;
        } else {
            return true;
        }
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getpasswort()
    {
        return $this->passwort;
    }

    /**
     * @param mixed $passwort
     */
    public function setpasswort($passwort)
    {
        $this->passwort = $passwort;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}
