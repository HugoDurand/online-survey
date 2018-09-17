<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\AddSessionType;
use AppBundle\Entity\QuestadpSession;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends Controller
{
    /**
     * @Route("/sessions", name="sessionhome")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('AppBundle:QuestadpSession')->findAll();

        return $this->render('AdminBundle:QuestadpSession:index.html.twig', array(
            'session'=>$session
        ));
    }





    /**
     * @Route("/sessions/edit/{id}", name="editSessionAction")
     */
    public function editSessionAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('AppBundle:QuestadpSession')->findOneById($request->get('id'));
        $form = $this->createForm(AddSessionType::class, $session);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('sessionhome');
        }


        return $this->render('AdminBundle:QuestadpSession:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }






    /**
     * @Route("/sessions/add", name="addSessionAction")
     */
    public function addSessionAction(Request $request)
    {


        $session = new QuestadpSession();
        $form = $this->createForm(AddSessionType::class, $session);



        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('sessionhome');
        }

        return $this->render('AdminBundle:QuestadpSession:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/sessions/show/{id}", name="showSessionAction")
     */
    public function showSessionAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('AppBundle:QuestadpSession')->findOneById($request->get('id'));
        $participants = $em->getRepository('AppBundle:QuestadpParticipants')->findBySession($request->get('id'));

        $reponses = $em->getRepository('AppBundle:QuestadpReponse')->findByIdSession($session->getId());

        $score = array();

        foreach ($reponses as $reponse){
            array_push($score, $reponse->getid());
        }

        $score = array_sum($score);


        return $this->render('AdminBundle:QuestadpSession:show.html.twig', array(
            'session' => $session,
            'score' => $score,
            'participants' => $participants,
        ));
    }

    /**
     * @Route("/sessions/delete/{id}", name="deleteSessionAction")
     */
    public function deleteSessiontAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('AppBundle:QuestadpSession')->findOneById($request->get('id'));
        $em->remove($session);
        $em->flush();
        $this->addFlash("success", "QuestadpSession supprimée");
        return $this->redirectToRoute('sessionhome');

    }
}
