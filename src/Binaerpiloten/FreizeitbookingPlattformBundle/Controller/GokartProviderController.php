<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\FreizeitbookingPlattformBundle\Entity\GokartProvider;
use Binaerpiloten\FreizeitbookingPlattformBundle\Form\GokartProviderType;

/**
 * GokartProvider controller.
 *
 * @Route("/gokartprovider")
 */
class GokartProviderController extends Controller
{

    /**
     * Lists all GokartProvider entities.
     *
     * @Route("/", name="gokartprovider")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:GokartProvider')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new GokartProvider entity.
     *
     * @Route("/", name="gokartprovider_create")
     * @Method("POST")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:GokartProvider:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new GokartProvider();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gokartprovider_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a GokartProvider entity.
    *
    * @param GokartProvider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GokartProvider $entity)
    {
        $form = $this->createForm(new GokartProviderType(), $entity, array(
            'action' => $this->generateUrl('gokartprovider_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GokartProvider entity.
     *
     * @Route("/new", name="gokartprovider_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GokartProvider();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a GokartProvider entity.
     *
     * @Route("/{id}", name="gokartprovider_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:GokartProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GokartProvider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GokartProvider entity.
     *
     * @Route("/{id}/edit", name="gokartprovider_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:GokartProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GokartProvider entity.');
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
    * Creates a form to edit a GokartProvider entity.
    *
    * @param GokartProvider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GokartProvider $entity)
    {
        $form = $this->createForm(new GokartProviderType(), $entity, array(
            'action' => $this->generateUrl('gokartprovider_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing GokartProvider entity.
     *
     * @Route("/{id}", name="gokartprovider_update")
     * @Method("PUT")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:GokartProvider:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:GokartProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GokartProvider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('gokartprovider_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a GokartProvider entity.
     *
     * @Route("/{id}", name="gokartprovider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:GokartProvider')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GokartProvider entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gokartprovider'));
    }

    /**
     * Creates a form to delete a GokartProvider entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gokartprovider_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
