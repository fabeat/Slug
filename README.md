Slug
====

*A little PHP project to simplify slug generation for URLs in web-projects.*

Usage
-----

### Basic usage

    require_once '/path/to/Slug.class.php';
    $slug_string = (string) new Slug('Hello World!');
    echo $slug_string;

**Output:** hallo-welt

### Basic usage (with max-length)

    echo new Slug('A PHP project to simplify slug generation.', array('max_length' => 20));

**Output:** a-php-project-to

You might notice that the slug is automatically shortened so that there are **no cutted words**.
This only applies if the cutted word part is smaller than half the generated slug.

*see test/SlugTest.php for more examples.*

If you want to run the tests, install PHPUnit from http://www.phpunit.de/ and run

    phpunit SlugTest
