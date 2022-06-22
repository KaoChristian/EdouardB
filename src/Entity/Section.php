<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Article::class)]
    private $articles;

    #[ORM\ManyToOne(targetEntity: SectionCategory::class, inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private $sectionCategory;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSectionType(): ?SectionType
    {
        return $this->sectionType;
    }

    public function setSectionType(?SectionType $sectionType): self
    {
        $this->sectionType = $sectionType;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setSection($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getSection() === $this) {
                $article->setSection(null);
            }
        }

        return $this;
    }

    public function getSectionCategory(): ?SectionCategory
    {
        return $this->sectionCategory;
    }

    public function setSectionCategory(?SectionCategory $sectionCategory): self
    {
        $this->sectionCategory = $sectionCategory;

        return $this;
    }
}
