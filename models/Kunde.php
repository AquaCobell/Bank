<?php
class Kunde implements DatabaseObject
{
    private $email = '';
    private $password =  '';
    private $kontostand = '';
    private $vorname = '';
    private $nachname = '';
    private $iban = '';
    private $bic = '';
    private $verfügernr = '';

    private $error = [];

    /**
     * @return string
     */
    public function getKontostand()
    {
        return $this->kontostand;
    }

    /**
     * @param string $kontostand
     */
    public function setKontostand($kontostand)
    {
        $this->kontostand = $kontostand;
    }

    /**
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param array $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }



    /*public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    */
    public function __construct()
    {

    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;

    }


    public function setPassword($password)
    {
        $this->password = $password;
    }



    private function validateEmail()
    {

        if(filter_var($this->email, FILTER_VALIDATE_EMAIL && $this->email != ""))
        {
            $this->error['email'] = "E-mail ungültig";
            return false;
        }
        return true;
    }


    private function validatePassword()
    {

        if(strlen($this->password)<= 0)
        {
            return false;
        }
        else if(strlen($this->password)>20)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function validateName()
    {
        // Zugriff auf die globale Fehlervariable

        if (strlen($this ->vorname) == 0)  //stringlength
        {
            $errors['vorname'] = "Name darf nicht leer sein";
            return false;
        }
        else if (strlen($this->vorname) > 20)
        {
            $errors['vorname'] = "Name zu lang";
            return false;
        }
        else
        {
            return true;
        }

    }
    function validateNachname()
    {
        // Zugriff auf die globale Fehlervariable

        if (strlen($this ->nachname) == 0)  //stringlength
        {
            $errors['nachname'] = "Nachame darf nicht leer sein";
            return false;
        }
        else if (strlen($this->nachname) > 20)
        {
            $errors['nachname'] = "Nachname zu lang";
            return false;
        }
        else
        {
            return true;
        }

    }
    public function validate()
    {
        if($this->validateEmail()&& $this->validatePassword() && $this->validateName() && $this->validateNachName())
        {
            return true;
        }
        return false;
    }

    public function save()
    {
        if ($this->validate())
        {
            if ($this->id != null && $this->id > 0)
            {
                // known ID > 0 -> old object -> update
                $this->update();
            }
            else
            {
                // undefined ID -> new object -> create
                $this->gid = $this->create();
            }

            return true;
        }

        return false;
    }

    public function update()
    {
        $db = Database::connect();
        $sql = "UPDATE gast set name = ?, email = ?, adresse = ? WHERE gid = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->name, $this->email, $this->adresse, $this->gid));
        Database::disconnect();
    }

    public function create()
    {
        $db = Database::connect();
        $sql = "INSERT INTO kunde (vorname, nachname, email, iban, bic, verfügernr, password) values( ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->vorname, $this->nachname, $this->email, $this->iban, $this->bic, $this->verfügernr, $this->password));
        $lastId = $db->lastInsertId();  // get ID of new database-entry
        Database::disconnect();

        return $lastId;
    }

    //private $email = '';
    //private $password =  '';
    //private $kontostand = '';
    //private $vorname = '';
    //private $nachname = '';
    //private $iban = '';
    //private $bic = '';
    //private $verfügernr = '';

    /**
     * @inheritDoc
     */
    public static function get($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM kunde WHERE gid = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        // fetch dataset (row) per ID, convert to Credentials-object (ORM)
        $kunde = $stmt->fetchObject('Kunde');
        Database::disconnect();

        return $kunde !== false ? $kunde : null;
    }

    /**
     * @inheritDoc
     */
    public static function getAll()
    {

        $db = Database::connect();
        $sql = 'SELECT * FROM kunde ORDER BY id ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // fetch all datasets (rows), convert to array of Credentials-objects (ORM)
        $kunde = $stmt->fetchAll(PDO::FETCH_CLASS, 'Kunde');
        Database::disconnect();

        return $kunde;
    }

    /**
     * @inheritDoc
     */
    public static function delete($id)
    {
        $db = Database::connect();
        $sql = "DELETE FROM Kunde WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }
}
?>