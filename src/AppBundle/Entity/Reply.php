<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity()
* @ORM\Table()
*/
class Reply
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 *
	 * @var int
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Subject", inversedBy="replies")
	 *
	 * @var string
	 */
	private $subject;

	/**
	 * @ORM\Column(type="text")
	 *
	 * @var string
	 */
	private $text;

	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text")
	 *
	 * @var string
	 */
	private $author;

	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text")
	 *
	 * @var string
	 */
	private $mail;

	/**
	 * @ORM\Column(type="text")
	 *
	 * @var string
	 */
	private $title;

	/**
	 * @ORM\Column(type="string")
	 *
	 * @var string
	 */
	private $vote;

	public function __construct()
	{
		$this->title = "Titre de la nouvelle réponse";
		$this->description = "Description";
		$this->vote = 0;
	}

	/**
	 * @return string
	 */
	public function getVote()
	{
		return $this->vote;
	}

	/**
	 * @param string $vote
	 */
	public function setVote($vote)
	{
		$this->vote = $vote;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * @param string $subject
	 */
	public function setSubject(Subject $subject)
	{
		$this->subject = $subject;
	}

	/**
	 * @return text
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param string $text
	 */
	public function setText($text)
	{
		$this->text = $text;
	}

	/**
	 * @return text
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param string $text
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @return text
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @param string $text
	 */
	public function setAuthor($author)
	{
		$this->author = $author;
	}

	/**
	 * @return text
	 */
	public function getMail()
	{
		return $this->mail;
	}

	/**
	 * @param string $text
	 */
	public function setMail($mail)
	{
		$this->mail = $mail;
	}
}