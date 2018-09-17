<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $sess = new Session();


        $em = $this->getDoctrine()->getManager();


        $data = $request->request->All();

        if (isset($data['submit'])){
            $participant = $em->getRepository('AppBundle:QuestadpParticipants')->findOneByNumParticipant($data['numparticipant']);

            if($participant != NULL){
                $session = $em->getRepository('AppBundle:QuestadpSession')->findOneById($participant->getSession());
            }

            $reponse =  $em->getRepository('AppBundle:QuestadpReponse')->findByNumParticipant($data['numparticipant']);

            if($participant == NULL){

                $this->addFlash("success", "Numéro participant invalide");

            }else {

                //if($reponse->getNumParticipant() == $data['numparticipant']){
                if($reponse == NULL ){

                    if ($session == NULL){

                        $this->addFlash("success", "Aucune session correspondante");

                    }else{

                        $sess->set('participant', $participant);
                        $sess->set('session', $session);
                        $sess->set('token', $session->getIdQuestionnaire());

                        return $this->redirect($this->generateUrl('questionnaire', array('id' => $session->getIdQuestionnaire())));

                    }

                }else{

                    $this->addFlash("success", "Vous avez déja rempli ce questionnaire");

                }

            }


        }

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
