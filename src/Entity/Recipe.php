<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Exception\EntityMissingAssignedId;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe implements TranslatableInterface
{
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** @var Collection<int, RecipeImage> */
    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: RecipeImage::class)]
    private Collection $recipeImages;

    public function __construct()
    {
        $this->recipeImages = new ArrayCollection();
    }

    /** @throws EntityMissingAssignedId */
    public function getId(): int
    {
        return $this->id ?? throw new EntityMissingAssignedId();
    }

    /** @return Collection<int, RecipeImage> */
    public function getRecipeImages(): Collection
    {
        return $this->recipeImages;
    }

    public function addRecipeImage(RecipeImage $recipeImage): self
    {
        if (!$this->recipeImages->contains($recipeImage)) {
            $this->recipeImages->add($recipeImage);
            $recipeImage->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeImage(RecipeImage $recipeImage): self
    {
        if ($this->recipeImages->removeElement($recipeImage) && $recipeImage->getRecipe() === $this) {
            $recipeImage->setRecipe(null);
        }

        return $this;
    }
}
