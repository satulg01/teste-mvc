<?php
    namespace App\Controller\Pages;

	use \App\Utils\View\View;
	use \App\Model\Entity\Organization;

    /**
     * Método responsável por retornar o conteudo da nossa home
     * @return string
     */
    class About extends Page{
        public static function getAbout() {
            $obOrganization = new Organization;

            $content = View::render('pages/about', [
                "name" => $obOrganization->name,
                "description" => $obOrganization->description
            ]);

            return self::getPage("Satulg > Sobre", $content);
        }
    }
?>