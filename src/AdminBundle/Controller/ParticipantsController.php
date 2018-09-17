<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\QuestadpParticipants;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Form\AddParticipantType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;

class ParticipantsController extends Controller
{
    /**
     * @Route("/participants", name="participanthome")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $participants = $em->getRepository('AppBundle:QuestadpParticipants')->findAll();



        return $this->render('AdminBundle:QuestadpParticipants:index.html.twig', array(
            'participants'=>$participants,
        ));
    }






    /**
     * @Route("/participants/edit/{id}", name="editParticipantAction")
     */
    public function editParticipantAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('AppBundle:QuestadpParticipants')->findOneById($request->get('id'));
        $form = $this->createForm(AddParticipantType::class, $participant);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participant);
            $entityManager->flush();

            return $this->redirectToRoute('participanthome');
        }


        return $this->render('AdminBundle:QuestadpParticipants:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }






    /**
     * @Route("/participants/add", name="addParticipantAction")
     */
    public function addParticipantAction(Request $request)
    {

        $participant = new QuestadpParticipants();
        $form = $this->createForm(AddParticipantType::class, $participant);
        $form->add('num_participant', HiddenType::class,array(
            'data'=> uniqid(),
        ));


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participant);
            $entityManager->flush();

            return $this->redirectToRoute('participanthome');
        }


        return $this->render('AdminBundle:QuestadpParticipants:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }




    /**
     * @Route("/participants/show/{id}", name="showParticipantAction")
     */
    public function showParticipantAction(Request $request)
    {

        ///////GET ENTITIES//////

        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('AppBundle:QuestadpParticipants')->findOneById($request->get('id'));
        $session = $em->getRepository('AppBundle:QuestadpSession')->findOneById($participant->getSession());
        $reponse = $em->getRepository('AppBundle:QuestadpReponse')->findOneByNumParticipant($participant->getNumParticipant());
        $questionnaire = $em->getRepository('AppBundle:QuestadpQuestionnaires')->findOneById($session->getIdQuestionnaire());

        if ($reponse == null){
            $this->addFlash("success", "Informations indisponibles, le participant doit d'abord répondre au questionnaire");
            return $this->redirectToRoute('participanthome');
        }


        //////EXPLODE THE RESULT IN ARRAY////

        $resultats = explode(',,,', $reponse->getReponse());


        //////CREATE ARRAY TO STORE DATA////

        $id_question = array();
        $libelle_reponse = array();
        $bonne_reponse = array();

        $total = array();

        foreach ($resultats as $resultat){

            if (is_numeric(substr($resultat, 0, 1))){
                array_push($id_question, substr($resultat, 0, 1));
            }

            if (is_numeric(substr($resultat, -1))){
                array_push($libelle_reponse, substr($resultat, 1, -1));
                array_push($bonne_reponse, substr($resultat, -1));
            }else{
                array_push($libelle_reponse, substr($resultat, 1));
                array_push($bonne_reponse, 0);
            }

        }

        $questions = $em->getRepository('AppBundle:QuestadpQuestions')->findById($id_question);

        $questions_libelle = array();

        foreach ($questions as $question){
            array_push($questions_libelle, $question->getLibelle());
        }


        //////retire la derniere valeur qui est le bouton valider/////
        unset($libelle_reponse[sizeof($libelle_reponse)-1]);
        unset($bonne_reponse[sizeof($bonne_reponse)-1]);

        array_push($total, $questions_libelle);
        array_push($total, $libelle_reponse);
        array_push($total, $bonne_reponse);



        return $this->render('AdminBundle:QuestadpParticipants:show.html.twig', array(
            'participants' => $participant,
            'session'=> $session,
            'reponse'=> $reponse,
            'total'=> $total,
            'questionnaire'=> $questionnaire
        ));
    }




    /**
     * @Route("/participants/delete/{id}", name="deleteParticipantAction")
     */
    public function deleteParticipantAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('AppBundle:QuestadpParticipants')->findOneById($request->get('id'));
        $em->remove($participant);
        $em->flush();
        $this->addFlash("success", "Participant supprimé");
        return $this->redirectToRoute('participanthome');
    }

}
