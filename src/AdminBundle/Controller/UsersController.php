<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    /**
     * @Route("/users", name="usershome")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();


        return $this->render('AdminBundle:Users:index.html.twig', array(
            'users' => $users
        ));
    }




    /**
     * @Route("/users/edit/{id}", name="editUserAction")
     */
    public function editUserAction(Request $request)
    {

    }






    /**
     * @Route("/users/add", name="addUserAction")
     */
    public function addUserAction(Request $request)
    {

        $formFactory = $this->container->get('fos_user.registration.form.factory');

        $form = $formFactory->createForm();


        return $this->render('@register/Registration/register_content.html.twig', array(
            'form' => $form->createView()
        ));
    }




    /**
     * @Route("/users/show/{id}", name="showUserAction")
     */
    public function showUserAction(Request $request)
    {

    }




    /**
     * @Route("/users/delete/{id}", name="deleteUserAction")
     */
    public function deleteUserAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($request->get('id'));
        $em->remove($user);
        $em->flush();
        $this->addFlash("success", "Utilisateur supprimé");
        return $this->redirectToRoute('usershome');
    }



}
