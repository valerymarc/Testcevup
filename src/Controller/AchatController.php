<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Form\AchatType;
use App\Repository\AchatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AchatController extends AbstractController
{
    
    
    /**
     * @var AchatRepository
     */
    private $repo;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(AchatRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }
    
    /**
     * @Route("/achat", name="achat")
     */
    public function index(): Response
    {
        $achats = $this->repo->findAll();
        return $this->render('achat/index.html.twig', [
            'controller_name' => 'AchatController',
            'achats' => $achats
        ]);
    }

    /**
     *
     * @Route("/achat/new", name="achat_create")
     */
    public function new(Request $request)
    {
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($achat);
            $this->em->flush();
            $this->addFlash('success', 'Nouvel achat crée !');
            return $this->redirectToRoute('achat');
        }
        return $this->render('achat/new.html.twig', [
            'achat' => $achat,
            'form' => $form->createView()
       ]);
    }


    /**
     * @Route("/achat/{id}", name="achat_edit", methods="GET|POST")
     */
    public function edit(Achat $achat, Request $request)
    {
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Achat mis à jour !');
            return $this->redirectToRoute('achat');
        }

        return $this->render('achat/edit.html.twig', [
             'achat' => $achat,
             'form' => $form->createView()
        ]);
    }


    /** 
     * @Route("/achat/delete/{id}", name="achat_delete", methods="DELETE")
     */
    public function delete(Request $request, Achat $achat)
    {
       if($this->isCsrfTokenValid('delete'.$achat->getId(), $request->request->get('_token')))
       {
          $this->em->remove($achat);
          $this->em->flush();
          $this->addFlash('success', 'Achat supprimé!');
       }
       return $this->redirectToRoute('achat');
    }
}
