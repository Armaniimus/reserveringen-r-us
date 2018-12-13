<?php

/**
 *
 */
class Controller_main {
    function __construct() {
        $this->TemplatingSystem = new TemplatingSystem("view/templates/default.tpl");
        $this->Context_DataHandler = new Context_DataHandler();
        $this->HtmlElements = new HtmlElements();
    }

    public function mydefault() {
        $data = $this->Context_DataHandler->getReserveringen();
        $table = $this->HtmlElements->generateButtonedTable($data, 'reserveringen', [1,1,0]);

        //reserverings overzicht
        $main = file_get_contents("view/partials/reserveringenoverzicht.html");
        $this->TemplatingSystem->setTemplateData("main", $main);
        $this->TemplatingSystem->setTemplateData("table", $table);
        $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
        return $this->TemplatingSystem->getParsedTemplate();
    }

    public function bestellingenoverzicht() {
        $data = $this->Context_DataHandler->getbestellingen();
        $table = $this->HtmlElements->generateButtonedTable($data, 'reserveringen', [1,1,0]);

        //reserverings overzicht
        $main = file_get_contents("view/partials/bestellingenoverzicht.html");
        $this->TemplatingSystem->setTemplateData("main", $main);
        $this->TemplatingSystem->setTemplateData("table", $table);
        $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
        return $this->TemplatingSystem->getParsedTemplate();
    }

    public function reserveringtoevoegen() {
        if (isset($_POST['submit']) && $_POST['submit']) {
            $this->Context_DataHandler->reserveringtoevoegen();
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
            $this->Context_DataHandler->bestellingtoevoegen();
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
}
?>
