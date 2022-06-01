<?php

namespace App\Entity;

use App\Repository\TblclientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: TblclientRepository::class)]
class Tblclient implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $clientId;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $clientLogin;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string', length: 255)]
    private $clientPass;

    #[ORM\Column(type: 'text', nullable: true)]
    private $clientTxtLg1;

    #[ORM\Column(type: 'date')]
    private $clientDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientImg;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientFichier;

    #[ORM\Column(type: 'date')]
    private $clientDateOn;

    #[ORM\Column(type: 'date')]
    private $clientDateOff;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientNom;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientPrenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientTitre;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientAdresse;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $clientAdresse2;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientCP;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientVille;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientPays;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientMail;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientTel;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $clientTel2;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientPseudo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $clientToken;

    public function getClientId(): ?int
    {
        return $this->id;
    }

    public function getClientLogin(): ?string
    {
        return $this->clientLogin;
    }

    public function setClientLogin(string $clientLogin): self
    {
        $this->clientLogin = $clientLogin;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->clientLogin;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->clientLogin;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->clientPass;
    }

    public function setPassword(string $clientPass): self
    {
        $this->clientPass = $clientPass;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getClientTxtLg1(): ?string
    {
        return $this->clientTxtLg1;
    }

    public function setClientTxtLg1(?string $clientTxtLg1): self
    {
        $this->clientTxtLg1 = $clientTxtLg1;

        return $this;
    }

    public function getClientDate(): ?\DateTimeInterface
    {
        return $this->clientDate;
    }

    public function setClientDate(\DateTimeInterface $clientDate): self
    {
        $this->clientDate = $clientDate;

        return $this;
    }

    public function getClientImg(): ?string
    {
        return $this->clientImg;
    }

    public function setClientImg(string $clientImg): self
    {
        $this->clientImg = $clientImg;

        return $this;
    }

    public function getClientFichier(): ?string
    {
        return $this->clientFichier;
    }

    public function setClientFichier(string $clientFichier): self
    {
        $this->clientFichier = $clientFichier;

        return $this;
    }

    public function getClientDateOn(): ?\DateTimeInterface
    {
        return $this->clientDateOn;
    }

    public function setClientDateOn(\DateTimeInterface $clientDateOn): self
    {
        $this->clientDateOn = $clientDateOn;

        return $this;
    }

    public function getClientDateOff(): ?\DateTimeInterface
    {
        return $this->clientDateOff;
    }

    public function setClientDateOff(\DateTimeInterface $clientDateOff): self
    {
        $this->clientDateOff = $clientDateOff;

        return $this;
    }

    public function getClientNom(): ?string
    {
        return $this->clientNom;
    }

    public function setClientNom(string $clientNom): self
    {
        $this->clientNom = $clientNom;

        return $this;
    }

    public function getClientPrenom(): ?string
    {
        return $this->clientPrenom;
    }

    public function setClientPrenom(string $clientPrenom): self
    {
        $this->clientPrenom = $clientPrenom;

        return $this;
    }

    public function getClientTitre(): ?string
    {
        return $this->clientTitre;
    }

    public function setClientTitre(string $clientTitre): self
    {
        $this->clientTitre = $clientTitre;

        return $this;
    }

    public function getClientAdresse(): ?string
    {
        return $this->clientAdresse;
    }

    public function setClientAdresse(string $clientAdresse): self
    {
        $this->clientAdresse = $clientAdresse;

        return $this;
    }

    public function getClientAdresse2(): ?string
    {
        return $this->clientAdresse2;
    }

    public function setClientAdresse2(?string $clientAdresse2): self
    {
        $this->clientAdresse2 = $clientAdresse2;

        return $this;
    }

    public function getClientCP(): ?string
    {
        return $this->clientCP;
    }

    public function setClientCP(string $clientCP): self
    {
        $this->clientCP = $clientCP;

        return $this;
    }

    public function getClientVille(): ?string
    {
        return $this->clientVille;
    }

    public function setClientVille(string $clientVille): self
    {
        $this->clientVille = $clientVille;

        return $this;
    }

    public function getClientPays(): ?string
    {
        return $this->clientPays;
    }

    public function setClientPays(string $clientPays): self
    {
        $this->clientPays = $clientPays;

        return $this;
    }

    public function getClientMail(): ?string
    {
        return $this->clientMail;
    }

    public function setClientMail(string $clientMail): self
    {
        $this->clientMail = $clientMail;

        return $this;
    }

    public function getClientTel(): ?string
    {
        return $this->clientTel;
    }

    public function setClientTel(string $clientTel): self
    {
        $this->clientTel = $clientTel;

        return $this;
    }

    public function getClientTel2(): ?string
    {
        return $this->clientTel2;
    }

    public function setClientTel2(?string $clientTel2): self
    {
        $this->clientTel2 = $clientTel2;

        return $this;
    }

    public function getClientPseudo(): ?string
    {
        return $this->clientPseudo;
    }

    public function setClientPseudo(string $clientPseudo): self
    {
        $this->clientPseudo = $clientPseudo;

        return $this;
    }

    public function getClientToken(): ?string
    {
        return $this->clientToken;
    }

    public function setClientToken(?string $clientToken): self
    {
        $this->clientToken = $clientToken;

        return $this;
    }
}
