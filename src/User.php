<?php
declare(strict_types=1);

class User
{
    // Propriétés de la classe
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private array $roles;

    // Constructeur de la classe
    public function __construct(string $firstName, string $lastName, string $email, string $password, array $roles)
    {
        // Vérifications des valeurs fournies
        $this->ensureIsEmptyFirstName($firstName);
        $this->ensureIsEmptyLastName($lastName);
        $this->ensureIsValidEmail($email);
        $this->ensureIsValidPassword($password);
        $this->ensureIsValidRoles($roles);

        // Initialisation des propriétés
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->roles = ["ANONYMOUS"];
    }

    // Méthode statique pour créer une instance de l'utilisateur
    public static function ensureIsValidUser(string $firstName, string $lastName, string $email, string $password, array $roles): self
    {
        return new self($firstName, $lastName, $email, $password, $roles);
    }

    // Méthode privée pour vérifier si le prénom est vide
    private function ensureIsEmptyFirstName(string $firstName): void
    {
        if (empty($firstName)) {
            throw new InvalidArgumentException("FirstName can not be empty");
        }
    }

    // Méthode privée pour vérifier si le nom de famille est vide
    private function ensureIsEmptyLastName(string $lastName): void
    {
        if (empty($lastName)) {
            throw new InvalidArgumentException("LastName can not be empty");
        }
    }

    // Méthode privée pour vérifier la validité de l'adresse e-mail
    private function ensureIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
    }

    // Méthode privée pour vérifier la validité du mot de passe
    private function ensureIsValidPassword(string $password): void
    {
        if (
            strlen($password) < 8 ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[^a-zA-Z0-9]/', $password)
        ) {
            throw new InvalidArgumentException("The password must contain a minimum of 8 characters: at least one capital letter, at least one number, and at least one special character");
        }
    }

    // Méthode privée pour vérifier la validité des rôles
    private function ensureIsValidRoles(array $roles): void
    {
        if (count($roles) < 1) {
            throw new InvalidArgumentException("The user must have a minimum ANONYMOUS role");
        }

        // Si le rôle est USER ou ADMIN, supprime ANONYMOUS s'il est présent
        else if (in_array($roles, ['USER', 'ADMIN'], true)) {
            $key = array_search('ANONYMOUS', $this->roles, true);
            if ($key !== false) {
                unset($this->roles[$key]);
            }
        }
    }

    // Les getters (méthodes publiques pour récupérer les propriétés de l'utilisateur)
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    // Les setters (méthodes publiques pour définir les propriétés de l'utilisateur)
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    // Méthodes publiques pour ajouter et supprimer des rôles
    public function addRole(string $newRole): array
    {
        $this->ensureIsValidRole($newRole);
        $this->roles[] = $newRole;

        return $this->roles;
    }

    public function removeRole(string $role): array
    {
        $this->ensureIsValidRole($role);
        $key = array_search($role, $this->roles, true);

        if ($key !== false) {
            unset($this->roles[$key]);
        }

        return $this->roles;
    }


}