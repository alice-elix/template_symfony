<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CVController extends AbstractController
{
    /**
     * @Route("/cv", name="cv")
     */
    public function index()
    {
    	//Tableaux de données

    	//Noms des sections
    	$sections = [ 
    	    'competences'   => 'Compétences',
    	    'experiences'   => 'Expériences',
    	    'formations'    => 'Formations' ,
    	    'contact'       => 'Contact'
    	];

    	//Logos

    	$id = 1;
    	$logosWeb = [ 'html','css', 'js', 'bootstrap', 'jQuery', 'wordpress', 'php', 'mySql', 'symfony' ];
    	$logosApli = ['cordova','androidStudio','ionic'];
    	$logosComm = [ 'git','slack','trello'];

    	//Footer

    	$imgsFooter = [
    	    'l1' => 'Lire',
    	    'l2' => 'Ecrire',
    	    'l3' => 'Apprendre',
    	    'l4' => 'Débattre',
    	    'l5' => 'Origami',
    	    'l6' => 'Cuisiner',
    	];

        return $this->render('cv/index.html.twig', [
        	'page_name' => 'CV',
        	'sections'	=> $sections,
        	'id'		=> $id,
        	'logosWeb' 	=> $logosWeb,
        	'logosApli' 	=> $logosApli,
        	'logosComm' => $logosComm,
        	'imgsFooter' => $imgsFooter,
        ]);
    }
}
