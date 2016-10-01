<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reply;
use AppBundle\Entity\Subject;
use AppBundle\Form\Type\ReplyType;
use AppBundle\Form\Type\SubjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/subjects")
 */
class SubjectController extends Controller {
	/**
	 * @Route(path="/", methods={"GET"}, name="subject_index")
	 * @Template()
	 */
	public function indexAction() {
		\dump( $this->getDoctrine()->getRepository( Subject::class )->findNotResolved() );

		return [
			'subjects' => $this->getDoctrine()->getRepository( Subject::class )->findNotResolved()
		];
	}

	/**
	 * @Route(path="/resolved", methods={"GET"}, name="subject_index_resolved")
	 * @Template()
	 */
	public function indexResolvedAction() {
		return [
			'subjects' => $this->getDoctrine()->getRepository( Subject::class )->findResolved()
		];
	}

	/**
	 * @Route(path="/create", methods={"GET","POST"}, name="subject_create")
	 * @Template()
	 */
	public function createAction( Request $request ) {
		$newSubject = new Subject();
		$form       = $this->createForm( SubjectType::class, $newSubject );
		$form->handleRequest( $request );
		if ( $form->isValid() ) {
			$this->getDoctrine()->getManager()->persist( $newSubject );
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute( "subject_index" );
		}

		return [
			'form' => $form->createView(),
		];
	}

	/**
	 * @Route(path="/{id}", methods={"GET","POST"}, name="subject_id")
	 * @Template()
	 */
	public function showAction( Request $request, $id ) {
		$subject = $this->getDoctrine()->getRepository( Subject::class )->find( $id );

		$reply = new Reply();
		$reply->setSubject( $subject );

		$form = $this->createForm( ReplyType::class, $reply );

		$form->handleRequest( $request );
		if ( $form->isValid() ) {
			$this->getDoctrine()->getManager()->persist( $reply );
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute( 'subject_id', [ 'id' => $subject->getId() ] );
		}

		return [
			'subject' => $subject,
			'form'    => $form->createView(),
		];
	}

	/**
	 * @Route(path="/{id}/vote/up", methods={"GET"}, name="subject_upvote")
	 * @Template()
	 */
	public function upvoteAction( $id ) {
		$subject = $this->getDoctrine()->getRepository( Subject::class )->find( $id );
		$vote    = $subject->getVote();
		$vote    = $vote + 1;
		$subject->setVote( $vote );
		$this->getDoctrine()->getManager()->flush();

		return $this->redirectToRoute( 'homepage' );
	}

	/**
	 * @Route(path="/{id}/vote/down", methods={"GET"}, name="subject_downvote")
	 * @Template()
	 */
	public function downvoteAction( $id ) {
		$subject = $this->getDoctrine()->getRepository( Subject::class )->find( $id );
		$vote    = $subject->getVote();
		$vote    = $vote - 1;
		$subject->setVote( $vote );
		$this->getDoctrine()->getManager()->flush();

		return $this->redirectToRoute( 'homepage' );
	}

	/**
	 * @Route(path="/{id}/delete", methods={"GET"}, name="subject_delete")
	 * @Template()
	 */
	public function replyDeleteAction( $id ) {
		$subject       = $this->getDoctrine()->getRepository( Subject::class )->find( $id );
		$deleteSubject = $this->getDoctrine()->getManager();
		$deleteSubject->remove( $subject );
		$deleteSubject->flush();

		return $this->redirectToRoute( 'subject_index' );
	}

	/**
	 * @Route(path="/{id}/resoudre", methods={"GET"}, name="subject_resolve")
	 * @Template()
	 */
	public function subjectResolveAction( $id ) {
		$subject = $this->getDoctrine()->getRepository( Subject::class )->find( $id );
		$subject->setResolved( true );
		$this->getDoctrine()->getManager()->flush();

		return $this->redirectToRoute( 'homepage' );
	}
}