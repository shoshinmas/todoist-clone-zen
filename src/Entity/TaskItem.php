<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TaskItemRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

#[ORM\Entity(repositoryClass: TaskItemRepository::class)]
class TaskItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\Column(type: 'integer')]
    private $flag;

    #[ORM\Column(type: 'string', length: 255)]
    private $taskItemText;

    #[ORM\Column(type: 'boolean')]
    private $isDone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFlag(): ?int
    {
        return $this->flag;
    }

    public function setFlag(int $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getTaskItemText(): ?string
    {
        return $this->taskItemText;
    }

    public function setTaskItemText(string $taskItemText): self
    {
        $this->taskItemText = $taskItemText;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;
        
        return $this;
    }

    public function __toString() {
        return $this->taskItemText;
    }
}
