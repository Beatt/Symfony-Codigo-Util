<?php

namespace Beat\Beat\PruebaBundle\Tests\Controller;

use Beat\Beat\PruebaBundle\Entity\Dog;
use Beat\Beat\PruebaBundle\Entity\Animal;

use Beat\Beat\PruebaBundle\Form\DogType;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnimalControllerTest extends WebTestCase
{
	
	 
    private $em;

    /**
     * Sets up environment for testing
     * Regenerates Database schema before every test-run
     */
    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel -> boot();
        $this -> em = static::$kernel->getContainer()
                                     ->get('doctrine')
                                     ->getManager();
        //$this->regenerateSchema();
    }

    protected function tearDown() {
        parent::tearDown();
		$this->em->close();
    }

    /**
     * Drops current schema and creates a brand new one
     */
    protected function regenerateSchema() {
        $metadatas = $this->em->getMetadataFactory()->getAllMetadata();
        if (!empty($metadatas)) {
            $tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
            //$tool -> dropSchema($metadatas);
            //$tool -> createSchema($metadatas);
        }
    }
	
	/*public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }*/
	
		
	public function testMiPrueba()
	{
		
		//$dog = $this->getMock("\Beat\Beat\PruebaBundle\Entity\Dog");
		
		$dog = new Dog();
		
		$dog->setName("Perrito4");
		$dog->setAge(' ');
		$dog->setWeight(200);
		$dog->setUrlImagen('.../algo');
		$dog->setBreed("Chichimeca");
		
		// $this->em->persist($dog);
		// $this->em->flush();
		
		
		$dog2 = new Dog();
		
		$dog2->setName("Perrito");
		$dog2->setAge(22);
		$dog2->setWeight(200);
		$dog2->setUrlImagen('.../algo');
		$dog2->setBreed("Chichimeca");
		
		//$this->em->persist($dog2);
		//$this->em->flush();
		
		
				
		//$dogs = $this->em->getRepository("BeatBeatPruebaBundle:Animal")->findAll();
				
		
		//$this->assertEquals(false, $dogs[0]->getAge());		
		
		//$client = static::createClient();
		
		//$crawler = $client->request('GET', '/animal/');

        //$this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
        
        //$this->assertTrue($crawler->filter('label:contains("Nombre")'));
        
		/*$this->assertGreaterThan(
    		0,
    		$crawler->filter('label.required')->count()
		);*/
		
		//$this->assertTrue(1 === 1);
				
		//$this->assertEquals("Algo", $animal->getName());
		
	}
	
	// Test unitarios
	public function testUtilizandoDoctrineSqlite() {
		
		$dog = new Dog();
		
		$dog->setName("Perrito");
		$dog->setAge(22);
		$dog->setWeight(200);
		$dog->setUrlImagen('.../algo');
		$dog->setBreed("Chichimeca");
				
		//$this->em->persist($dog);
		//$this->em->flush();
		
		//$dogs = $this->em->getRepository("BeatBeatPruebaBundle:Dog")->findAll();
		
		//$this->assertEquals(1, count($dogs));
		
	}
	
	public function testJobForm()		
	{
		$cliente = static::createClient();
		
		// Contiene la respuesta del cliente(Navegador)
		//$crawler = $cliente->request('GET', '/animal/new_dog/{id}', array('id' => 4));
		$crawler = $cliente->request('GET', '/animal/new_dog');
		
		//$this->assertEquals('GET', $cliente->getRequest()->getMethod());
		//$this->assertEquals(2, $cliente->getRequest()->get('id'));
		
		$form = $crawler->filter('button:contains("Guardar")')->form(array(
				
				'dog[anima][name]' => 'Juan',
				'dog[anima][weight]' => false,
				'dog[anima][age]' => 'dsadsa',
				'dog[anima][urlImagen]' => '../algo',
				'dog[breed]' => 'll'
				
			));
				
		/*$form = $crawler->selectButton('Guardar')->form(
			array(
				
				'dog[anima][name]' => 'Juan',
				'dog[anima][weight]' => false,
				'dog[anima][age]' => 'dsadsa',
				'dog[anima][urlImagen]' => '../algo',
				'dog[breed]' => 'll'
				
			)
		);*/
				
		/*$form['dog[anima][name]'] = 'Juan';
		$form['dog[anima][weight]'] = 's';
		$form['dog[anima][age]'] = '2';
		$form['dog[anima][urlImagen]'] = '../algo';
		$form['dog[breed]'] = '../algo';*/
		
		//var_dump($form->getPhpValues());
		$crawler = $cliente->submit($form);		
						
		//$this->assertCount(2, $crawler->filter('.error_list'));
				

		//this->assertCount(1, $crawler->filter('button:contains("Guardar")'));
		
		
		
		//$this->assertTrue($crawler->filter('html:contains(a)')->count() == 1);
		//$this->assertCount(2, $crawler->filter('h1'));
		
		// seleccionar el butón
		// $form = $crawler->selectButton('Nuevo Dog')->form();
// 		
// 		
		// $crawler = $cliente->submit($form);
		
		
		
		// Mayor que menos 1
		/*$this->assertGreaterThan(0,
			$crawler->filter('li:contains("Animalon")')->count());*/
		
		//$this->assertTrue($crawler->filter('label:contains("Anima")')->count() == 1);
		//$link = $crawler->filter('html:contains(a)')->eq(1)->link();
		
		//$crawler = $cliente->click($link);
		
		//$this->assertTrue($crawler->filter('a:contains("Nuevo Dog")')->count() == 0);
		
	}

	public function testDogQueryBuilder()
	{
		
		 $repository = $this->em->getRepository('BeatBeatPruebaBundle:Dog');
 		
		 // Esto me regresa un array de objetos... 
		 // 	mediante los indices puedo ya trabajarlo con el objeto....
		 $dog = $repository->createQueryBuilder("d")
		 	->select('d')						
			->getQuery()
			->getResult();
			
			
		/* Cuando seleccionamos un conjunto de atributos de una tabla, nos
			devolvera un array de datos, para acceder a ellos debemos seguir
			la siguiente sintaxis.
		 	
		 
		 * Ejemplo....
		  	
		   $dog = $repository->createQueryBuilder("d")
		 	->select(array('d.name'))						
			->getQuery()
			->getResult();
		 
		 	$dog[0]['name']
		 
		 * 
		 *  
		 * */
		
		$this->assertEquals('Perrito4', $dog[0]->getName());
		
	}
	
}
