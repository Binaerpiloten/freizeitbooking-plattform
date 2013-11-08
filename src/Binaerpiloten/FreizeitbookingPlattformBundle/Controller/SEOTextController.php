<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\FreizeitbookingPlattformBundle\Entity\SEOText;
use Binaerpiloten\FreizeitbookingPlattformBundle\Form\SEOTextType;

/**
 * SEOText controller.
 *
 * @Route("/seotext")
 */
class SEOTextController extends Controller
{

    /**
     * Lists all SEOText entities.
     *
     * @Route("/", name="seotext")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SEOText')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SEOText entity.
     *
     * @Route("/", name="seotext_create")
     * @Method("POST")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:SEOText:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SEOText();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seotext_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a SEOText entity.
    *
    * @param SEOText $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(SEOText $entity)
    {
        $form = $this->createForm(new SEOTextType(), $entity, array(
            'action' => $this->generateUrl('seotext_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SEOText entity.
     *
     * @Route("/new", name="seotext_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SEOText();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SEOText entity.
     *
     * @Route("/{id}", name="seotext_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SEOText')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SEOText entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SEOText entity.
     *
     * @Route("/{id}/edit", name="seotext_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SEOText')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SEOText entity.');
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
    * Creates a form to edit a SEOText entity.
    *
    * @param SEOText $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SEOText $entity)
    {
        $form = $this->createForm(new SEOTextType(), $entity, array(
            'action' => $this->generateUrl('seotext_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SEOText entity.
     *
     * @Route("/{id}", name="seotext_update")
     * @Method("PUT")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:SEOText:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SEOText')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SEOText entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('seotext_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SEOText entity.
     *
     * @Route("/{id}", name="seotext_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:SEOText')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SEOText entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('seotext'));
    }

    /**
     * Creates a form to delete a SEOText entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seotext_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
