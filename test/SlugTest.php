<?php
require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__).'/../lib/Slug.class.php';

class SlugTest extends PHPUnit_Framework_TestCase
{
  public function testBasicNoOptions()
  {
    $this->assertEquals((string) new Slug('Hello World!'), 'hello-world');
    $this->assertEquals((string) new Slug('Hello! World!'), 'hello-world', 'remove multiple seperation chars "! "');
    $this->assertEquals((string) new Slug('Grüne Kräuter & Weißwein'), 'gruene-kraeuter-weisswein', 'checking char list changes');
  }

  /**
  * @depends testBasicNoOptions
  */
  public function testNoToLower()
  {
    $this->assertEquals((string) new Slug('Hello World!', array('to_lower' => false)), 'Hello-World');
  }

  /**
  * @depends testBasicNoOptions
  */
  public function testChangeSeperatorChar()
  {
    $this->assertEquals((string) new Slug('Hello World!', array('seperator_char' => '_')), 'hello_world');
  }

  /**
  * @depends testBasicNoOptions
  */
  public function testPrePostFix()
  {
    $this->assertEquals((string) new Slug('Hello World!', array('prefix' => 'i-say-')), 'i-say-hello-world', 'testing prefix');
    $this->assertEquals((string) new Slug('Hello World!', array('postfix' => '-42')), 'hello-world-42', 'testing postfix');
    $this->assertEquals((string) new Slug('Hello World!', array('postfix' => '-?')), 'hello-world-?', 'testing special char as postfix');
    $this->assertEquals((string) new Slug('Hello World!', array('postfix' => '-42', 'prefix' => 'i-say-')), 'i-say-hello-world-42', 'testing prefix and postfix');
  }

  /**
  * @depends testBasicNoOptions
  */
  public function testShorten()
  {
    $this->assertEquals((string) new Slug('Hello wonderful World!', array('max_length' => 20)), 'hello-wonderful');
    $this->assertEquals((string) new Slug('Hello!?!?!!!!!!!!!!!!!! wonderful World!$$$', array('max_length' => 20)), 'hello-wonderful');
    $this->assertEquals((string) new Slug('Hello woooooooooooooooonderful World!', array('max_length' => 20)), 'hello-wooooooooooooo', 'Words are cutted If the removal would make the slug smaller than max_lenght/2 chars');
  }

  /**
  * @depends testShorten
  */
  public function testShortenPrePostFix()
  {
    $this->assertEquals((string) new Slug('Hello wonderful World!', array('postfix' => '-42', 'prefix' => 'i-say-', 'max_length' => 27)), 'i-say-hello-wonderful-42', 'the url length is an absolute length (with prefix & postfix)');
    $this->assertEquals((string) new Slug('Hello wonderful World!', array('postfix' => '-forty-two', 'prefix' => 'i-say-', 'max_length' => 15)), 'i-say-hello-wonderful-world-forty-two', 'NO Shortening when prefix & postfix are longer than max_length');
  }
}
?>