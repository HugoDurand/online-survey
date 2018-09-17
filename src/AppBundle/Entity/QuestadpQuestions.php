<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestadpQuestions
 *
 * @ORM\Table(name="questadpquestions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionsRepository")
 */
class QuestadpQuestions
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
     * @ORM\Column(name="libelle", type="text")
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_parent", type="string", length=255)
     */
    private $titreParent;

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
     * @return QuestadpQuestions
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
     * @return QuestadpQuestions
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

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getTitreParent()
    {
        return $this->titreParent;
    }

    /**
     * @param string $titreParent
     */
    public function setTitreParent($titreParent)
    {
        $this->titreParent = $titreParent;
    }







}

