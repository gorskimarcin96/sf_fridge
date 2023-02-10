<?php

namespace App\Entity;

use App\Entity\Enum\UnitFood;
use App\Repository\RecipeImageRepository;
use Doctrine\ORM\Exception\EntityMissingAssignedId;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeImageRepository::class)]
class RecipeFood
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recipeImages')]
    private Recipe $recipe;

    #[ORM\ManyToOne(inversedBy: 'recipeFood')]
    private Food $food;

    #[ORM\Column(enumType: UnitFood::class)]
    private UnitFood $unitFood;

    #[ORM\Column()]
    private int $volume;

    /** @throws EntityMissingAssignedId */
    public function getId(): int
    {
        return $this->id ?? throw new EntityMissingAssignedId();
    }

    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getFood(): Food
    {
        return $this->food;
    }

    public function setFood(Food $food): self
    {
        $this->food = $food;

        return $this;
    }

    public function getUnitFood(): UnitFood
    {
        return $this->unitFood;
    }

    public function setUnitFood(UnitFood $unitFood): self
    {
        $this->unitFood = $unitFood;

        return $this;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }
}
