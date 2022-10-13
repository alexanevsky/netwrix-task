<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'partner_locator')]
#[ORM\Entity()]
class PartnerLocator
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $company = '';

    #[ORM\Column(type: 'string')]
    private string $status = '';

    #[ORM\Column(type: 'string')]
    private string $logo = '';

    #[ORM\Column(type: 'string')]
    private string $address = '';

    #[ORM\Column(type: 'string')]
    private string $website = '';

    #[ORM\Column(type: 'string', length: 40)]
    private string $phone = '';

    #[ORM\Column(type: 'string', length: 1000)]
    private string $countriesCovered = '[]';

    #[ORM\Column(type: 'string', length: 1000)]
    private string $statesCovered = '[]';

    public function getId(): int
    {
        return $this->id;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCountriesCovered(): array
    {
        return json_decode($this->countriesCovered, true);
    }

    public function setCountriesCovered(array $countriesCovered): self
    {
        $this->countriesCovered = json_encode($countriesCovered);

        return $this;
    }

    public function getStatesCovered(): array
    {
        return json_decode($this->statesCovered, true);
    }

    public function setStatesCovered(array $statesCovered): self
    {
        $this->statesCovered = json_encode($statesCovered);

        return $this;
    }
}
