<?php
  namespace App\Controllers;
  use Core\Controller;
  use Core\Router;
  use Core\Session;
  use App\Models\Products;
  use Core\H;

  class ProductsController extends Controller {

    public function detailsAction($product_id) {
      $product = Products::findByIdAproved((int)$product_id);
      if(!$product){
        Session::addMsg('danger',"Acest produs nu este disponibil");
        Router::redirect('/home');
      }
      $this->view->product = $product;
      $this->view->images = $product->getImages();
      $this->view->render('products/details');
    }
  }
