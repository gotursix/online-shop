<?php
namespace App\Controllers;
use Core\Router;
use Core\{Controller, H};
use App\Models\{Transactions, Users , Products};

class AdmindashboardController extends Controller {
  public function __construct($controller,$action){
    parent::__construct($controller,$action);
    $this->view->setLayout('admin');
  }

  public function indexAction()
  {
    $this->view->users = Users::findUnallowed();
    $this->view->products = Products::findAll();
    $this->view->render('admindashboard/index');
  }

  public function getDailySalesAction(){
    $range = $this->request->get('range');
    $transactions = Transactions::getDailySales($range);
    $labels = [];
    $data = [];
    foreach($transactions as $tx){
      $labels[] = $tx->created_at;
      $data[] = $tx->amount;
    }
    $resp = ['data'=>$data, 'labels'=> $labels];
    $this->jsonResponse($resp);
  }

  public function changerankAction($id)
  {
      $user = Users::findById($id);
      if($user->acl == '["User"]')
      {
        $user->acl= NULL;
        $user->save();
      }
      else
      {
        $user->acl='["User"]';
        $user->save();
      }
      Router::redirect('admindashboard');
  }

  public function allowAction($id)
  {
      $products = Products::findById($id);
      $products->deleted= 0;
      $products->save();
      Router::redirect('admindashboard');
  }
}
