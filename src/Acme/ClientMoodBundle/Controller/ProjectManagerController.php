<?php

namespace Acme\ClientMoodBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\ClientMoodBundle\Entity\ProjectManager;
use Acme\ClientMoodBundle\Form\ProjectManagerType;

/**
 * ProjectManager controller.
 *
 */
class ProjectManagerController extends Controller
{

    /**
     * Lists all ProjectManager entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeClientMoodBundle:ProjectManager')->findAll();

        return $this->render('AcmeClientMoodBundle:ProjectManager:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ProjectManager entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProjectManager();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('projectmanager_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeClientMoodBundle:ProjectManager:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ProjectManager entity.
    *
    * @param ProjectManager $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ProjectManager $entity)
    {
        $form = $this->createForm(new ProjectManagerType(), $entity, array(
            'action' => $this->generateUrl('projectmanager_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProjectManager entity.
     *
     */
    public function newAction()
    {
        $entity = new ProjectManager();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmeClientMoodBundle:ProjectManager:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProjectManager entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeClientMoodBundle:ProjectManager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectManager entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeClientMoodBundle:ProjectManager:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ProjectManager entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeClientMoodBundle:ProjectManager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectManager entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeClientMoodBundle:ProjectManager:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProjectManager entity.
    *
    * @param ProjectManager $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProjectManager $entity)
    {
        $form = $this->createForm(new ProjectManagerType(), $entity, array(
            'action' => $this->generateUrl('projectmanager_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProjectManager entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeClientMoodBundle:ProjectManager')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectManager entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('projectmanager_edit', array('id' => $id)));
        }

        return $this->render('AcmeClientMoodBundle:ProjectManager:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProjectManager entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeClientMoodBundle:ProjectManager')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProjectManager entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('projectmanager'));
    }

    /**
     * Creates a form to delete a ProjectManager entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectmanager_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
