<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\FreizeitbookingPlattformBundle\Entity\SquashProvider;
use Binaerpiloten\FreizeitbookingPlattformBundle\Form\SquashProviderType;

/**
 * SquashProvider controller.
 *
 * @Route("/squashprovider")
 */
class SquashProviderController extends Controller
{

    /**
     * Lists all SquashProvider entities.
     *
     * @Route("/", name="squashprovider")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SquashProvider')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SquashProvider entity.
     *
     * @Route("/", name="squashprovider_create")
     * @Method("POST")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:SquashProvider:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SquashProvider();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('squashprovider_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a SquashProvider entity.
    *
    * @param SquashProvider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(SquashProvider $entity)
    {
        $form = $this->createForm(new SquashProviderType(), $entity, array(
            'action' => $this->generateUrl('squashprovider_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SquashProvider entity.
     *
     * @Route("/new", name="squashprovider_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SquashProvider();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SquashProvider entity.
     *
     * @Route("/{id}", name="squashprovider_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SquashProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SquashProvider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SquashProvider entity.
     *
     * @Route("/{id}/edit", name="squashprovider_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SquashProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SquashProvider entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a SquashProvider entity.
    *
    * @param SquashProvider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SquashProvider $entity)
    {
        $form = $this->createForm(new SquashProviderType(), $entity, array(
            'action' => $this->generateUrl('squashprovider_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SquashProvider entity.
     *
     * @Route("/{id}", name="squashprovider_update")
     * @Method("PUT")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:SquashProvider:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SquashProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SquashProvider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('squashprovider_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SquashProvider entity.
     *
     * @Route("/{id}", name="squashprovider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SquashProvider')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SquashProvider entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('squashprovider'));
    }

    /**
     * Creates a form to delete a SquashProvider entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('squashprovider_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}