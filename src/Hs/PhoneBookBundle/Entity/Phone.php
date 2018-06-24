<?php

namespace Hs\PhoneBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Regex(pattern="/[0-9]/", message="Only Numbers")
     * @ORM\Column(name="phone_number", type="string", length=50)
     */
    private $phoneNumber;

    /**
     * @var string
     * @Assert\NotBlank()
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

    public function __toString()
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
