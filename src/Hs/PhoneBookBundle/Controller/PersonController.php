<?php

namespace Hs\PhoneBookBundle\Controller;

use Hs\PhoneBookBundle\Entity\Person;
use Hs\PhoneBookBundle\Entity\Phone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Person controller.
 *
 */
class PersonController extends Controller
{
    /**
     * Lists all person entities.
     *
     */
    public function indexAction()
    {
        $phonesWithPersons = $this->getDoctrine()
            ->getRepository(Person::class)
            ->getPersonsWithPhones();
        $searchForm = $this->createFormBuilder(null)
            ->add("search",TextType::class)
            ->getForm();

        return $this->render('person/index.html.twig', array(
            'persons' => $phonesWithPersons,
            'form' => $searchForm->createView()
        ));
    }

    /**
     * Creates a new person entity.
     *
     */
    public function newAction(Request $request)
    {
        $phone = new Phone();
        $person = new Person();
        $person->addPhone($phone);
        $form = $this->createForm('Hs\PhoneBookBundle\Form\PersonType', $person);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
            return $this->redirectToRoute('person_show', array('id' => $person->getId()));
        }

        return $this->render('person/new.html.twig', array(
            'person' => $person,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a person entity.
     *
     */
    public function showAction(Person $person,Phone $phone)
    {
        $deleteForm = $this->createDeleteForm($person);

        return $this->render('person/show.html.twig', array(
            'phone' => $phone,
            'person'=> $person,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing person entity.
     *
     */
    public function editAction(Request $request, Person $person)
    {
        $editForm = $this->createForm('Hs\PhoneBookBundle\Form\PersonType', $person);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('phone_edit', array('id' => $person->getId()));
        }

        return $this->render('person/edit.html.twig', array(
            'person' => $person,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a person entity.
     *
     */
    public function deleteAction(Request $request, Person $person)
    {
        $form = $this->createDeleteForm($person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush();
        }

        return $this->redirectToRoute('person_index');
    }

    /**
     * Creates a form to delete a person entity.
     *
     * @param Person $person The person entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Person $person)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('person_delete', array('id' => $person->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addPhoneAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $person = $em->find(Person::class, $request->get('id'));

        $phone = new Phone();
        $form = $this->createForm('Hs\PhoneBookBundle\Form\PhoneType', $phone);

        $form->handleRequest($request);
        $person->addPhone($phone);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($person);
            $em->flush();
            return $this->redirectToRoute('person_index');
        }
        return $this->render('person/addPhone.html.twig', array(
            'phone' => $phone,
            'add_phone_form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchAction(Request $request){
        if ($request->isXmlHttpRequest()) {
            $serializer = $this->get('jms_serializer');
            $search = $this->getDoctrine()
                ->getRepository(Person::class)
                ->findByLike($_POST['term']);

            //get the HTML markup corresponding to the table
            $data = $this->render('person/ajax.html.twig', array(
                'persons' => $search,
            ));
            $html = $data->getContent();

            //set Response data
            $response = new Response();
            $response->setContent(json_encode(array(
                'data' => $html,
            )));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else {
            //if call is not ajax render another view
            $search = $this->getDoctrine()
                ->getRepository(Person::class)
                ->findByLike($_POST['term']);
            $searchForm = $this->createFormBuilder(null)
                ->add("search",TextType::class)
                ->getForm();

            return $this->render('person/index.html.twig', array(
                'persons' => $search,
                'form' => $searchForm->createView()
            ));

        }
    }
}
