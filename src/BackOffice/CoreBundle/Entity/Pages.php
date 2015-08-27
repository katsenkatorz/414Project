<?php

namespace BackOffice\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 *
 * @ORM\Table("pages")
 * @ORM\Entity(repositoryClass="BackOffice\CoreBundle\Entity\Repository\PagesRepository")
 */
class Pages
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="BackOffice\CoreBundle\Entity\Applications", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $applications;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=50)
     */
    private $title;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Pages
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set applications
     *
     * @param \BackOffice\CoreBundle\Entity\Applications $applications
     * @return Pages
     */
    public function setApplications(\BackOffice\CoreBundle\Entity\Applications $applications = null)
    {
        $this->applications = $applications;

        return $this;
    }

    /**
     * Get applications
     *
     * @return \BackOffice\CoreBundle\Entity\Applications 
     */
    public function getApplications()
    {
        return $this->applications;
    }
}
