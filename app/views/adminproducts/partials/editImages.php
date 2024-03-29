<style>
  .edit-image-wrapper{
    background-color: #aeaeae;
    border-radius: 4px;
    box-shadow: 2px 2px 6px rgba(0,0,0,0.25);
  }

  .edit-image-wrapper img{
    height: 75px;
    width: auto;
  }
  .sortable-placeholder{
    background-color: #eee;
  }

  .deleteButton{
    position: absolute;
    top: 2px;
    right: 2px;
    color: crimson;
    cursor: pointer;
  }
  .deleteButton:hover{
    color: #aa0000;
  }
</style>
<div id="sortableImages" class="row align-items-center justify-content-start p-2">
    <?php foreach($this->images as $image):?>
      <div class="col flex-grow-0" id="image_<?=$image->id?>">
        <?php if(count((array)$this->images)>1) : ?>
        <span class="deleteButton" onclick="deleteImage('<?=$image->id?>')"><i class="fas fa-times"></i></span>
      <?php endif ?>
        <div class="edit-image-wrapper" data-id="$image->id">
          <img src="<?=PROOT.$image->url?>" />
        </div>
      </div>
    <?php endforeach;?>
</div>

<script>

  function updateSort(){
    var sortedIDs = $( "#sortableImages" ).sortable( "toArray" );
    $('#images_sorted').val(JSON.stringify(sortedIDs));
  }

  function deleteImage(image_id){
    if(confirm("Sunteți sigur?")){
      jQuery.ajax({
        url : '<?=PROOT?>adminproducts/deleteImage',
        method : "POST",
        data : {image_id : image_id},
        success: function(resp){
          if(resp.success){
            jQuery('#image_'+resp.model_id).remove();
            updateSort();
            location.reload();
          }
        }
      });
      console.log(image_id);
    }
  }

  jQuery('document').ready(function(){
    jQuery( "#sortableImages" ).sortable({
      axis: "x",
      placeholder: "sortable-placeholder",
      update: function( event, ui ) {
        updateSort();
      }
    });
    updateSort();

  });
</script>
