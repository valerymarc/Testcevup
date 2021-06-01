<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Utilisateur;
use App\Form\SearchType;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @var UtilisateurRepository
     */
    private $repo;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(UtilisateurRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }
    

    /** 
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
    
        $utilisateur = $this->repo->findSearch($data);
        return $this->render('utilisateur/home.html.twig', [
            'users' => $utilisateur,
            'form' => $form->createView() 
        ]);
    }



    /**
     * @Route("/utilisateur", name="user")
     */
    public function index(): Response
    { 
        $utilisateurs = $this->repo->findAll();
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs
        ]);
    }


    /**
     *
     * @Route("utilisateur/create", name="user_create")
     */
    public function new(Request $request)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($utilisateur);
            $this->em->flush();
            $this->addFlash('success', 'Nouvel utilisateur crée !');
            return $this->redirectToRoute('user');
        }
        return $this->render('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView()
       ]);
    }

    /**
     * @Route("/utilisateur/{id}", name="user_edit", methods="GET|POST")
     */
    public function edit(Utilisateur $utilisateur, Request $request)
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Utilusateur mis à jour !');
            return $this->redirectToRoute('user');
        }

        return $this->render('utilisateur/edit.html.twig', [
             'utilisateur' => $utilisateur,
             'form' => $form->createView()
        ]);
    }


    /** 
     * @Route("/utilisateur/delete/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, Utilisateur $utilisateur)
    {
       if($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token')))
       {
          $this->em->remove($utilisateur);
          $this->em->flush();
          $this->addFlash('success', 'Utilisateur supprimé!');
       }
       return $this->redirectToRoute('user');
    }
}
