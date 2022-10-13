<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'loc_country')]
#[ORM\Entity()]
#[ORM\Index(name: 'name', columns: ['name'])]
#[ORM\Index(name: 'short_name', columns: ['short_name'])]
class Country
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $countryId;

    #[ORM\Column(type: 'string')]
    private string $name = '';

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $shortName = null;

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(?string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }
}
