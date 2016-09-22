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
	 * @var text
	 */
	private $subject;

	/**
	 * @ORM\Column(type="text")
	 *
	 * @var text
	 */
	private $text;

	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text")
	 *
	 * @var text
	 */
	private $author;

	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="text")
	 *
	 * @var text
	 */
	private $mail;

	/**
	 * @ORM\Column(type="text")
	 *
	 * @var text
	 */
	private $title;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return text
	 */
	public function getSubject()
	{
		return $this->subject;
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

	/**
	 * @param text $subject
	 */
	public function setSubject(Subject $subject)
	{
		$this->subject = $subject;
	}
}