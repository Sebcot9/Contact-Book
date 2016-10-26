<?php

namespace ContactBundle\Entity;

use ContactBundle\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ContactBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     */
    protected $email;

    /**
     *
     * @var Contact
     * 
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="user", cascade={"persist","remove"})
     */
    private $contacts;
    
    public function __construct() {
        parent::__construct();
        $this->contacts = new ArrayCollection();
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    public function addContact(Contact $contact)
    {
        if($this !== $contact->getEmail())
            {
                $contact->setUser($this);
                $this->contacts->add($contact);
            }
    }
    
    public function removeContact(Contact $contact)
    {
        if($this === $contact->getUser())
        {
            $this->contacts-remove($contact);
        }
    }
}
