<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $name = "Footsies";
            $id = null;
            $test_store = new Store($name, $id);

            // Act
            $result = $test_store->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            // Arrange
            $name = "Footsies";
            $id = 10;
            $test_store = new Store($name, $id);

            // Act
            $result = $test_store->getId();

            // Assert
            $this->assertEquals($id, $result);
        }

        function test_setName()
        {
            // Arrange
            $name = "Footsies";
            $id = null;
            $test_store = new Store($name, $id);
            $test_store->save();
                $new_name = "Footers";

            // Act
            $test_store->setName($new_name);
            $result = $test_store->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            $name = "Sole Man";
            $test_store2 = new Store($name, $id);
            $test_store2->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$test_store1, $test_store2], $result);

        }

        function test_save()
        {
            // Arrange
            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$test_store1], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            $name = "Sole Man";
            $test_store2 = new Store($name, $id);
            $test_store2->save();

            // Act
            Store::deleteAll();

            // Assert
            $this->assertEquals([], Store::getAll());
        }

        function test_find()
        {
            // Arrange
            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            $name = "Sole Man";
            $test_store2 = new Store($name, $id);
            $test_store2->save();

            // Act
            $result = Store::find($test_store1->getId());

            // Assert
            $this->assertEquals($test_store1, $result);
        }

        function test_update()
        {
            // Arrange
            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            $new_name = "Footers";

            // Act
            $test_store1->update($new_name);
            $result = Store::find($test_store1->getId())->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_delete()
        {
            // Arrange
            $name = "Footsies";
            $id = null;
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            $name = "Sole Man";
            $test_store2 = new Store($name, $id);
            $test_store2->save();

            $name = "Boots and Snoots";
            $test_store3 = new Store($name, $id);
            $test_store3->save();

            // Act
            $test_store1->delete();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$test_store3, $test_store2], $result);
        }

        function test_addBrand()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name = "Footsies";
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            // Act
            $test_store1->addBrand($test_brand1->getId());
            $result = $test_store1->getBrands();

            // Assert
            $this->assertEquals([$test_brand1], $result);
        }

        function test_getNonBrands()
        {
            // Arrange
            $name = "Jhonn Flubog";
            $id = null;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name2 = "Doc Merkins";
            $test_brand2 = new Brand($name2, $id);
            $test_brand2->save();

            $name = "Sole Man";
            $test_store1 = new Store($name, $id);
            $test_store1->save();

            // Act
            $test_store1->addBrand($test_brand1->getId());
            $result = $test_store1->getNonBrands();

            // Assert
            $this->assertEquals([$test_brand2], $result);
        }

    }
?>
