<?php
  namespace App\Models;
  use Core\Model;
  use Core\Validators\{RequiredValidator,UniqueValidator};

  class Brands extends Model{
    public $id, $created_at, $updated_at, $name, $deleted = 0;
    protected static $_table = 'brands';
    protected static $_softDelete = true;

    public function beforeSave(){
      $this->timeStamps();
    }

    public function validator(){
      $this->runValidation(new RequiredValidator($this,['field'=>'name','msg'=>'Numele categoriei este necesar.']));
      $this->runValidation(new UniqueValidator($this,['field'=>['name','user_id','deleted'],'msg'=>'Numele categoriei există deja.']));
    }

    public static function findByUserIdAndId($user_id,$id){
      return self::findFirst([
        'conditions' => "user_id = ? AND id = ?",
        'bind' => [$user_id,$id]
      ]);
    }

    public static function getOptionsForForm($user_id){
      $brands = self::find([
        'columns' => 'id,name',
        'conditions' => "user_id = ?",
        'bind' => [$user_id],
        'order' => 'name'
      ]);
      $brandsAry = [''=>'-Alege categoria-'];
      foreach($brands as $brand){
        $brandsAry[$brand->id] = $brand->name;
      }
      return $brandsAry;
    }

    public static function getAllOptionsForForm()
    {
      $brands = self::find([
        'columns' => 'id, name',
        'order' => 'name'
      ]);
      $brandsAry = [''=>'-Alege categoria-'];
      foreach($brands as $brand){
        $brandsAry[$brand->id] = $brand->name;
      }
      return $brandsAry;
    }
  }
