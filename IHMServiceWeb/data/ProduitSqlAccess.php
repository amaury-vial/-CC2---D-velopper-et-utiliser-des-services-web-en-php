<?php

namespace data;

use service\AnnonceAccessInterface;
include_once "service/ProductsAccessInterface.php";

use service\ProductsAccessInterface;
use domain\{User,Produit};
include_once "domain/User.php";
include_once "domain/Produit.php";

class ProduitSqlAccess implements ProductsAccessInterface
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function __destruct()
    {
        $this->dataAccess = null;
    }

    public function createUser($login, $password, $name, $firstName): bool
    {
        $query = 'INSERT INTO Users(login, password, name, firstName) VALUES("' . $login . '","'
            . $password . '","'
            . $name . '","'
            . $firstName . '")';

        try {
            $this->dataAccess->query($query);
        }
        catch ( \PDOException $e){
            return false;
        }
        return true;
    }

    public function getUser($login, $password): ?User
    {
        $user = null;

        $query = 'SELECT * FROM Users WHERE login="' . $login . '" and password="' . $password . '"';
        $result = $this->dataAccess->query($query);

        if ( $row = $result->fetch() )
            $user = new User( $row['login'] , $row['password'], $row['name'], $row['firstName'], $row['date'] );

        $result->closeCursor();

        return $user;
    }

    public function getAllProducts(): array
    {
        $result = $this->dataAccess->query('SELECT * FROM Products');
        $Products = array();

        while ($row = $result->fetch()) {
            $currentProducts = new Products($row['id'], $row['nom'], $row['prix'], $row['quantite'],$row['kilo']);
            $Products[] = $currentProducts;
        }

        $result->closeCursor();

        return $Products;
    }
}

?>