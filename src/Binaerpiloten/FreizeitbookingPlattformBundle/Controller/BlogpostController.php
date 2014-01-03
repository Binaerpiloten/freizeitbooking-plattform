<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Blogpost;
use Binaerpiloten\FreizeitbookingPlattformBundle\Form\BlogpostType;

/**
 * Blogpost controller.
 *
 * @Route("/blogpost")
 */
class BlogpostController extends Controller
{

    /**
     * Lists all Blogpost entities.
     *
     * @Route("/", name="blogpost")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/Blogpost:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:Blogpost')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Blogpost entity.
     *
     * @Route("/", name="blogpost_create")
     * @Method("POST")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/Blogpost:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Blogpost();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('blogpost_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Blogpost entity.
    *
    * @param Blogpost $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Blogpost $entity)
    {
        $form = $this->createForm(new BlogpostType(), $entity, array(
            'action' => $this->generateUrl('blogpost_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Blogpost entity.
     *
     * @Route("/new", name="blogpost_new")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/Blogpost:new.html.twig")
     */
    public function newAction()
    {
        $entity = new Blogpost();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Blogpost entity.
     *
     * @Route("/{id}", name="blogpost_show")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/Blogpost:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:Blogpost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blogpost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Blogpost entity.
     *
     * @Route("/{id}/edit", name="blogpost_edit")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/Blogpost:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:Blogpost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blogpost entity.');
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
    * Creates a form to edit a Blogpost entity.
    *
    * @param Blogpost $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Blogpost $entity)
    {
        $form = $this->createForm(new BlogpostType(), $entity, array(
            'action' => $this->generateUrl('blogpost_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Blogpost entity.
     *
     * @Route("/{id}", name="blogpost_update")
     * @Method("PUT")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/Blogpost:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:Blogpost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blogpost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('blogpost_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Blogpost entity.
     *
     * @Route("/{id}", name="blogpost_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:Blogpost')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Blogpost entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('blogpost'));
    }

    /**
     * Creates a form to delete a Blogpost entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blogpost_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
