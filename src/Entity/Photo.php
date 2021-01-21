<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity
 * @UniqueEntity("title")
 */
class Photo
{
    
    const THEME = [
        1 => 'Street Art',
        2 => 'Portraits',
        3 => 'Evenements'
    ];

    const ORIENTATION = [
        1 => 'Portrait',
        2 => 'Paysage'
    ];

    const HEADER = [
        1 => 'Diapositive',
        2 => 'Presentation',
        3 => 'Bannière',
        4 => 'Carré d\'or ',
        5 => 'Mosaique'
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *@Assert\Length(min=20, max=255)
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="theme", type="integer", nullable=false)
     */
    private $theme;

    /**
     * @var int
     *
     * @ORM\Column(name="orientation", type="integer", nullable=false)
     */
    private $orientation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="header", type="integer", nullable=false)
     */
    private $header;

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

    public function getTheme(): ?int
    {
        return $this->theme;
    }

    public function setTheme(int $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
    
    public function getThemeType(): string
    {
        return self::THEME[$this->theme];
    }

    public function getSlug(): string {
        return (new Slugify())->slugify($this->getThemeType());
    }

    public function getOrientation(): ?int
    {
        return $this->orientation;
    }

    public function setOrientation(int $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }
    
    public function getOrientationType(): string
    {
        return self::ORIENTATION[$this->orientation];
    }

    public function getcreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getHeader(): ?int
    {
        return $this->header;
    }

    public function setHeader(int $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getHeaderType(): string
    {
        return self::HEADER[$this->header];// {{ photo.headerType}}
    }

}
