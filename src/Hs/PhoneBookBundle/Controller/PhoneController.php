<?php

namespace Hs\PhoneBookBundle\Controller;

use Hs\PhoneBookBundle\Entity\Person;
use Hs\PhoneBookBundle\Entity\Phone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Phone controller.
 *
 */
class PhoneController extends Controller
{
    /**
     * Displays a form to edit an existing person entity.
     *
     */
    public function editAction(Request $request, Person $person)
    {
        $editForm = $this->createForm('Hs\PhoneBookBundle\Form\PersonType', $person);
        $editForm->handleRequest($request);

        $validator = $this->get('validator');
        $errors = $validator->validate($person);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('phone_edit', array('id' => $person->getId()));
        }

        return $this->render('phone/edit.html.twig', array(
            'errors' => $errors,
            'person' => $person,
            'edit_form' => $editForm->createView(),
        ));
    }
}
