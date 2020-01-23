<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Product
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "The product name must be at least {{ limit }} characters long",
     *      maxMessage = "The product name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $productName;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 13,
     *      minMessage = "The product id must be at least {{ limit }} characters long",
     *      maxMessage = "The product id cannot be longer than {{ limit }} characters"
     * )
     */
    protected $productId;
    /**
     * @Assert\Length(
     *      min = 0,
     *      max = 30,
     *      maxMessage = "The product id length cannot be longer than {{ limit }} characters"
     * )
     */
    protected $productManager;

    /**
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */
    protected $salesStartDate;

    /**
     * @return string
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return int
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getProductManager(): ?string
    {
        return $this->productManager;
    }

    /**
     * @param string $productManager
     */
    public function setProductManager(?string $productManager): void
    {
        $this->productManager = $productManager;
    }

    /**
     * @return \DateTime
     */
    public function getSalesStartDate(): ?\DateTime
    {
        return $this->salesStartDate;
    }

    /**
     * @param mixed $salesStartDate
     */
    public function setSalesStartDate($salesStartDate): void
    {
        $this->salesStartDate = $salesStartDate;
    }


}