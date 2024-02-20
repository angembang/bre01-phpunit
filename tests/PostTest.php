<?php
// Déclaration du mode strict des types 
declare(strict_types=1);

// Importation de la classe de base pour les tests unitaires de PHPUnit
use PHPUnit\Framework\TestCase;

// Déclaration de la classe de test PostTest  qui étend TestCase
class PostTest extends TestCase
{
    // Teste la création d'une instance de Post avec des valeurs valides
    public function testCanBeCreatedFromValidAttribute(): void
    {
        $title = 'Valid Title';
        $content = 'Valid Content';
        $slug = 'valid-slug';

        $post = Post::ensureIsValidPost($title, $content, $slug);
        
        $this->assertInstanceOf(Post::class, $post);
        $this->assertSame($title, $post->getTitle());
        $this->assertSame($content, $post->getContent());
        $this->assertSame($slug, $post->getSlug());
        $this->assertFalse($post->getPrivate());
    }
    
    // Teste la création d'une instance de Post avec un titre vide
    public function testCanNotBeCreatedFromEmptyTitle(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Post::ensureIsValidPost("", "content", "slug");
    }
    
    
    // Teste la création d'une instance de Post avec un contenu vide
    public function testCanNotBeCreatedFromEmptyContent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Post::ensureIsValidPost("title", "", "slug");
    }
    
    // Teste la création d'une instance de Post avec un slug vide
    public function testCanNotBeCreatedFromEmptySlug(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Post::ensureIsValidPost("title", "content", "");
    }
    
    // Teste la création d'une instance de Post avec un slug ne contenant pas que des caractères URL safe
    public function testCanNotBeCreatedFromInvalidSlug(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Post::ensureIsValidPost("title", "content", "invalidSulg@gmail.com");
    }
    
}