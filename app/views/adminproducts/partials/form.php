<?php
use Core\FH;
?>

<style>
* {
  box-sizing: border-box;
}

/*the container must be positioned relative:*/


.autocomplete-items {
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  font: 16px Arial;  
  /*position the autocomplete items to be the same width as the container:*/
  left : -2;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

<form action="<?=$this->formAction?>" method="POST" enctype="multipart/form-data">
  <?= FH::csrfInput();?>
  <?= FH::displayErrors($this->displayErrors)?>
  <div class="row">
    <?= FH::inputBlock('text','Nume anunț','name',$this->product->name,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Preț','price',$this->product->price,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Preț vechi','list',$this->product->list,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Transport','shipping',$this->product->shipping,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Nume','username',$this->product->username,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Email','email',$this->product->email,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-3'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Numarul de telefon','phone',$this->product->phone,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Județ','region',$this->product->region,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-3'],$this->displayErrors) ?>
    <?= FH::inputBlock('text','Oras','city',$this->product->city,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-2'],$this->displayErrors) ?>
    <?= FH::selectBlock('Categorie','brand_id',$this->product->brand_id,$this->brands,['class'=>'form-control input-sm','onclick'=>'sync()'],['class'=>'form-group col-md-3'],$this->displayErrors) ?>
  </div>
 
  <div class="row">
    <?= FH::textareaBlock('Descriere - date de contact, adresă, stare etc.','body',$this->product->body,['class'=>'form-control','rows'=>'6'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
    <?= FH::checkboxBlock('Recomandat','featured',$this->product->isChecked(),['class'=>'form-controll'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
  </div>
  <div class="row">
    <?= FH::inputBlock('file',"Încarcă imaginea produsului:",'productImages[]','',['class'=>'form-control','multiple'=>'multiple'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
  </div>
  <div class="row">
    <?= FH::submitBlock('Salvează',['class'=>'btn btn-large btn-primary'],['class'=>'text-right col-md-12']); ?>
  </div>
</form>

<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = ["Alba","Arad","Argeș","Bacău","Bihor","Bistrița","Năsăud","Botoșani","Brăila","Brașov","București","Buzău","Călărași","Caraș","Severin","Cluj","Constanța","Covasna","Dâmbovița","Dolj","Galați","Giurgiu","Gorj","Harghita","Hunedoara","Ialomița","Iași","Ilfov","Maramureș","Mehedinți","Mureș","Neamț","Olt","Prahova","Sălaj","Satu Mare","Sibiu","Suceava","Teleorman","Timiș","Tulcea","Vâlcea","Vaslui","Vrancea"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("region"), countries);
</script>