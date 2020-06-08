<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Cocur\Slugify\Slugify;
/**
 * @ORM\Entity(repositoryClass="App\Repository\LMRepository")
 */
class LM
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_entreprise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $first_name_contact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_name_contact;

    /**
     * @ORM\Column(type="date")
     */
    private $date_lm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lm_object;

    /**
     * @ORM\Column(type="text")
     */
    private $lm_content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEntreprise(): ?string
    {
        return $this->name_entreprise;
    }

    public function setNameEntreprise(string $name_entreprise): self
    {
        $this->name_entreprise = $name_entreprise;

        return $this;
    }
    /************************ SLUG ***************************************************/
        public function getSlug(): string
        {
           return $slugify = (new Slugify())->slugify($this->name_entreprise);
        }
    /***************************************************************************/

    public function getFirstNameContact(): ?string
    {
        return $this->first_name_contact;
    }

    public function setFirstNameContact(?string $first_name_contact): self
    {
        $this->first_name_contact = $first_name_contact;

        return $this;
    }

    public function getLastNameContact(): ?string
    {
        return $this->last_name_contact;
    }

    public function setLastNameContact(?string $last_name_contact): self
    {
        $this->last_name_contact = $last_name_contact;

        return $this;
    }

    public function getDateLm(): ?\DateTimeInterface
    {
        return $this->date_lm;
    }

    public function setDateLm(\DateTimeInterface $date_lm): self
    {
        $this->date_lm = $date_lm;

        return $this;
    }

    public function getLmObject(): ?string
    {
        return $this->lm_object;
    }

    public function setLmObject(string $lm_object): self
    {
        $this->lm_object = $lm_object;

        return $this;
    }

    public function getLmContent(): ?string
    {
        return $this->lm_content;
    }

    public function setLmContent(string $lm_content): self
    {
        $this->lm_content = $lm_content;

        return $this;
    }


}
