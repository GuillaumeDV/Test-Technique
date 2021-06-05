<?php

namespace App\Entity;

use App\Repository\SubCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubCategoryRepository::class)
 */
class SubCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="subCategories")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=SubSubCategory::class, mappedBy="subCategory")
     */
    private $subSubCategories;

    public function __construct()
    {
        $this->subSubCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|SubSubCategory[]
     */
    public function getSubSubCategories(): Collection
    {
        return $this->subSubCategories;
    }

    public function addSubSubCategory(SubSubCategory $subSubCategory): self
    {
        if (!$this->subSubCategories->contains($subSubCategory)) {
            $this->subSubCategories[] = $subSubCategory;
            $subSubCategory->setSubCategory($this);
        }

        return $this;
    }

    public function removeSubSubCategory(SubSubCategory $subSubCategory): self
    {
        if ($this->subSubCategories->removeElement($subSubCategory)) {
            // set the owning side to null (unless already changed)
            if ($subSubCategory->getSubCategory() === $this) {
                $subSubCategory->setSubCategory(null);
            }
        }

        return $this;
    }
}
