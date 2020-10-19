<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="mycss/style.css" />
    <link rel="stylesheet" href="fonts/css/all.min.css" />

    <title>Modifier Annonce</title>
  </head>
  <body>

    <div class="container" style="background-color:" >
      <!-- Navigation section-->
      <?php
      include 'header.php';
       ?>

     <?php
     $annonce = "";
     if(isset($_GET['id_annonce']) ){
       $id_annonce = $_GET['id_annonce'];
       $annonce = getTable("SELECT * FROM annonces WHERE annonce_id = $id_annonce ");
      }
      if(isset($_POST['submit_modif_annonce']) ){
        creerAnnonce(false);
      }
      ?>

     <div class="row espacement desc_panel" style="" >

       <div class="col-12">
         <h2>Modification de l'annonce</h2>
      <!--   <h2>Modifier Offre</h2> -->
       </div>
       <div class="col-12" style="background-color:">
         <div class="form-register" id="form-register" >
           <form enctype="multipart/form-data" action="#" method="POST" class="register-form" >

           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="annonce_marque" value="<?php echo $annonce[0]['annonce_marque']?>" class="form-control" placeholder="Marque" >
             </div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="annonce_taille" value="<?php echo $annonce[0]['annonce_taille']?>" class="form-control" placeholder="Taille XL/25/12" >
             </div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
                 <input type="text" name="annonce_couleur" value="<?php echo $annonce[0]['annonce_couleur']?>" class="form-control" placeholder="Couleur" >
             </div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="annonce_type" value="<?php echo $annonce[0]['annonce_type']?>" class="form-control" placeholder="Type" >
             </div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="annoce_cible" class="form-control" value="<?php echo $annonce[0]['annonce_cible']?>" placeholder="Cible" >
             </div>
           </div>
           <div class="row">
             <div class="col-10">
               <select class="form-control" name="annonce_etat" >
                 <option value="<?php echo $annonce[0]['annonce_etat']?>" selected="selected"><?php echo $annonce[0]['annonce_etat']?></option>
                 <?php if( $annonce[0]['annonce_etat'] == 'Neuf'){ ?>
                   <option value="Moyen">Moyen</option>
                   <option value="Use">Usé</option>
                 <?php }elseif ( $annonce[0]['annonce_etat']== 'Moyen'){?>
                   <option value="Use">Usé</option>
                   <option value="Neuf">Neuf</option>
                 <?php }elseif ($annonce[0]['annonce_etat']== 'Use'){?>
                 <option value="Neuf">Neuf</option>
                 <option value="Moyen">Moyen</option>
               <?php }?>
               </select>
             </div>
           </div>
           <div class="row">
             <div class="col-10">
               <select class="form-control" name="annonce_service" >
                 <option value="<?php echo $annonce[0]['annonce_service']?>" selected="selected"><?php echo $annonce[0]['annonce_service']?></option>

                 <?php if( $annonce[0]['annonce_service'] == 'Don'){ ?>
                   <option value="Echange">Echange</option>
                   <option value="Vente">Vente</option>
                 <?php }elseif ( $annonce[0]['annonce_service']== 'Echange'){?>
                   <option value="Don">Don</option>
                   <option value="Vente">Vente</option>
                 <?php }elseif ($annonce[0]['annonce_service']== 'Vente'){?>
                   <option value="Don">Don</option>
                   <option value="Echange">Echange</option>
               <?php }?>
               </select>
             </div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="annonce_dispobilite" value="<?php echo $annonce[0]['annonce_disponibilite']?>" class="form-control" placeholder="Disponibilité" >
             </div>
           </div>
           <div class="row" style="background-color:">
             <div class="col-4 offset-5" style="background-color:">
               <input type="file" name="annonce_images[]" multiple="multiple"  id="file1" accept="image/*" capture style="display:none"/>
               <div id="upfile1" style="cursor:pointer"><i class="fas fa-camera" style="font-size:30px;margin-bottom:10px;"></i></div>
             </div>
           </div>
           <input  name="hidden_id" value="<?php echo $annonce[0]['annonce_id']?>" type="hidden" >
           <div class="row">
             <div class="col-3 offset-5" ><button type="Submit" name="submit_modif_annonce" class="btn btn-primary">Enregistrer</button></div>
           </div>
         </form>
        </div>

       </div>

     </div>
<!--fin du panel pour les vet -->


<?php
include 'footer.php';
 ?>
    </div>
    <script type="text/javascript" src="js/libs/popper.js"></script>
    <script type="text/javascript" src="js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="js/libs/bootstrap.min.js"></script>

    <script src="js/libs/jquery.min.js"></script>
    <script src="myjs/myjs.js"></script>
  </body>
</html>
