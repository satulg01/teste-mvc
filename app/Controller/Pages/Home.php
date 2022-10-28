<?php
    namespace App\Controller\Pages;

	use \App\Utils\View\View;
	use \App\Model\Entity\Organization;

    /**
     * Método responsável por retornar o conteudo da nossa home
     * @return string
     */
    class Home extends Page{
        public static function getHome() {
            $obOrganization = new Organization;

            $content = View::render('pages/home', [
                "name" => $obOrganization->name
            ]);

            return self::getPage("Satulg > Home", $content);
        }
    }
?>