<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="stabam_person")
 * @ORM\Entity
 */
class Person
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="Person", mappedBy="mutter")
     * @ORM\OneToMany(targetEntity="Person", mappedBy="vater")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="vorname", type="string", length=255)
     */
    private $vorname;

    /**
     * @var string
     *
     * @ORM\Column(name="vorname2", type="string", length=255, nullable=true)
     */
    private $vorname2;

    /**
     * @var string
     *
     * @ORM\Column(name="vorname3", type="string", length=255, nullable=true)
     */
    private $vorname3;

    /**
     * @var string
     *
     * @ORM\Column(name="nachname", type="string", length=255)
     */
    private $nachname;

    /**
     * @var string
     *
     * @ORM\Column(name="nachname_geboren", type="string", length=255, nullable=true)
     */
    private $nachnameGeboren;

    /**
     * @param string $nachnameGeboren
     */
    public function setNachnameGeboren($nachnameGeboren)
    {
        $this->nachnameGeboren = $nachnameGeboren;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="geschlecht", type="string", length=1)
     */
    private $geschlecht;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="geboren_am", type="datetime")
     */
    private $geborenAm;

    /**
     * @var string
     *
     * @ORM\Column(name="geburtsort", type="string", length=255)
     */
    private $geburtsort;

    /**
     * @var string
     *
     * @ORM\Column(name="beruf", type="string", length=255)
     */
    private $beruf;

    /**
     * @var string
     *
     * @ORM\Column(name="besonderes", type="text", nullable=true)
     */
    private $besonderes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="gestorben_am", type="datetime", nullable=true)
     */
    private $gestorbenAm;

    /**
     * @var string
     *
     * @ORM\Column(name="sterbeort", type="string", length=255, nullable=true)
     */
    private $sterbeort;

    /**
     * @var integer)
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="mutter", referencedColumnName="id", nullable=true)
     */
    private $mutter;

    /**
     * @var integer)
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="vater", referencedColumnName="id", nullable=true)
     */
    private $vater;

    /**
     * @return int
     */
    public function getVater()
    {
        return $this->vater;
    }

    /**
     * @param int $vater
     */
    public function setVater($vater)
    {
        $this->vater = $vater;
    }




    /**
     * @return int
     */
    public function getMutter()
    {
        return $this->mutter;
    }

    /**
     * @param int $mutter
     */
    public function setMutter($mutter)
    {
        $this->mutter = $mutter;
    }

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
     * Set vorname
     *
     * @param string $vorname
     *
     * @return Person
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;

        return $this;
    }

    /**
     * Get vorname
     *
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Set vorname2
     *
     * @param string $vorname2
     *
     * @return Person
     */
    public function setVorname2($vorname2)
    {
        $this->vorname2 = $vorname2;

        return $this;
    }

    /**
     * Get vorname2
     *
     * @return string
     */
    public function getVorname2()
    {
        return $this->vorname2;
    }

    /**
     * Set vorname3
     *
     * @param string $vorname3
     *
     * @return Person
     */
    public function setVorname3($vorname3)
    {
        $this->vorname3 = $vorname3;

        return $this;
    }

    /**
     * Get vorname3
     *
     * @return string
     */
    public function getVorname3()
    {
        return $this->vorname3;
    }

    /**
     * Set nachname
     *
     * @param string $nachname
     *
     * @return Person
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;

        return $this;
    }

    /**
     * Get nachname
     *
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * Get nachnameGeboren
     *
     * @return string
     */
    public function getNachnameGeboren()
    {
        return $this->nachnameGeboren;
    }

    /**
     * Set geschlecht
     *
     * @param string $geschlecht
     *
     * @return Person
     */
    public function setGeschlecht($geschlecht)
    {
        $this->geschlecht = $geschlecht;

        return $this;
    }

    /**
     * Get geschlecht
     *
     * @return string
     */
    public function getGeschlecht()
    {
        return $this->geschlecht;
    }

    /**
     * Set geborenAm
     *
     * @param \DateTime $geborenAm
     *
     * @return Person
     */
    public function setGeborenAm($geborenAm)
    {
        $this->geborenAm = $geborenAm;

        return $this;
    }

    /**
     * Get geborenAm
     *
     * @return \DateTime
     */
    public function getGeborenAm()
    {
        return $this->geborenAm;
    }

    /**
     * Set geburtsort
     *
     * @param string $geburtsort
     *
     * @return Person
     */
    public function setGeburtsort($geburtsort)
    {
        $this->geburtsort = $geburtsort;

        return $this;
    }

    /**
     * Get geburtsort
     *
     * @return string
     */
    public function getGeburtsort()
    {
        return $this->geburtsort;
    }

    /**
     * Set beruf
     *
     * @param string $beruf
     *
     * @return Person
     */
    public function setBeruf($beruf)
    {
        $this->beruf = $beruf;

        return $this;
    }

    /**
     * Get beruf
     *
     * @return string
     */
    public function getBeruf()
    {
        return $this->beruf;
    }

    /**
     * Set besonderes
     *
     * @param string $besonderes
     *
     * @return Person
     */
    public function setBesonderes($besonderes)
    {
        $this->besonderes = $besonderes;

        return $this;
    }

    /**
     * Get besonderes
     *
     * @return string
     */
    public function getBesonderes()
    {
        return $this->besonderes;
    }

    /**
     * Set gestorbenAm
     *
     * @param \DateTime $gestorbenAm
     *
     * @return Person
     */
    public function setGestorbenAm($gestorbenAm)
    {
        $this->gestorbenAm = $gestorbenAm;

        return $this;
    }

    /**
     * Get gestorbenAm
     *
     * @return \DateTime
     */
    public function getGestorbenAm()
    {
        return $this->gestorbenAm;
    }

    /**
     * Set sterbeort
     *
     * @param string $sterbeort
     *
     * @return Person
     */
    public function setSterbeort($sterbeort)
    {
        $this->sterbeort = $sterbeort;

        return $this;
    }

    /**
     * Get sterbeort
     *
     * @return string
     */
    public function getSterbeort()
    {
        return $this->sterbeort;
    }


    /**
     * Display full name
     * @return string
     */
    public function getFullname(){
        return $this->getVorname() .
        ($this->getVorname2() ? " ".$this->getVorname2() : "").
        ($this->getVorname3() ? " ".$this->getVorname3() : "").
            " ".$this->getNachname();
    }
}

