<?php

namespace Hs\PhoneBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="Hs\PhoneBookBundle\Repository\PersonRepository")
 */
class Person
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
     * Many Persons have Many Phones.
     * @ORM\ManyToMany(targetEntity="Phone",inversedBy="persons" ,cascade={"persist"})
     * @ORM\JoinTable(name="phones_persons")
     */
    private $phones;
    
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->firstname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Person
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Person
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Person
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add phone
     *
     * @param \Hs\PhoneBookBundle\Entity\Phone $phone
     *
     * @return Person
     */
    public function addPhone(\Hs\PhoneBookBundle\Entity\Phone $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }

    /**
     * Remove phone
     *
     * @param \Hs\PhoneBookBundle\Entity\Phone $phone
     */
    public function removePhone(\Hs\PhoneBookBundle\Entity\Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }
}
