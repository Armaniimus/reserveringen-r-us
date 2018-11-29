<?php

/**
 *
 */
class Controller_main {
    function __construct() {
        $this->TemplatingSystem = new TemplatingSystem("view/templates/default.tpl");
        $this->DataHandler = new DataHandler(DB_NAME, DB_USERNAME, DB_PASS, DB_SERVER_ADRESS, DB_TYPE);
        $this->HtmlElements = new HtmlElements();
    }

    public function mydefault() {
        $data = $this->getReserveringen();
        $table = $this->HtmlElements->generateButtonedTable($data, 'reserveringen', [1,1,0]);

        //reserverings overzicht
        $main = file_get_contents("view/partials/reserveringenoverzicht.html");
        $this->TemplatingSystem->setTemplateData("main", $main);
        $this->TemplatingSystem->setTemplateData("table", $table);
        $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
        return $this->TemplatingSystem->getParsedTemplate();
    }

    public function reserveringtoevoegen() {
        if (isset($_POST['submit']) && $_POST['submit']) {
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
            header('location: /main');

        } else {
            $main = file_get_contents("view/partials/reserveringtoevoegen.html");
            $this->TemplatingSystem->setTemplateData("main", $main);
            $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
            return $this->TemplatingSystem->getParsedTemplate();
        }
    }

    public function bestellingtoevoegen($parameters = null) {

        if (isset($_POST['submit']) && $_POST['submit']) {
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
            header('location: /main/bestellingenoverzicht');

        } else {
            $reserveringenID = $parameters[0];
            $tafelnummer = $parameters[1];

            $main = file_get_contents("view/partials/bestellingtoevoegen.html");
            $this->TemplatingSystem->setTemplateData("main", $main);
            $this->TemplatingSystem->setTemplateData("reserveringenID", $reserveringenID);
            $this->TemplatingSystem->setTemplateData("tafelnummer", $tafelnummer);

            $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
            return $this->TemplatingSystem->getParsedTemplate();
        }
    }

    public function bestellingenoverzicht() {
        $data = $this->getbestellingen();
        $table = $this->HtmlElements->generateButtonedTable($data, 'reserveringen', [1,1,0]);

        //reserverings overzicht
        $main = file_get_contents("view/partials/bestellingenoverzicht.html");
        $this->TemplatingSystem->setTemplateData("main", $main);
        $this->TemplatingSystem->setTemplateData("table", $table);
        $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
        return $this->TemplatingSystem->getParsedTemplate();
    }

    private function getReserveringen($where = null) {
        $sql = "SELECT *
        FROM `reserveringen-R-us`.`Reserveringen`
        $where";

        $data = $this->DataHandler->readData($sql);
        return $data;
    }

    private function getBestellingen($where = null) {
        $sql = "SELECT *
        FROM `reserveringen-R-us`.`Bestellingen`
        $where";

        $data = $this->DataHandler->readData($sql);
        return $data;
    }
}
?>
