<?php
    class Store
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
          $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}')");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_store = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_store as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                  $found_store = $store;
                }
            }
            return $found_store;
        }

        function getBrands()
        {
            $brands = Array();
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM brands JOIN brands_stores ON (brands.id = brands_stores.brand_id) JOIN stores ON (stores.id = brands_stores.store_id) WHERE stores.id = {$this->getId()};");
            foreach($returned_brands as $brand) {
                $id = $brand['id'];
                $name = $brand['name'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
        }

        function addBrand($brand_id)
        {
            $store_id = $this->getid();
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand_id}, {$store_id});");
        }

        function getNonBrands()
        {
            $allBrands = Brand::getAll();
            $storeBrands = $this->getBrands();
            $nonBrands = array();
            foreach($allBrands as $brand) {
                if(!in_array($brand, $storeBrands))
                {
                    $name = $brand->getName();
                    $id = $brand->getId();
                    $new_brand = new Brand($name, $id);
                    array_push($nonBrands, $new_brand);
                }
            }
            return $nonBrands;
        }

    }
?>
