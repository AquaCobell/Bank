<?php
require_once "DatabaseObject.php";
require_once "Database.php";
class Kunde //implements DatabaseObject
{
    private $id = '';
    private $email = '';
    private $passwort =  '';
    private $kontostand = '';
    private $vorname = '';
    private $nachname = '';
    private $BIC = '';
    private $verfügernr;
    private $error;


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * @param string $vorname
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * @param string $nachname
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getVerfügernr()
    {
        return $this->verfügernr;
    }

    /**
     * @param string $verfügernr
     */
    public function setVerfügernr($verfügernr)
    {
        $this->verfügernr = $verfügernr;
    }


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


    public function getPasswort()
    {
        return $this->passwort;

    }


    public function setPasswort($passwort)
    {
        $this->passwort = $passwort;
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


    private function validatePasswort()
    {

        if(strlen($this->passwort)<= 0)
        {
            return false;
        }
        else if(strlen($this->passwort)>20)
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
        if($this->validateEmail()&& $this->validatePasswort() && $this->validateName() && $this->validateNachName())
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
                $this->id = $this->create();
            }

            return true;
        }

        return false;
    }

    public function update()
    {
        $db = Database::connect();
        $sql = "UPDATE kunde set vorname = ?, nachname = ?, email = ?, passwort = ?, kontostand = ?  WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->vorname, $this->nachname, $this->email, $this->passwort, $this->kontostand, $this->id));
        Database::disconnect();
    }

    public function create()
    {
        $db = Database::connect();
        $sql = "INSERT INTO kunde (vorname, nachname, email, passwort) values( ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->vorname, $this->nachname, $this->email,  $this->passwort));
        $lastId = $db->lastInsertId();  // get ID of new database-entry
        Database::disconnect();

        return $lastId;
    }

    //private $email = '';
    //private $passwort =  '';
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
        $sql = "SELECT * FROM kunde WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        // fetch dataset (row) per ID, convert to Credentials-object (ORM)
        $kunde = $stmt->fetchObject('Kunde');
        Database::disconnect();

        return $kunde !== false ? $kunde : null;
    }

    public static function getKundewithEmail($email)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM kunde WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        // fetch dataset (row) per ID, convert to Credentials-object (ORM)
        $kunde = $stmt->fetchObject('Kunde');
        Database::disconnect();

        return $kunde !== false ? $kunde : null;
    }

    public static function getKundewithIban($iban)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM kunde WHERE iban = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($iban));
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