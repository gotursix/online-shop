<?php
  namespace App\Models;
  use Core\{Model, DB, H};
  use Core\Validators\{RequiredValidator,NumericValidator};
  use App\Models\{Brands,ProductImages};

  class Products extends Model {

    public $id, $created_at, $updated_at, $user_id, $name, $price, $list, $shipping, $body, $username ,$brand_id, $email , $phone , $region , $city , $featured = 0, $deleted=0;
    const blackList = ['id','deleted','featured'];
    protected static $_table = 'products';
    protected static $_softDelete = false;

    public function beforeSave(){
      $this->timeStamps();
    }

    public function validator(){
      $requiredFields = ['name'=>"Name",'price'=>'Price','list'=>'List Price','shipping'=>'Shipping','body'=>'Body','email'=>'Email','phone'=>
      'Phone','region'=>'Judet','city'=>'Oras' , 'username'=>'Numele'];
      foreach($requiredFields as $field => $display){
        $this->runValidation(new RequiredValidator($this,['field'=>$field,'msg'=>$display." is required."]));
      }
      $this->runValidation(new NumericValidator($this,['field'=>'price','msg'=>'Prețul trebuie să fie un număr.']));
      $this->runValidation(new NumericValidator($this,['field'=>'list','msg'=>'Lista prețurilor trebuie să fie un număr.']));
      $this->runValidation(new NumericValidator($this,['field'=>'shipping','msg'=>'Numărul de bucăți trebuie să fie un număr.']));
    }

    public static function findByUserId($user_id,$params=[])
    {
      $conditions = [
        'conditions' => "user_id = ?  ",
        'bind' => [(int)$user_id],
        'order' => 'name'
      ];
      $params = array_merge($conditions, $params);
      return self::find($params);
    }

    public static function findByIdAndUserId($id, $user_id){
      $conditions = [
        'conditions' => "id = ? AND user_id = ?",
        'bind' => [(int)$id, (int)$user_id]
      ];
      return self::findFirst($conditions);
    }

       public static function findByIdAproved($id)
       {
         $conditions = [
         'conditions' => "id = ? AND deleted != 1 ",
          'bind' => [(int)$id]
      ];
      return self::findFirst($conditions);
    }

    public static function findAll()
       {
         $conditions = [
         'conditions' => ""
      ];
      return self::find($conditions);
    }


    public function isChecked(){
      return $this->featured === 1;
    }

    public static function featuredProducts($options){
      //H::dnd($options['region']);
      $db = DB::getInstance();
      $limit = (array_key_exists('limit',$options) && !empty($options['limit']))? $options['limit'] : 4;
      $offset = (array_key_exists('offset',$options) && !empty($options['offset']))? $options['offset'] : 0;
      $where = "products.deleted = 0 AND pi.sort = '0'";
      $hasFilters = self::hasFilters($options);
      $binds = [];

      if(array_key_exists('brand',$options) && !empty($options['brand'])){
        $where .= " AND brands.id = ?";
        $binds[] = $options['brand'];
      }

      if(array_key_exists('min_price',$options) && !empty($options['min_price'])){
        $where .= " AND products.price >= ?";
        $binds[] = $options['min_price'];
      }

      if(array_key_exists('max_price',$options) && !empty($options['max_price'])){
        $where .= " AND products.price <= ?";
        $binds[] = $options['max_price'];
      }

      if(array_key_exists('region', $options) && !empty($options['region'])){
        $where .= " AND (products.region = ? OR products.region LIKE ?)"; 
        $binds[] = $options['region'];
        $binds[] = "%" . $options['region'];

      }

      if(array_key_exists('search',$options) && !empty($options['search'])){
        $where .= " AND (products.name LIKE ?)";
        $binds[] = "%" . $options['search'] . "%";
      }

      $sql = "SELECT products.*, pi.url as url, brands.name as brand FROM products
              JOIN product_images as pi
              ON products.id = pi.product_id
              JOIN brands
              ON products.brand_id = brands.id
              WHERE {$where}
            ";

    // H::dnd($sql);

      $group = ($hasFilters)? " GROUP BY products.id ORDER BY products.name" : "GROUP BY products.id ORDER BY products.featured DESC";
      $pager = " Limit ? OFFSET ?";
      $binds[] = $limit;
      $binds[] = $offset;

      $total = $db->query($sql.$group,$binds)->count();
      $results = $db->query($sql.$group.$pager,$binds)->results();

      return ['results'=>$results,'total'=>$total];
    }

    public static function hasFilters($options){
      foreach($options as $key => $value){
        if(!empty($value) && $key != 'limit' && $key != 'offset') return true;
      }
      return false;
    }

    public function getBrandName(){
      if(empty($this->brand_id)) return '';
      $brand = Brands::findFirst([
        'conditions' => "id = ?",
        'bind' => [$this->brand_id]
      ]);
      return ($brand)? $brand->name : '';
    }

    public function displayShipping(){
      return ($this->shipping == 0)? "Transport gratuit" : "Lei " . $this->shipping;
    }

    public function getImages(){
      return ProductImages::find([
        'conditions' => "product_id = ?",
        'bind' => [$this->id],
        'order' => 'sort'
      ]);
    }
  }
