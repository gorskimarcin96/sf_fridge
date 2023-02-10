<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\ORM\Exception\EntityMissingAssignedId;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
class Food implements TranslatableInterface
{
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** @throws EntityMissingAssignedId */
    public function getId(): int
    {
        return $this->id ?? throw new EntityMissingAssignedId();
    }
}
