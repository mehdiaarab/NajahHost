<?php

namespace najahhost\ProjetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use najahhost\ProjetBundle\Entity\Tache;
use najahhost\ProjetBundle\Form\TacheType;

/**
 * Tache controller.
 *
 */
class TacheController extends Controller
{

    /**
     * Lists all Tache entities.
     *
     */
    public function indexAction($id_projet)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ProjetBundle:Tache')->findByProjet($id_projet);
        return $this->render('ProjetBundle:Tache:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tache entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Tache();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $id=$request->request->get("projet");
        $projet = $em->getRepository('ProjetBundle:Projet')->find($id);
        $entity->setProjet($projet);
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('tache_show', array('id' => $entity->getId())));


        return $this->render('ProjetBundle:Tache:new.html.twig', array(
            'entity' => $entity,
            'projet' => $projet,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tache entity.
     *
     * @param Tache $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tache $entity)
    {
        $form = $this->createForm(new TacheType(), $entity, array(
            'action' => $this->generateUrl('tache_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tache entity.
     *
     */
    public function newAction($id_projet)
    {
        $entity = new Tache();
        $form   = $this->createCreateForm($entity);
        $em = $this->getDoctrine()->getManager();
        $projet = $em->getRepository('ProjetBundle:Projet')->find($id_projet);
        return $this->render('ProjetBundle:Tache:new.html.twig', array(
            'entity' => $entity,
            'projet' => $projet,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tache entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProjetBundle:Tache')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tache entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ProjetBundle:Tache:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tache entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProjetBundle:Tache')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tache entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ProjetBundle:Tache:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tache entity.
    *
    * @param Tache $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tache $entity)
    {
        $form = $this->createForm(new TacheType(), $entity, array(
            'action' => $this->generateUrl('tache_update', array('id' => $entity->getId())),
            'method' => 'post',
        ));

        $form->add('submit', 'submit', array('label' => 'Confirmer'));

        return $form;
    }
    /**
     * Edits an existing Tache entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProjetBundle:Tache')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tache entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $em->flush();
        return $this->redirect($this->generateUrl('tache_show', array('id' => $id)));
    }
    public function editAffecterAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProjetBundle:Tache')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tache entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('ProjetBundle:Tache:Affecter.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    public function updateAffecterAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProjetBundle:Tache')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tache entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $em->flush();
        return $this->redirect($this->generateUrl('list_taches_users', array('id' => $id)));
    }
    /**
     * Deletes a Tache entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ProjetBundle:Tache')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tache entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tache'));
    }

    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ProjetBundle:tache')->find($id);
        $id_projet=$entity->getProjet()->getTitre();
        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('tache'), array(
            'id_projet'      => $id_projet,
        ));
    }
    /**
     * Creates a form to delete a Tache entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tache_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function listTachesUsersAction($id)
    {
        $entity = $this->getDoctrine()->getRepository('ProjetBundle:Tache')->find($id);
        $users=$entity->getEmployes();
        return $this->render('ProjetBundle:Tache:listTachesUsers.html.twig', array('users' => $users));
    }
}
