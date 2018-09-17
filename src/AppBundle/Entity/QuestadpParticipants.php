<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestadpParticipants
 *
 * @ORM\Table(name="questadpparticipants")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParticipantsRepository")
 */
class QuestadpParticipants
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="num_participant", type="string", length=255)
     */
    private $numParticipant;

    /**
     * @var integer
     *
     * @ORM\Column(name="session", type="integer")
     */
    private $session;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return QuestadpParticipants
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return QuestadpParticipants
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set numParticipant
     *
     * @param string $numParticipant
     *
     * @return QuestadpParticipants
     */
    public function setNumParticipant($numParticipant)
    {
        $this->numParticipant = $numParticipant;

        return $this;
    }

    /**
     * Get numParticipant
     *
     * @return string
     */
    public function getNumParticipant()
    {
        return $this->numParticipant;
    }

    /**
     * @return int
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param int $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }



}

