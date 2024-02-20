<?php
declare(strict_types=1);

class User
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private array $roles;
    
    
    
    public function __construct(string $firstName, string $lastName, string $email, string $password, array $roles)
    {
        $this->ensureIsEmptyFirstName($firstName);
        $this->ensureIsEmptyLastName($lastName);
        $this->ensureIsValidEmail($email);
        $this->ensureIsValidPassword($password);
        $this->ensureIsValidRoles($roles);
        
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->roles = ["ANONYMOUS"];
    }
    
   
   
   
   
   public static function ensureIsValidUser(string $firstName, string $lastName, string $email, string $password, array $roles): self
   {
       return new self($firstName, $lastName, $email, $password, $roles);
   }
   
   private function ensureIsEmptyFirstName(string $firstName): void
   {
       if(empty($firstName))
       {
           throw new InvalidArgumentException("FirstName can not be empty");
       }
   }
   private function ensureIsEmptyLastName(string $lastName): void
   {
       if(empty($lastName))
       {
           throw new InvalidArgumentException("LastName can not be empty");
       }
   }
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
    private function ensureIsValidPassword(string $password): void
    {
        if (
            strlen($password) < 8 ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[^a-zA-Z0-9]/', $password)
        ) {
            throw new InvalidArgumentException("The password must content minimum 8 characters: minimum
            one capital letter, minimum one number et minimum one special character");
        }
    }
    private function ensureIsValidRoles(array $roles): void
    {
        if(count($roles)< 1)
        {
            throw new InvalidArgumentException("The user must have minimum ANONYMOUS role");
        }
        // If the role is USER or ADMIN, remove ANONYMOUS if present
        else if (in_array($roles, ['USER', 'ADMIN'], true)) {
            $key = array_search('ANONYMOUS', $this->roles, true);
            if ($key !== false) {
                unset($this->roles[$key]);
            }
        }
    }
    
    
    
    
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
    
    
    
    
    
    public function addRole(string $newRole) : array
    {
        $this->ensureIsValidRole($newRole);
        $this->roles[] = $newRole;

        return $this->roles;
    }
    
    public function removeRole(string $role) : array
    {
        $this->ensureIsValidRole($role);
        $key = array_search($role, $this->roles, true);

        if ($key !== false) {
            unset($this->roles[$key]);
        }

        return $this->roles;
    }
    
   
}