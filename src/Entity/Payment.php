<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PaymentDriver", mappedBy="payment")
     */
    private $paymentDriver;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PaymentSupplier", mappedBy="payment")
     */
    private $paymentCar;

    /**
     * @ORM\Column(type="decimal", precision=50, scale=2)
     */
    private $totalAmountToPay;

    /**
     * @ORM\Column(type="decimal", precision=50, scale=2)
     */
    private $totalAmountPaid;

    /**
     * @ORM\Column(type="decimal", precision=50, scale=2)
     */
    private $remainingAmount;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Mission", inversedBy="payment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->paymentDriver = new ArrayCollection();
        $this->paymentCar = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|PaymentDriver[]
     */
    public function getPaymentDriver(): Collection
    {
        return $this->paymentDriver;
    }

    public function addPaymentDriver(PaymentDriver $paymentDriver): self
    {
        if (!$this->paymentDriver->contains($paymentDriver)) {
            $this->paymentDriver[] = $paymentDriver;
            $paymentDriver->setPayment($this);
        }

        return $this;
    }

    public function removePaymentDriver(PaymentDriver $paymentDriver): self
    {
        if ($this->paymentDriver->contains($paymentDriver)) {
            $this->paymentDriver->removeElement($paymentDriver);
            // set the owning side to null (unless already changed)
            if ($paymentDriver->getPayment() === $this) {
                $paymentDriver->setPayment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PaymentSupplier[]
     */
    public function getPaymentCar(): Collection
    {
        return $this->paymentCar;
    }

    public function addPaymentCar(PaymentSupplier $paymentCar): self
    {
        if (!$this->paymentCar->contains($paymentCar)) {
            $this->paymentCar[] = $paymentCar;
            $paymentCar->setPayment($this);
        }

        return $this;
    }

    public function removePaymentCar(PaymentSupplier $paymentCar): self
    {
        if ($this->paymentCar->contains($paymentCar)) {
            $this->paymentCar->removeElement($paymentCar);
            // set the owning side to null (unless already changed)
            if ($paymentCar->getPayment() === $this) {
                $paymentCar->setPayment(null);
            }
        }

        return $this;
    }

    public function getTotalAmountToPay()
    {
        return $this->totalAmountToPay;
    }

    public function setTotalAmountToPay($totalAmountToPay): self
    {
        $this->totalAmountToPay = $totalAmountToPay;

        return $this;
    }

    public function getTotalAmountPaid()
    {
        return $this->totalAmountPaid;
    }

    public function setTotalAmountPaid($totalAmountPaid): self
    {
        $this->totalAmountPaid = $totalAmountPaid;

        return $this;
    }

    public function getRemainingAmount()
    {
        return $this->remainingAmount;
    }

    public function setRemainingAmount($remainingAmount): self
    {
        $this->remainingAmount = $remainingAmount;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
