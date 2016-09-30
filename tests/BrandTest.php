<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand = new Brand($name, $id);

            // Act
            $result = $test_brand->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = 20;
            $test_brand = new Brand($name, $id);

            // Act
            $result = $test_brand->getId();

            // Assert
            $this->assertEquals($id, $result);
        }

        function test_setName()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand = new Brand($name, $id);
            $test_brand->save();
            $new_name = "Jhonny B Flubog";

            // Act
            $test_brand->setName($new_name);
            $result = $test_brand->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name = "Doc Merkins";
            $test_brand2 = new Brand($name, $id);
            $test_brand2->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$test_brand1, $test_brand2], $result);

        }

        function test_save()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$test_brand1], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name = "Doc Merkins";
            $test_brand2 = new Brand($name, $id);
            $test_brand2->save();

            // Act
            Brand::deleteAll();

            // Assert
            $this->assertEquals([], Brand::getAll());
        }

        function test_find()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name = "Doc Merkins";
            $test_brand2 = new Brand($name, $id);
            $test_brand2->save();

            // Act
            $result = Brand::find($test_brand1->getId());

            // Assert
            $this->assertEquals($test_brand1, $result);
        }

        function test_update()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $new_name = "Jhonny B Flubog";

            // Act
            $test_brand1->update($new_name);
            $result = Brand::find($test_brand1->getId())->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_delete()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name = "Doc Merkins";
            $test_brand2 = new Brand($name, $id);
            $test_brand2->save();

            $name = "Fried Boots";
            $test_brand3 = new Brand($name, $id);
            $test_brand3->save();

            // Act
            $test_brand1->delete();
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$test_brand2, $test_brand3], $result);
        }

        function test_addStore()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            // Act
            $test_brand1->addStore($test_store1->getId());
            $result = $test_store1->getBrands();

            // Assert
            $this->assertEquals([$test_brand1], $result);
        }

        function test_addMultiStores()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name2 = "Doc Merkins";
            $test_brand2 = new Brand($name2, $id);
            $test_brand2->save();

            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            // Act
            $test_brand1->addStore($test_store1->getId());
            $test_brand2->addStore($test_store1->getId());
            $result = $test_store1->getBrands();

            // Assert
            $this->assertEquals([$test_brand1, $test_brand2], $result);
        }

        function test_getStores()
        {
            // Arrange
            $name = "Doc Merkins";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            $name2 = "Sole Man";
            $test_store2 = new Store($name2, $id);
            $test_store2->save();

            // Act
            $test_brand1->addStore($test_store1->getId());
            $test_brand1->addStore($test_store2->getId());
            $result = $test_brand1->getStores();

            // Assert
            $this->assertEquals([$test_store1, $test_store2], $result);
        }
    }
?>
