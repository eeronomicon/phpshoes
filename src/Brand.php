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
            $returned_brand = $GLOBALS['DB']->query("SELECT * FROM brands;");
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
            $GLOBALS['DB']->exec("DELETE FROM brands_brands;");
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
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores JOIN stores_stores ON (stores.id = brands_stores.store_id) JOIN brands ON (brands.id = brands_stores.brand_id) WHERE brands.id = {$this->getId()};");
            foreach($returned_stores as $store) {
                $id = $store['id'];
                $name = $store['name'];
                $store_id = $store['store_id'];
                $new_store = new Store($name, $store_id, $id);
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

    }
?>
