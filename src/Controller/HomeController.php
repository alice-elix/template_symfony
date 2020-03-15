<?php

namespace App\Controller;

use App\Entity\Actions;
use App\Repository\ActionsRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

	/**
	*@var ActionsRepository
	*/
	private $repository;

	public function __construct(ActionsRepository $repository)
	{
		$this->repository = $repository;
	}


    /**
     * @Route("/home", name="home")
     */
    public function index()
    {

        // $action = new Actions();
        // $action->setType('Job') 
        //      ->setName('Consulter la lettre de motivation')
        //      ->setHref('#');

        // $em = $this->getDoctrine()->getManager(); 
        // $em->persist($action); 
        // $em->flush(); 

        $a4f = $this->repository->findByType('Fun');
        $a4j = $this->repository->findByType('Job');

        return $this->render('pages/index.html.twig', [
            'page_name' => 'l\'accueil',
            'as4f' => $a4f,
            'as4j' => $a4j
        ]);
    }
}
