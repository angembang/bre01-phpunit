<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCanBeCreatedFromValidAttribute(): void
    {
        $firstName = "valid firstName";
        $lastName = "valid lastName";
        $email = "example@gmail.com";
        $password = "MamanRosa1.&";
        $roles = ["ANONYMOUS"];
      
        
        
        $user = User::ensureIsValidUser( $firstName, $lastName, $email, $password, $roles);
        
        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($firstName, $user->getFirstName());
        $this->assertSame($lastName, $user->getLastName());
        $this->assertSame($email, $user->getEmail());
        $this->assertSame($password, $user->getPassword());
        $this->assertSame($roles, $user->getRoles());
    }
    
    
    // Teste la création d'une instance de user avec un firstName vide
    public function testCanNotBeCreatedFromEmptyFirstName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        User::ensureIsValidUser("", "lastName", "email", "password", []);
    }
    
    
    // Teste la création d'une instance de user avec un lastName vide
    public function testCanNotBeCreatedFromEmptyLastName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        User::ensureIsValidUser("firstName", "", "email", "password", []);
    }
    
    // Teste la création d'une instance de user avec un email invalide
    public function testCanNotBeCreatedFromInvalidEmail(): void
    {
        $this->expectException(InvalidArgumentException::class);
        User::ensureIsValidUser("firstName", "lastName", "love3333", "password", []);
    }
    
    // Teste la création d'une instance de user avec un pasword invalide
    public function testCanNotBeCreatedFromInvalidPassword(): void
    {
        $this->expectException(InvalidArgumentException::class);
        User::ensureIsValidUser("firstName", "lastName", "email", "MamanRosa", []);
    }
    
    // Teste la création d'une instance de user avec invalid role
    public function testCanNotBeCreatedFromInvalidRoles(): void
    {
        $this->expectException(InvalidArgumentException::class);
        User::ensureIsValidUser("firstName", "lastName", "email", "password", []);
    }
}