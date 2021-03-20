<?php
    include_once "dbcontroller.php";
    class Product{
        public $db;
        public function __construct(){
            $this->db = Database::getConnection();
        }

        public function getAllProducts(){
            $stmt = $this->db->prepare("SELECT id, name, description, price, image from products");
            $stmt->execute();
            $result = $stmt->get_result();        
            return $result;
        }

        public function addToCart($user_id, $product_id, $q){
            $sql = "INSERT INTO cart(product_id, user_id, quantity) VALUES (?,?,?);";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iii", $product_id, $user_id, $q);
            $stmt->execute();
            $stmt->close();
        }

        public function getAllUserProducts($user_id){
            $query = "SELECT cart.id, name, price, quantity from users JOIN cart ON
                     users.id = cart.user_id JOIN products ON cart.product_id = products.id WHERE users.id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }
        
        public function deleteFromCart($delete_id){
            $query = "DELETE FROM cart WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();
        }

        public function deleteProduct($delete_id){
            $query = "DELETE FROM products WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();
        }
        
        public function searchProduct($id){
            $sql = "SELECT * FROM products WHERE id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        }

        public function saveUpdatedProduct($id, $name, $description, $price){
            $sql = "UPDATE products SET name=?, description=?, price=?
                    WHERE id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ssii', $name, $description, $price, $id);
            $stmt->execute();
            $stmt->close();
        }

        public function addNewProduct($name, $description, $price, $image, $category_id){
            $sql = "INSERT INTO products(name, description, price, image, category_id) VALUES (?,?,?,?,?);";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ssisi', $name, $description, $price, $image, $category_id);
            $stmt->execute();
            $stmt->close();
        }

        public function finaliseCommand($id){
            $stmt = $this->db->prepare("SELECT product_id, user_id, quantity FROM cart WHERE user_id=?");
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $result = $stmt->get_result();

            $delete = $this->db->prepare("DELETE FROM cart WHERE user_id = ?");
            $delete->bind_param('i',$id);
            $delete->execute();

            while($q = $result->fetch_assoc()){
                $sql = $this->db->prepare("INSERT INTO orders(product_id, user_id, quantity) VALUES (?,?,?)");
                $sql->bind_param('iii', $q['product_id'], $q['user_id'], $q['quantity']);
                $sql->execute();
            }
        }

        public function dropCommand($id){
            $delete = $this->db->prepare("DELETE FROM cart WHERE user_id = ?");
            $delete->bind_param('i',$id);
            $delete->execute();
            $delete->close();
        }

        public function orders(){
            $stmt = $this->db->prepare("SELECT firstName, lastName, name, quantity, price FROM users JOIN orders ON users.id = orders.user_id
             JOIN products ON orders.product_id = products.id");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        public function categories(){
            $stmt = $this->db->prepare("SELECT * FROM categories");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        public function getAllProductsByCategory($id){
            $stmt = $this->db->prepare("SELECT id, name, description, price, image from products WHERE category_id = ?");
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }
    }
?>