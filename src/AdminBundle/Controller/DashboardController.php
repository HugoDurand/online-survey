<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{
    /**
     * @Route("/",  name="dashboardhome")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $reponse = $em->getRepository('AppBundle:QuestadpReponse')->findAll();
        $participants = $em->getRepository('AppBundle:QuestadpParticipants')->findAll();
        $sessions = $em->getRepository('AppBundle:QuestadpSession')->findAll();
        $questions = $em->getRepository('AppBundle:QuestadpQuestions')->findAll();
        $questionnaires = $em->getRepository('AppBundle:QuestadpQuestionnaires')->findAll();

        $repm50 = array();
        $repp50 = array();

        foreach ($reponse as $rep){

            if ($rep->getScore() < 50 ){

                array_push($repm50, $rep->getScore());

                if ($repm50 != 0){
                    $m50 = count($repm50);
                    $p50 = 0;
                }else{
                    $m50 = 0;
                }

            }elseif($rep->getScore() >= 50){
                array_push($repp50, $rep->getScore());

                if (!empty($repp50)){
                    $p50 = count($repp50);
                }else{
                    $p50 = 0;
                }

            }

        }

        return $this->render('AdminBundle:Dashboard:index.html.twig', array(
            'm50'=>$m50,
            'p50'=>$p50,
            'participants' => $participants,
            'sessions'=>$sessions,
            'questions' =>$questions,
            'questionnaires' => $questionnaires
        ));
    }

}
