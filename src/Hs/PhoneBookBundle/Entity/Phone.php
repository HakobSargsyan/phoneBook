<?php

namespace Hs\PhoneBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Phone
 *
 * @ORM\Table(name="phones")
 * @ORM\Entity(repositoryClass="Hs\PhoneBookBundle\Repository\PhoneRepository")
 */
class Phone
{
    /**
     * Many Phones have Many Persons.
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="phones")
     */
    private $persons;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;

    public function __construct() {
        $this->persons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=50)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=50)
     */
    private $zipCode;

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
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Phone
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Phone
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Add person
     *
     * @param \Hs\PhoneBookBundle\Entity\Person $person
     *
     * @return Phone
     */
    public function addPerson($person)
    {
        $this->persons[] = $person;
        return $this;
    }

    public function __toString() {
        return $this->phoneNumber;
    }

    /**
     * Remove person
     *
     * @param \Hs\PhoneBookBundle\Entity\Person $person
     */
    public function removePerson(\Hs\PhoneBookBundle\Entity\Person $person)
    {
        $this->persons->removeElement($person);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersons()
    {
        return $this->persons;
    }
}
