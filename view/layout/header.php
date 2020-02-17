<!-- <div class="col-md-12 header">
  <div class="pull-left" >
    <h4 class="pageHeader">  </h4>
  </div>

  <div class="pull-right">
      <button style="display: none;" class="btn btn-xs btn-primary modalLink"
              modalUrl=""
              data-modal-size=""
              title="Modal Title"
              href=""
              action =""
              >Add New
      </button>
  </div>




</div> -->
<?php 
if(empty($_SESSION))
{
    require_once '../controllers/Authentication.php';
    $msg = Authentication::logOut();
}
?>



<div class="col-md-12">
  <div class="pull-left" >
    <h4 class="pageHeader"> <?php if(isset($heading)) echo $heading['pageTitle']?> </h4>
  </div>


  <?php if(isset($heading['button_name']))  {?>

  <div class="pull-right">
      <button class="btn btn-xs btn-primary modalLink"
              modalUrl="<?php if(isset($heading)) echo $heading['modal']?>"
              data-modal-size="<?php if(isset($heading)) echo $heading['modal_size']?>"
              title="<?php if(isset($heading)) echo 'Add New '. $heading['title']?>"
              href=""
              action =""
              ><?php if(isset($heading)) echo $heading['button_name']?>
      </button>
  </div>

<?php }?>
</div>

<div class="col-md-12 tableTools-container pull-right"></div>



