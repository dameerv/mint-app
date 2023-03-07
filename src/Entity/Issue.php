<?php

namespace App\Entity;

use App\Exception\OnlyAdminRoleAcceptableException;
use App\Repository\IssueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IssueRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Issue
{
    use DateTimeTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $text;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isClosed = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isResolved = false;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private ?User $admin;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="issue")
     */
    private $messages;

    /**
     * @ORM\OneToOne(targetEntity=Chat::class, mappedBy="issue", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $chat;

    public function __construct(
        string $title,
        string $text
    ) {
        $this->messages = new ArrayCollection();
        $this->setTitle($title);
        $this->setText($text);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getIsClosed(): ?bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): self
    {
        $this->isClosed = $isClosed;

        return $this;
    }

    public function getIsResolved(): ?bool
    {
        return $this->isResolved;
    }

    public function setIsResolved(bool $isResolved): self
    {
        $this->isResolved = $isResolved;

        return $this;
    }

    public function getAdmin(): ?User
    {
        return $this->admin;
    }

    public function setAdmin(?User $user): self
    {
        if (!$user->isAdmin()) {
            throw new OnlyAdminRoleAcceptableException();
        }

        $this->admin = $user;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setIssue($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getIssue() === $this) {
                $message->setIssue(null);
            }
        }

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(Chat $chat): self
    {
        // set the owning side of the relation if necessary
        if ($chat->getIssue() !== $this) {
            $chat->setIssue($this);
        }

        $this->chat = $chat;

        return $this;
    }
}
