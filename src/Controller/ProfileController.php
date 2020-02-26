<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Repository\ProfileRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
	/**
	*@var ProfileRepository
	*/
	private $repository;

	public function __construct(ProfileRepository $repository)
	{
		$this->repository = $repository;
	}


    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
    	$profiles = $this->repository->findAll();
    	dump($profiles);

        return $this->render('pages/profile.html.twig', [
            'page_name' => 'La Page Perso',
            'profiles' => $profiles

        ]);
    }

    /**
     * @Route("/profile/{slug}-{id}", name="show", requirements={"slug": "[a-z0-9\-]*"})
     * param Profile $profile
     */
    public function show(Profile $profile, string $slug)
    {
    	if ($profile->getSlug() !== $slug){
    		return $this->redirectToRoute('show', [
    			'id' => $profile->getId(),
    			'slug' => $profile->getSlug()
    		], 301);
    	}
    	return $this->render('pages/show.html.twig', [
    	'page_name' => 'Détails du profile',
    	'profile' => $profile

    	]);
   }


}
