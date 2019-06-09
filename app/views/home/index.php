<?php use Core\FH;?>
<?php $this->start('body'); ?>
<?php
  $openClass = $this->hasFilters? " open" : "";
  $openIcon = $this->hasFilters ? "fa-chevron-left" : "fa-search";
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
<div class="row">
<div class="col-lg-2 col-md-6 col-md-offset-3 col-lg-offset-0" style="margin-left: 30px ">
    <h1 class="text-center text-secondary w-100"><img src="<?=PROOT?>images/euro.png"><img src="<?=PROOT?>images/click.png">
        <br> Adaugă anunțul tău GRATUIT
    </h1>
      </div>
<div style=" margin-left: auto; margin-right: auto;">
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?=PROOT?>images/1.jpg" class="img-fluid" alt="Responsive image" style="max-width:1100px; max-height:250px;">
            </div>
            <div class="carousel-item">
                <img src="<?=PROOT?>images/2.jpg" class="img-fluid" alt="Responsive image" style="max-width:1100px; max-height:250px;">
            </div>
            <div class="carousel-item">
                <img src="<?=PROOT?>images/3.jpg" class="img-fluid" alt="Responsive image" style="max-width:1100px; max-height:250px;">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
  <div class="col-lg-2 col-md-6 col-md-offset-3 col-lg-offset-0">
    </div>
</div>
    
<div class="d-flex two-column-wrapper open <?=$openClass?>" id="two-column-wrapper">
    <div class="col-lg-2 col-md-6 col-md-offset-3 col-lg-offset-0" style="padding: 30px; margin-left: 30px ">
        <aside>
            <form id="filter-form" action="" method="post" autocomplete="off">
                <div class="form-group">
                    <label class="sr-only" for="search">Caută</label>
                    <div class="input-group">
                        <input class="form-control" id="search" name="search" value="<?=$this->search?>" placeholder="Caută..." />
                        <button class="input-group-append btn btn-info"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="row">
                    <?= FH::hiddenInput('page',$this->page)?>
                    <?= FH::selectBlock('Categorii','brand',$this->brand,$this->brandOptions,['class'=>'form-control form-control-sm'],['class'=>'form-group col-12'])?>
                     <?= FH::inputBlock('text','Județ','region',$this->region,['class'=>'form-control form-control-sm'],['class'=>'form-group col-12']) ?>
                    <?= FH::inputBlock('number','Preț minim','min_price',$this->min_price,['class'=>'form-control form-control-sm','step'=>'any'],['class'=>'form-group col-6'])?>
                    <?= FH::inputBlock('number','Preț maxim','max_price',$this->max_price,['class'=>'form-control form-control-sm','step'=>'any'],['class'=>'form-group col-6'])?>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-info w-100">Caută</button>
                    </div>
                </div>
            </form>
        </aside>
    </div>
    <main class="products-wrapper">
        <?php foreach($this->products as $product):
      $shipping = ($product->shipping == '0.00')? 'Transport gratuit!' : 'Transport: Lei '.$product->shipping;
      $list = ($product->list != '0.00')? 'Lei '.$product->list : '';
     ?>
        <div class="card">
            <img src="<?= PROOT .$product->url?>" class="card-img-top" alt="<?=$product->name?>">
            <div class="card-body">
                <h5 class="card-title"><a href="<?=PROOT?>products/details/<?=$product->id?>"><?=$product->name?></a></h5>
                <p class="products-brand">Categoria: <?=$product->brand?></p>
                <p class="products-brand">Județ: <?=$product->region?></p>
                <p class="card-text">Lei <?=$product->price?> <span class="list-price"><?=$list?></span></p>
                <p class="card-text"><?= $shipping?></p>
                <a href="<?=PROOT?>products/details/<?=$product->id?>" class="btn btn-primary">
                    Vezi detalii</a>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="d-flex justify-content-center align-items-center mt-3 w-100">
            <?php
        $disableBack = ($this->page == 1)? ' disabled="disabled"' : '';
        $disableNext = ($this->page == $this->totalPages)? ' disabled="disabled"' : '';
        ?>
            <button class="btn btn-light mr-3" <?=$disableBack?> onclick="pager('back')"><i class="fas fa-chevron-left"></i></button>
            <?=$this->page?> of <?=$this->totalPages?>
            <button class="btn btn-light ml-3" <?=$disableNext?> onclick="pager('next')"><i class="fas fa-chevron-right"></i></button>
        </div>
    </main>
    
     <div class="col-lg-2 col-md-6 col-md-offset-3 col-lg-offset-0">
         <div style="margin-top: 30px; margin-left: auto; margin-right: auto;">
    <div id="demo2" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo2" data-slide-to="0" class="active"></li>
            <li data-target="#demo2" data-slide-to="1"></li>
            <li data-target="#demo2" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?=PROOT?>images/4.jpg" class="img-fluid" alt="Responsive image" style="max-width:273px; max-height:458px;">
            </div>
            <div class="carousel-item">
                <img src="<?=PROOT?>images/5.jpg" class="img-fluid" alt="Responsive image" style="max-width:273px; max-height:458px;">
            </div>
            <div class="carousel-item">
                <img src="<?=PROOT?>images/6.jpg" class="img-fluid" alt="Responsive image" style="max-width:273px; max-height:458px;">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo2" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo2" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
    </div>
    
</div>

<script>
    function toggleExpandFilters() {
        var wrapper = document.getElementById('two-column-wrapper');
        var toggleIcon = document.getElementById('toggleIcon');
        wrapper.classList.toggle('open');
        if (wrapper.classList.contains('open')) {
            toggleIcon.classList.remove('fa-search');
            toggleIcon.classList.add('fa-chevron-left');
        } else {
            toggleIcon.classList.remove('fa-chevron-left');
            toggleIcon.classList.add('fa-search');
        }
    }

    function pager(direction) {
        var form = document.getElementById('filter-form');
        var input = document.getElementById('page');
        var page = parseInt(input.value, 10);
        var newPageValue = (direction === 'next') ? page + 1 : page - 1;
        input.value = newPageValue;
        form.submit();
    }

    document.getElementById('filter-form').addEventListener('submit', function(evt) {
        var form = evt.target;
        evt.preventDefault();
        document.getElementById('page').value = 1;
        form.submit();
    });

    document.getElementById('expand-filters').addEventListener('click', toggleExpandFilters);

</script>

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
<?php $this->end(); ?>
