<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\FreizeitbookingPlattformBundle\Entity\LasertagProvider;
use Binaerpiloten\FreizeitbookingPlattformBundle\Form\LasertagProviderType;

/**
 * LasertagProvider controller.
 *
 * @Route("/lasertagprovider")
 */
class LasertagProviderController extends Controller
{

    /**
     * Lists all LasertagProvider entities.
     *
     * @Route("/", name="lasertagprovider")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/LasertagProvider:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

    	$qregion = $request->query->get('region');
        if ($qregion) {
        	$region = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region')
        				 ->findOneBy(array('urlname' => $qregion));
			if($region !== null ) {
				$q2 = $em->createQuery("SELECT p " .
						"FROM Binaerpiloten\FreizeitbookingPlattformBundle\Entity\LasertagProvider p " .
						"JOIN p.regions r " .
						"WHERE r.id = " . $region->getId());
				$entities = $q2->getResult();
				
			} 
        } else {
        	$entities = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:LasertagProvider')->findAll();
        }
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new LasertagProvider entity.
     *
     * @Route("/", name="lasertagprovider_create")
     * @Method("POST")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/LasertagProvider:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new LasertagProvider();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lasertagprovider_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a LasertagProvider entity.
    *
    * @param LasertagProvider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(LasertagProvider $entity)
    {
        $form = $this->createForm(new LasertagProviderType(), $entity, array(
            'action' => $this->generateUrl('lasertagprovider_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new LasertagProvider entity.
     *
     * @Route("/new", name="lasertagprovider_new")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/LasertagProvider:new.html.twig")
     */
    public function newAction()
    {
        $entity = new LasertagProvider();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a LasertagProvider entity.
     *
     * @Route("/{id}", name="lasertagprovider_show")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/LasertagProvider:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:LasertagProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LasertagProvider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing LasertagProvider entity.
     *
     * @Route("/{id}/edit", name="lasertagprovider_edit")
     * @Method("GET")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/LasertagProvider:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:LasertagProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LasertagProvider entity.');
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
    * Creates a form to edit a LasertagProvider entity.
    *
    * @param LasertagProvider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(LasertagProvider $entity)
    {
        $form = $this->createForm(new LasertagProviderType(), $entity, array(
            'action' => $this->generateUrl('lasertagprovider_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing LasertagProvider entity.
     *
     * @Route("/{id}", name="lasertagprovider_update")
     * @Method("PUT")
     * @Template("BinaerpilotenFreizeitbookingPlattformBundle:Admin/LasertagProvider:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:LasertagProvider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LasertagProvider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('lasertagprovider_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a LasertagProvider entity.
     *
     * @Route("/{id}", name="lasertagprovider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenFreizeitbookingPlattformBundle:LasertagProvider')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find LasertagProvider entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('lasertagprovider'));
    }

    /**
     * Creates a form to delete a LasertagProvider entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lasertagprovider_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
