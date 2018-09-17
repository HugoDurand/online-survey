<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestadpSession
 *
 * @ORM\Table(name="questadpsession")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SessionRepository")
 */
class QuestadpSession
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
     * @var int
     *
     * @ORM\Column(name="id_questionnaire", type="integer")
     */
    private $idQuestionnaire;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;


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
     * Set idQuestionnaire
     *
     * @param integer $idQuestionnaire
     *
     * @return QuestadpSession
     */
    public function setIdQuestionnaire($idQuestionnaire)
    {
        $this->idQuestionnaire = $idQuestionnaire;

        return $this;
    }

    /**
     * Get idQuestionnaire
     *
     * @return int
     */
    public function getIdQuestionnaire()
    {
        return $this->idQuestionnaire;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return QuestadpSession
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }




}

