<?php
  namespace App\Controllers;
  use Core\Controller;
  use App\Models\{Products,Brands};
  use Core\{H,DB};

  class HomeController extends Controller {

    public function indexAction() {
      $pModel = new Products();
      $search = $this->request->get('search');
      $min_price = $this->request->get('min_price');
      $max_price = $this->request->get('max_price');
      $brand = $this->request->get('brand');
      if($this->request->isPost()){
        $options = ['search'=>$search,'min_price'=>$min_price,'max_price'=>$max_price,'brand'=>$brand];
        $products = Products::getProductsBySearch($options);
      } else {
        $products = $pModel->featuredProducts();
      }
      $this->view->search = $search;
      $this->view->min_price = $min_price;
      $this->view->max_price = $max_price;
      $this->view->brand = $brand;
      $this->view->brandOptions = Brands::getAllOptionsForForm();
      $this->view->products = $products;
      $this->view->render('home/index');
    }
  }
