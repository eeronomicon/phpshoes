<?php
    class Brand
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}')");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brand = $GLOBALS['DB']->query("SELECT * FROM brands ORDER BY name;");
            $brands = array();
            foreach($returned_brand as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        }

        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                  $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        function getStores()
        {
            $stores = Array();
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM stores JOIN brands_stores ON (stores.id = brands_stores.store_id) JOIN brands ON (brands.id = brands_stores.brand_id) WHERE brands.id = {$this->getId()} ORDER BY stores.name;");
            foreach($returned_stores as $store) {
                $id = $store['id'];
                $name = $store['name'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_brands WHERE brand_id = {$this->getId()};");
        }

        function addStore($store_id)
        {
            $brand_id = $this->getid();
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand_id}, {$store_id});");
        }

        function getNonStores()
        {
            $allStores = Store::getAll();
            $thisStores = $this->getStores();
            $nonStores = array();
            foreach($allStores as $brand) {
                if(!in_array($brand, $thisStores))
                {
                    $name = $brand->getName();
                    $id = $brand->getId();
                    $new_brand = new Store($name, $id);
                    array_push($nonStores, $new_brand);
                }
            }
            return $nonStores;
        }

    }
?>
