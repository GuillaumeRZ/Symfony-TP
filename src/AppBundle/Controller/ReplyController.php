<?php
/**
 * Created by PhpStorm.
 * User: guillaumeremy-zephir
 * Date: 22/09/2016
 * Time: 14:05
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Reply;
use AppBundle\Entity\Subject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/subjects")
 */

class ReplyController extends Controller  {

	/**
	 * @Route(path="/{id}/vote/replyUp", methods={"GET"}, name="reply_upvote")
	 * @Template()
	 */
	public function replyUpvoteAction($id)
	{
		$reply = $this->getDoctrine()->getRepository(Reply::class)->find($id);
		$replyVote= $reply->getVote();
		$replyVote = $replyVote+1;
		$reply->setVote($replyVote);
		$this->getDoctrine()->getManager()->flush();

		return $this->redirectToRoute('subject_id', ['id' => $reply->getSubject()->getId()]);
	}

	/**
	 * @Route(path="/{id}/vote/replyDown", methods={"GET"}, name="reply_downvote")
	 * @Template()
	 */
	public function replyDownvoteAction($id)
	{
		$reply = $this->getDoctrine()->getRepository(Reply::class)->find($id);
		$replyVote= $reply->getVote();
		$replyVote = $replyVote-1;
		$reply->setVote($replyVote);
		$this->getDoctrine()->getManager()->flush();

		return $this->redirectToRoute('subject_id', ['id' => $reply->getSubject()->getId()]);
	}

	/**
	 * @Route(path="/{id}/delete", methods={"GET"}, name="reply_delete")
	 * @Template()
	 */
	public function replyDeleteAction($id)
	{
		$reply = $this->getDoctrine()->getRepository(Reply::class)->find($id);
		$deleteReply = $this->getDoctrine()->getManager();
		$deleteReply->remove($reply);
		$deleteReply->flush();
		$subjectId = $reply->getSubject()->getId();
		return $this->redirectToRoute('subject_id', [ 'id' => $subjectId]);
	}

}