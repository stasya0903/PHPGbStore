<?php


namespace App\controllers;


use App\modules\Good;

class BasketController extends Controller
{
    private $product;

    public function showAction()
    {
        $products = $this->getProductsInBasket();
        $summary = $this->getSummary($products);
        //var_dump($products);
        //session_destroy();
        return $this->render('basket', ['products' => $products,
                                                'summary'=>$summary]);
    }


    public function addAction()
    {
        $id = $this->getID();
        $product = (new Good)->getOne($id);
        $productsInCart = $this->getProductsInBasket();

        if (empty($productsInCart[$id])) {
            $this->request->setSession($id, [
                'id' => $product->id,
                'price' => $product->price_product,
                'count' => 1,
                'name' => $product->name_product
            ]);
        } else {
            $this->request->setSession($id, $productsInCart[$id]['count'], "count", $amount = 1);
        }
        header('location: ' . $_SERVER['HTTP_REFERER']);

    }

    public function deleteAction()
    {
        $id = $this->getID();
        $items = $this->getProductsInBasket();
        if ($items[$id]["count"] > 1) {
            $this->request->setSession($id, $items[$id]['count'], "count", $amount = -1);;
        } else {
            $this->request->unsetInSession("goods", $id);

        }
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }


    protected function getID()
    {
        return $this->request->get('id');
    }

    protected function getProductsInBasket()
    {
        return $this->request->session("goods");
    }

    private function getSummary($products)
    {
        $total = 0;

        foreach ($products as $idProduct => $product) {
            $totalGoodPrice = (int)$product['count'] * (int)$product['price'];
            $total += $totalGoodPrice;
        }

        return $total;
    }
}