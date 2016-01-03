<?php

namespace Pheetup\AdminBundle\Controller;

use Pheetup\AdminBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/my_account",name="admin_my_account")
     * @Template()
     * @return array
     */
    public function profileAction()
    {
        $user = $this->getUser();
        $form = $this->createForm(new UserType(), $user);
        return [
            'form' => $form->createView()
        ];
    }
}
