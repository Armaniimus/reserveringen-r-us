<?php
    /**
     *
     */
    class Context_DataHandler {
        private $DataHandler;
        function __construct() {
            $this->DataHandler = new DataHandler(DB_NAME, DB_USERNAME, DB_PASS, DB_SERVER_ADRESS, DB_TYPE);
        }

        public function getReserveringen($where = null) {
            $sql = "SELECT *
            FROM `reserveringen-R-us`.`Reserveringen`
            $where";

            $data = $this->DataHandler->readData($sql);
            return $data;
        }

        public function getBestellingen($where = null) {
            $sql = "SELECT *
            FROM `reserveringen-R-us`.`Bestellingen`
            $where";

            $data = $this->DataHandler->readData($sql);
            return $data;
        }

        public function reserveringtoevoegen() {
            $tafelnummer = $_POST['tafelnummer'];
            $datum = $_POST['datum'];
            $tijd = $_POST['tijd'];
            $klant_voornaam = $_POST['klant_voornaam'];
            $klant_achternaam = $_POST['klant_achternaam'];
            $status = $_POST['status'];
            $datumVanToevoegen = $_POST['datum_van_toevoegen'];
            $aantalTotaal = $_POST['aantal_totaal'];
            $aantalKinderen = $_POST['aantal_kinderen'];
            $allergieen = $_POST['allergieen'];
            $opmerkingen = $_POST['opmerkingen'];

            $sql = "INSERT INTO `reserveringen-R-us`.`Reserveringen` (`tafelnummer`, `datum`, `tijd`, `klant voornaam`, `klant achternaam`, `status`, `datum van toevoegen`, `aantal totaal`, `aantal kinderen`, `allergieen`, `opmerkingen`)
            VALUES ($tafelnummer, '$datum', '$tijd', '$klant_voornaam', '$klant_achternaam', '$status', '$datumVanToevoegen', $aantalTotaal, $aantalKinderen, '$allergieen', '$opmerkingen')";

            $data = $this->DataHandler->createData($sql);
        }

        public function bestellingtoevoegen() {
            $reserveringenID = $_POST['reserveringenID'];
            $tafelnummer = $_POST['tafelnummer'];

            $datum = $_POST['datum'];
            $tijd = $_POST['tijd'];
            $menuItemCode = $_POST['menu_item_code'];
            $aantal = $_POST['aantal'];
            $prijs = $_POST['prijs'];

            $sql = "INSERT INTO `reserveringen-R-us`.`Bestellingen` (reserveringenID, tafelnummer, datum, tijd, `menu item code`, aantal, prijs)
            VALUES ($reserveringenID, $tafelnummer, '$datum', '$tijd', '$menuItemCode', '$aantal', '$prijs')";

            $data = $this->DataHandler->createData($sql);
        }
    }
 ?>
