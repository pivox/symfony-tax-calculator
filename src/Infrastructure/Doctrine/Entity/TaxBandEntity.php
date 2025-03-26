<?php

namespace App\Infrastructure\Doctrine\Entity;

use App\Domain\Model\TaxBand;
use App\Infrastructure\Doctrine\Repository\TaxBandEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxBandEntityRepository::class)]
class TaxBandEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'from_value', nullable: true)]
    private ?float $from = null;

    #[ORM\Column(name: 'to_value', nullable: true)]
    private ?float $to = null;

    #[ORM\Column(nullable: true)]
    private ?float $rate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrom(): ?float
    {
        return $this->from;
    }

    public function setFrom(?float $from): static
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): ?float
    {
        return $this->to;
    }

    public function setTo(?float $to): static
    {
        $this->to = $to;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(?float $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function toDomain(): TaxBand
    {
        return new TaxBand($this->from, $this->to, $this->rate);
    }
}
