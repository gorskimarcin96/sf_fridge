<?php

namespace App\Entity;

use App\Repository\RecipeImageRepository;
use Doctrine\ORM\Exception\EntityMissingAssignedId;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeImageRepository::class)]
class RecipeImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fileFn = null;

    #[ORM\ManyToOne(inversedBy: 'recipeImages')]
    private ?Recipe $recipe = null;

    /** @throws EntityMissingAssignedId */
    public function getId(): int
    {
        return $this->id ?? throw new EntityMissingAssignedId();
    }

    public function getFileFn(): ?string
    {
        return $this->fileFn;
    }

    public function setFileFn(string $fileFn): self
    {
        $this->fileFn = $fileFn;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}
