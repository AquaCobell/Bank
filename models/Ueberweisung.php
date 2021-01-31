<?php


class Ueberweisung //implements DatabaseObject.php;
{
    private $iban = '';
    private $bic = '';
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
        $this->Zahlungsreferenz = $Zahlungsreferenz;
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
        $this->Verwendungszweck = $Verwendungszweck;
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
        $this->Betrag = $Betrag;
    }

    /**
     * @return string
     */
    public function getDatum()
    {
        return $this->Datum;
    }

    /**
     * @param string $Datum
     */
    public function setDatum($Datum)
    {
        $this->Datum = $Datum;
    }




}