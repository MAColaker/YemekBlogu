<?php 
include 'header.php';
include '../netting/baglan.php';

$menusor=$db->prepare("SELECT * from menu where menu_id=:menu_id");
$menusor->execute(array(
  'menu_id' => $_GET['menu_id']
  ));
$menucek=$menusor->fetch(PDO::FETCH_ASSOC);

?>
<head>  
  <script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>

  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">

</head>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Menü İşlemleri</h3>
      </div>

    <!--  <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Anahtar Kelimeniz...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Ara!</button>
            </span>
          </div>
        </div>
      </div>-->
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Menü İşlemleri <small>
                <?php 
                if (isset($_GET['durum'])=='ok') {?>
                
                <b style="color:green;">Güncelleme başarılı...</b>

                <?php } elseif (isset($_GET['durum'])=='no')  {?>

                <b style="color:red;">Güncelleme yapılamadı...</b>

                <?php } ?></small> </h2>
                <ul class="nav navbar-right panel_toolbox">




                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">

                <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                <input type="hidden" name="menu_id" value="<?php echo $_GET['menu_id']; ?>">


                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Üst Menü Seç</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">

                     <select class="select2_single form-control" required="" name="menu_ust" tabindex="-1">
                       <?php

                       if ($menucek['menu_ust']=="0") {?>

                       <option value="0" selected="selected">Üst Menü</option>


                       <?php } else {


                         $menu_id=$menucek['menu_ust'];
                         $secmenusor=$db->prepare("SELECT * from menu where menu_id=:menu_id");
                         $secmenusor->execute(array(
                          'menu_id' => $menu_id
                          ));
                         $secmenucek=$secmenusor->fetch(PDO::FETCH_ASSOC);
                         ?>

                         <option value="<?php echo $secmenucek['menu_id']; ?>" selected="selected";><?php echo $secmenucek['menu_ad']; ?></option>

                          <option value="0" >Üst Menü Yap</option>


                         <?php }

                         ?>



                         <?php 
                         $ustmenusor=$db->prepare("select * from menu where menu_ust=:menu_ust order by menu_sira");
                         $ustmenusor->execute(array(
                          'menu_ust' => 0
                          ));

                         while($ustmenucek=$ustmenusor->fetch(PDO::FETCH_ASSOC)) {
                          ?>

                          <option value="<?php echo $ustmenucek['menu_id']; ?>"><?php echo $ustmenucek['menu_ad']; ?></option>


                          <?php } ?>

                        </select>
                      </div>
                    </div>

                    <!-- selected="selected" -->



                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Menü Ad<span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" id="first-name" required="required" name="menu_ad" value="<?php echo $menucek['menu_ad']; ?>" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Menü  Url<span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" id="first-name"  name="menu_url" value="<?php echo $menucek['menu_url']; ?>" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Menü Detay <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">

                        <textarea  class="ckeditor" id="editor1" name="menu_detay"><?php echo $menucek['menu_detay']; ?></textarea>

                      </div>
                    </div>

                    <script type="text/javascript">


                     CKEDITOR.replace( 'editor1',
                     {
                      filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
                      filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
                      filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
                      filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                      filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                      filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                      forcePasteAsPlainText: true
                    } 
                    );
                  </script>

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Menü Sıra<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="menu_sira" value="<?php echo $menucek['menu_sira']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>




                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Menü Durum<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                     <select id="heard" class="form-control" name="menu_durum" required>
                      <option value="1">Aktif</option>
                      <option value="0">Pasif</option>

                    </select>
                  </div>
                </div>

                <div align="right" class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                  <button type="submit" name="menuduzenle" class="btn btn-primary">Kaydet</button>
                </div>

              </form>



            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<script src="../vendors/select2/dist/js/select2.full.min.js"></script>

<!-- Select2 -->
<script>
  $(document).ready(function() {
    $(".select2_single").select2({
      placeholder: "Select a state",
      allowClear: true
    });
    $(".select2_group").select2({});
    $(".select2_multiple").select2({
      maximumSelectionLength: 4,
      placeholder: "With Max Selection limit 4",
      allowClear: true
    });
  });
</script>
<!-- /Select2 -->

<?php include 'footer.php'; ?>
