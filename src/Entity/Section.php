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

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: SectionType::class)]
    private $sectiontypes;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->sectiontypes = new ArrayCollection();
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

    /**
     * @return Collection<int, SectionType>
     */
    public function getSectiontypes(): Collection
    {
        return $this->sectiontypes;
    }

    public function addSectiontype(SectionType $sectiontype): self
    {
        if (!$this->sectiontypes->contains($sectiontype)) {
            $this->sectiontypes[] = $sectiontype;
            $sectiontype->setSection($this);
        }

        return $this;
    }

    public function removeSectiontype(SectionType $sectiontype): self
    {
        if ($this->sectiontypes->removeElement($sectiontype)) {
            // set the owning side to null (unless already changed)
            if ($sectiontype->getSection() === $this) {
                $sectiontype->setSection(null);
            }
        }

        return $this;
    }
}
