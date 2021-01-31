<?php


class Ueberweisung //implements DatabaseObject.php
{
    private $id = '';
    private $ibansender = '';
    private $bicsender = '';
    private $ibanempfaenger = '';
    private $bicempfaenger = '';
    private $absenderid = '';
    private $empfaengerid = '';
    private $zahlungsreferenz = '';
    private $verwendungszweck = '';
    private $betrag = '';
    private $datum='';

    /**
     * Überweisung constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getIbansender()
    {
        return $this->ibansender;
    }

    /**
     * @param string $ibansender
     */
    public function setIbansender($ibansender)
    {
        $this->ibansender = $ibansender;
    }

    /**
     * @return string
     */
    public function getBicsender()
    {
        return $this->bicsender;
    }

    /**
     * @param string $bicsender
     */
    public function setBicsender($bicsender)
    {
        $this->bicsender = $bicsender;
    }

    /**
     * @return string
     */
    public function getIbanempfaenger()
    {
        return $this->ibanempfaenger;
    }

    /**
     * @param string $ibanempfaenger
     */
    public function setIbanempfaenger($ibanempfaenger)
    {
        $this->ibanempfaenger = $ibanempfaenger;
    }

    /**
     * @return string
     */
    public function getBicempfaenger()
    {
        return $this->bicempfaenger;
    }

    /**
     * @param string $bicempfaenger
     */
    public function setBicempfaenger($bicempfaenger)
    {
        $this->bicempfaenger = $bicempfaenger;
    }

    /**
     * @return string
     */
    public function getAbsenderid()
    {
        return $this->absenderid;
    }

    /**
     * @param string $absenderid
     */
    public function setAbsenderid($absenderid)
    {
        $this->absenderid = $absenderid;
    }

    /**
     * @return string
     */
    public function getEmpfaengerid()
    {
        return $this->empfaengerid;
    }

    /**
     * @param string $empfaengerid
     */
    public function setEmpfaengerid($empfaengerid)
    {
        $this->empfaengerid = $empfaengerid;
    }



    /**
     * @return string
     */
    public function getIBAN()
    {
        return $this->IBAN;
    }

    /**
     * @param string $IBAN
     */
    public function setIBAN($IBAN)
    {
        $this->IBAN = $IBAN;
    }

    /**
     * @return string
     */
    public function getBIC()
    {
        return $this->BIC;
    }

    /**
     * @param string $BIC
     */
    public function setBIC($BIC)
    {
        $this->BIC = $BIC;
    }

    /**
     * @return string
     */
    public function getAbender()
    {
        return $this->Abender;
    }

    /**
     * @param string $Abender
     */
    public function setAbender($Abender)
    {
        $this->Abender = $Abender;
    }

    /**
     * @return string
     */
    public function getEmpfänger()
    {
        return $this->Empfänger;
    }

    /**
     * @param string $Empfänger
     */
    public function setEmpfänger($Empfänger)
    {
        $this->Empfänger = $Empfänger;
    }

    /**
     * @return string
     */
    public function getZahlungsreferenz()
    {
        return $this->Zahlungsreferenz;
    }

    /**
     * @param string $Zahlungsreferenz
     */
    public function setZahlungsreferenz($Zahlungsreferenz)
    {
        $this->zahlungsreferenz = $Zahlungsreferenz;
    }

    /**
     * @return string
     */
    public function getVerwendungszweck()
    {
        return $this->Verwendungszweck;
    }

    /**
     * @param string $Verwendungszweck
     */
    public function setVerwendungszweck($Verwendungszweck)
    {
        $this->verwendungszweck = $Verwendungszweck;
    }

    /**
     * @return string
     */
    public function getBetrag()
    {
        return $this->Betrag;
    }

    /**
     * @param string $Betrag
     */
    public function setBetrag($Betrag)
    {
        $this->betrag = $Betrag;
    }

    /**
     * @return string
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param string $Datum
     */
    public function setDatum($Datum)
    {
        $this->Datum = $Datum;
    }

    public static function getAll()
    {

        $db = Database::connect();
        $sql = 'SELECT * FROM ueberweisung ORDER BY id ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // fetch all datasets (rows), convert to array of Credentials-objects (ORM)
        $ueberweisung = $stmt->fetchAll(PDO::FETCH_CLASS, 'Ueberweisung');
        Database::disconnect();

        return $ueberweisung;
    }


    public static function delete($id)
    {
        $db = Database::connect();
        $sql = "DELETE FROM ueberweisung WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }

    public static function get($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM ueberweisung WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        // fetch dataset (row) per ID, convert to Credentials-object (ORM)
        $ueberweisung = $stmt->fetchObject('Ueberweisung');
        Database::disconnect();

        return $ueberweisung !== false ? $ueberweisung : null;
    }

    public function create()
    {
        $db = Database::connect();
        $sql = "INSERT INTO ueberweisung (ibansender, bicsender, absenderid, empfaengerid,
                zahlungsreferenz, verwendungszweck, betrag, datum, ibanempfaenger,bicempfaenger) values( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->ibansender, $this->bicsender, $this->absenderid,  $this->empfaengerid, $this->zahlungsreferenz,
            $this->verwendungszweck, $this->betrag, $this->datum, $this->ibanempfaenger, $this->bicempfaenger));
        $lastId = $db->lastInsertId();  // get ID of new database-entry
        Database::disconnect();

        return $lastId;
    }

    public function update()
    {
        $db = Database::connect();
        $sql = "UPDATE ueberweisung set name = ibansender = ?, bicsender = ?, absenderid = ?, empfaengerid = ?,
                zahlungsreferenz = ?, verwendungszweck = ?, betrag = ?, datum = ?, ibanempfaenger = ?,bicempfaenger = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->ibansender, $this->bicsender, $this->absenderid,  $this->empfaengerid, $this->zahlungsreferenz,
            $this->verwendungszweck, $this->betrag, $this->datum, $this->ibanempfaenger, $this->bicempfaenger));
        Database::disconnect();
    }

    public static function getUberweisungperIban($iban)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM ueberweisung WHERE ibansender = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($iban));
        // fetch dataset (row) per ID, convert to Credentials-object (ORM)
        $ueberweisung = $stmt->fetchObject('Ueberweisung');
        //$ueberweisung = $stmt->fetchAll();
        //return $ueberweisung;
        Database::disconnect();
        //return $ueberweisung;
        return $ueberweisung !== false ? $ueberweisung : null;
    }

    public function save()
    {
       /* if ($this->validate())
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
        }*/
        if ($this->id != null && $this->id > 0)
        {
            // known ID > 0 -> old object -> update
            $this->update();
        }
        else
        {
            // undefined ID -> new object -> create
            $this->id = $this->create();

            $empfaenger1 = Kunde::get($this->empfaengerid);
            $sender1 = Kunde::get($this->absenderid);
            //$empfaenger1->getKontostand()+$this->betrag
            //$geld = $empfaenger1->getBetrag()+$this->betrag;
            //$empfaenger1->setKontostand(1);
            $empfaenger1->setKontostand($empfaenger1->getKontostand()+$this->betrag);
            $sender1->setKontostand($sender1->getKontostand()-$this->betrag);
            $empfaenger1->save();
            $sender1->save();

        }



        return true;
    }







}