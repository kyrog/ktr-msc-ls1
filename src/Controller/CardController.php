<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    private $em;
    private $security;

    public function __construct(
        EntityManagerInterface $em,
        Security $security
    ){
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @Route("/card/create", name="card_create")
     */
    public function create(Request $request): Response
    {
        //$user = $this->security->getUser();
        //dd($user->getId());
        $card = new Card();

        $form = $this->createForm(CardType::class, $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $card->setUser($this->security->getUser());
            $this->em->persist($card);
            $this->em->flush();
            return $this->redirectToRoute('card_show');
        }

        return $this->render('card/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/card/show", name="card_show")
     */
    public function show(): Response
    {
        $user = $this->security->getUser()->getId();
        $cards = $this->em->getRepository(Card::class)->findByCurrentUser($user);

        return $this->render('card/show.html.twig', [
            'cards' => $cards,
        ]);
    }

}
