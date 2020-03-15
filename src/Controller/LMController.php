<?php

namespace App\Controller;
use App\Repository\LMRepository;
use App\Entity\LM;

use Doctrine\ORM\EntityManagerInterface; // Connexion a la base de données
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LMController extends AbstractController
{

	/**
	*@var LMRepository
	*/
	private $repository;

	public function __construct(LMRepository $repository)
	{
		$this->repository = $repository;
	}


    /**
     * @Route("/lm", name="lm")
     */
    public function index()
    {
    	#si l'entreprise saisie est dans le tableau $entreprise, alors afficher la lettre de motivation correspondante,
    	#sinon, 
    	#afficher la page par défaut : un bouton pour m'envoyer un mail, un bouton pour accèder au cv en ligne, un bouton pour danser la polka (?)
    	#faire la gestion du formulaire ici
    	#s'il est en methode GET, ça suffit pour passer l'id dans l'url
    	#attention : la réponse doit entrainer le chargement d'une page 
    		#chaque valeur du tableau doit être une route genre {{ path:/lm/one }}
    			#fonctionne comme lorsqu'en cliquant sur une ligne de réunion, ça amène à la page de ladite réunion

    	if(!empty($_POST)){
    		$errors=[];
    		$success = false;

    	    $safe = array_map('trim', array_map('strip_tags', $_POST));
    	    
		    $nameExists = $this->getDoctrine()->getRepository(LM::class)->findOneBy(['name_entreprise' => $safe['name']]);
    	   ///////////////////////////////////////// tableau d'erreur                                                     

	    	if(empty($nameExists)){
	    		$errors[] = 'Cette entreprise n\'a pas été trouvé dans la base de données. S\'il s\'agit d\'un nom composé, toutes les parties du nom sont nécessaires.';
	    	}


			if(count($errors) == 0 ){
		   		$success = true;
		   	}
		   	else {
                $errorsForm = implode('<br>', $errors);
            }
		}


        return $this->render('lm/index.html.twig', [
            'page_name'			=> 'Lettre de Motivation',
            'success'           => $success ?? false,
            'errors'            => $errorsForm ?? [],
            'donnees_saisies'   => $safe ?? [],
            'ent_select'		=> $nameExists ?? [],
        ]);
    }
}
