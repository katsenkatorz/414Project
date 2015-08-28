<?php

namespace BackOffice\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BackOffice\CoreBundle\Entity\Applications;
use BackOffice\CoreBundle\Form\ApplicationsType;

/**
 * Applications controller.
 *
 * @Route("/applications")
 */
class ApplicationsController extends Controller
{

    /**
     * Lists all Applications entities.
     *
     * @Route("/", name="applications")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Applications')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Applications entity.
     *
     * @Route("/", name="applications_create")
     * @Method("POST")
     * @Template("CoreBundle:Applications:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Applications();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('applications_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Applications entity.
     *
     * @param Applications $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Applications $entity)
    {
        $form = $this->createForm(new ApplicationsType(), $entity, array(
            'action' => $this->generateUrl('applications_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Applications entity.
     *
     * @Route("/new", name="applications_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Applications();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Applications entity.
     *
     * @Route("/{id}", name="applications_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Applications')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Applications entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Applications entity.
     *
     * @Route("/{id}/edit", name="applications_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Applications')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Applications entity.');
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
    * Creates a form to edit a Applications entity.
    *
    * @param Applications $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Applications $entity)
    {
        $form = $this->createForm(new ApplicationsType(), $entity, array(
            'action' => $this->generateUrl('applications_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Applications entity.
     *
     * @Route("/{id}", name="applications_update")
     * @Method("PUT")
     * @Template("CoreBundle:Applications:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Applications')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Applications entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('applications_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Applications entity.
     *
     * @Route("/{id}", name="applications_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoreBundle:Applications')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Applications entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('applications'));
    }

    /**
     * Creates a form to delete a Applications entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('applications_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
