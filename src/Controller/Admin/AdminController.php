<?php

namespace App\Controller\Admin;

use App\Repository\ProfileRepository;
use App\Entity\Profile;
use App\Form\ProfileType;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

	private $profile;

    private $em;

	public function __construct(ProfileRepository $profile, EntityManagerInterface $em)
	{
		$this->profile = $profile;
        $this->em = $em;
         

	}
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
    	$profiles = $this->profile->findAll();

        return $this->render('admin/index.html.twig', [
            'page_name' => 'BackOffice',
            'profiles' => $profiles,
        ]);
    }


    /**
    *@Route("/admin/nouveau_profil", name="admin.profile.new")
    *@param Request $request
    */
    public function new(Request $request)
    {
        $profile = new Profile();

        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            //# au cas où on n'ai pas appelé doctrine sous le namespace : #
            // $em = $this->getDoctrine()->getManager(); 
            // $em->persist($profile);
            // $em->flush();

            $this->em->persist($profile);
            $this->em->flush();
            $this->addFlash('success', 'Profil ajouté avec succès !');
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/new.html.twig', [
                   'page_name'  => 'Ajout (BackOffice)',
                   'profile'    => $profile,
                   'form'       => $form->createView(),
        ]);



    }

    /**
    *@Route("/admin/profil/{id}", name="admin.profile.edit", methods="GET|POST")
    *@param Profile $profile
    *@param Request $request
    */
    public function edit(Profile $profile, Request $request)
    {
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Profil modifié avec succès !');
            return $this->redirectToRoute('admin');
        }



        return $this->render('admin/edit.html.twig', [
                   'page_name'  => 'Edition (BackOffice)',
                   'profile'    => $profile,
                   'form'       => $form->createView(),
        ]);
    }

    /**
    *@Route("/admin/profil/{id}", name="admin.profile.delete", methods="DELETE")
    *@param Profile $profile
    */
    public function delete(Profile $profile, Request $request){
        if($this->isCsrfTokenValid('delete'.$profile->getId(), $request->get('_token'))){
        $this->em->remove($profile);
        $this->em->flush();
        $this->addFlash('success', 'Profil supprimé avec succès !');

        }
        return $this->redirectToRoute('admin');

    }

}
