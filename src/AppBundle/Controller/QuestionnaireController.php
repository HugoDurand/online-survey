<?php

namespace AppBundle\Controller;

use AppBundle\Entity\QuestadpReponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class QuestionnaireController extends Controller
{
    /**
     * @Route("/questionnaire/{id}", name="questionnaire")
     */
    public function indexAction(Request $request)
    {


        ///////////GET DATA///////////////

        $em = $this->getDoctrine()->getManager();
        $questionnaire = $em->getRepository('AppBundle:QuestadpQuestionnaires')->findById([1, $request->get('id')]);
        $question = $em->getRepository('AppBundle:QuestadpQuestions')->findByIdQuestionnaire([$questionnaire[0]->getId(),$questionnaire[1]->getId()]);

        $sess = new Session();

        if($sess->get('token') != $questionnaire[1]->getId()){
            return $this->redirect($this->generateUrl('homepage'));
        }

        ///////BUILD SURVEY ///////////

        $idQuestion = array();

        foreach ($question as $q){
            $idQuestion[] = array_push($idQuestion, $q->getId());
        }

        $questelem = $em->getRepository('AppBundle:QuestadpQuestelem')->findByIdQuestion($idQuestion);

        $total = array();

            foreach ($question as $q){

                $quel = array();

                foreach ($questelem as $ql){

                    if($q->getId() == $ql->getIdQuestion()){

                        array_push($quel, $ql);

                    }
                }



                $form = array();
                array_push($form, $q, $quel);
                array_push($total,$form);

            }


            ////////////GET DATA BACK/////////////


        $data = $request->request->All();

        if (isset($data['submit'])){


            $bnrp = array();

            foreach ($data as $reponse){

                $bonrep = substr($reponse, -2, -1);
                $co = substr($reponse, -1);

                if ($bonrep == "1"){
                    array_push($bnrp, $bonrep*$co);


                }
            }


            $result = array_sum($bnrp);

            $nbquestion = count($question);
            $pourcentage = round($result*100/$nbquestion);
            $response = implode(',,,', $data);


            $participant = $sess->get('participant');
            $session = $sess->get('session');

            $reponse_participant = new QuestadpReponse();
            $reponse_participant->setNumParticipant($participant->getNumParticipant());
            $reponse_participant->setIdSession($session->getid());
            $reponse_participant->setScore($pourcentage);
            $reponse_participant->setReponse($response);

            $em->persist($reponse_participant);
            $em->flush();

            $sess->invalidate();

            $this->addFlash("success", "Merci d'avoir répondu au questionnaire");

            return $this->redirect($this->generateUrl('homepage'));
        }



        return $this->render('AppBundle:Questionnaire:index.html.twig', array(
            'questionnaire' => $total,
            'libelle' => $questionnaire,
        ));
    }
}
