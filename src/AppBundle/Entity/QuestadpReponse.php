<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestadpReponse
 *
 * @ORM\Table(name="questadpreponse")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReponseRepository")
 */
class QuestadpReponse
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
     * @ORM\Column(name="num_participant", type="string", length=255)
     */
    private $numParticipant;

    /**
     * @var int
     *
     * @ORM\Column(name="id_session", type="integer")
     */
    private $idSession;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=255)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="text")
     */
    private $reponse;


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
     * Set numParticipant
     *
     * @param string $numParticipant
     *
     * @return QuestadpReponse
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
     * Set idSession
     *
     * @param integer $idSession
     *
     * @return QuestadpReponse
     */
    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;

        return $this;
    }

    /**
     * Get idSession
     *
     * @return int
     */
    public function getIdSession()
    {
        return $this->idSession;
    }

    /**
     * Set score
     *
     * @param string $score
     *
     * @return QuestadpReponse
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return QuestadpReponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }
}

