<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\FreizeitbookingPlattformBundle\Entity\PaintballProvider;
use Binaerpiloten\FreizeitbookingPlattformBundle\Form\PaintballProviderType;

/**
 * PaintballProvider controller.
 *
 * @Route("/paintballprovider")
 */
class PaintballProviderController extends Controller
{

    /**
     * Lists all PaintballProvider entities.
     *
     * @Route("/", name="paintballprovider")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/PaintballProvider:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:PaintballProvider')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PaintballProvider entity.
     *
     * @Route("/", name="paintballprovider_create")
     * @Method("POST")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/PaintballProvider:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PaintballProvider();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paintballprovider_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a PaintballProvider entity.
    *
    * @param PaintballProvider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(PaintballProvider $entity)
    {
        $form = $this->createForm(new PaintballProviderType(), $entity, array(
            'action' => $this->generateUrl('paintballprovider_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PaintballProvider entity.
     *
     * @Route("/new", name="paintballprovider_new")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/PaintballProvider:new.html.twig")
     */
    public function newAction()
    {
        $entity = new PaintballProvider();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PaintballProvider entity.
     *
     * @Route("/{id}", name="paintballprovider_show")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/PaintballProvider:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:PaintballProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaintballProvider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PaintballProvider entity.
     *
     * @Route("/{id}/edit", name="paintballprovider_edit")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/PaintballProvider:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:PaintballProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaintballProvider entity.');
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
    * Creates a form to edit a PaintballProvider entity.
    *
    * @param PaintballProvider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PaintballProvider $entity)
    {
        $form = $this->createForm(new PaintballProviderType(), $entity, array(
            'action' => $this->generateUrl('paintballprovider_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PaintballProvider entity.
     *
     * @Route("/{id}", name="paintballprovider_update")
     * @Method("PUT")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/PaintballProvider:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:PaintballProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaintballProvider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('paintballprovider_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PaintballProvider entity.
     *
     * @Route("/{id}", name="paintballprovider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:PaintballProvider')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PaintballProvider entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paintballprovider'));
    }

    /**
     * Creates a form to delete a PaintballProvider entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paintballprovider_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
