<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="mycss/style.css" />
    <link rel="stylesheet" href="fonts/css/all.min.css" />

    <title>Page de Modif</title>
  </head>
  <body>

    <div class="container" style="background-color:" >

      <!-- Navigation section-->
      <?php
      include 'header.php';
      //include 'RequetesSQL.php';
      $id = $_SESSION['id_user'];
      $user = getTable("SELECT * FROM users WHERE user_id = '$id' ");
      if (isset($_POST['user_Submit_modifier'])){
        modifierProfilUser();
      }
       ?>



     <div class="row espacement desc_panel" style="" >
       <div class="col-12">
         <h2>Modifier</h2>
       </div>
       <div class="col-12" style="background-color:">
         <div    class="form-register" id="form-register" >

           <form enctype="multipart/form-data"  class="register-form" action="Page_d_Modif_Profil.php" method="POST" >
           <div class="row">
             <div class="col-10">
               <input type="text" name="user_Nom" class="form-control" value="<?php echo $user[0]['user_nom']?>" placeholder="Nom" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-user-circle"></i></div>
           </div>
           <div class="row">
             <div class="col-10" >
               <input type="text" name="user_Prenom" value="<?php echo $user[0]['user_prenom']?>" class="form-control" placeholder="Prenom" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-user-circle"></i></div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="user_Pseudonyme"  value="<?php echo $user[0]['user_pseudonyme']?>" class="form-control" placeholder="Pseudonyme" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-user-circle"></i></div>
           </div>
           <div class="row">
             <div class="col-10">
               <select class="form-control" name="user_Gendre" id="gendre">
                 <option value="<?php echo $user[0]['user_genre']?>" selected="selected">Gendre<?php echo $user[0]['user_genre']?> </option>
                 <?php if($user[0]['user_genre'] == "Homme") {?>
                 <option value="Femme">Femme</option>
                 <option value="Indetermine">Indéterminé</option>
               <?php }elseif ($user[0]['user_genre'] == "Femme"){ ?>
                 <option value="Homme">Homme</option>
                 <option value="Indetermine">Indéterminé</option>
               <?php }elseif  ($user[0]['user_genre'] == "Indetermine"){?>
                 <option value="Femme">Femme</option>
                 <option value="Homme">Homme</option>
               <?php } ?>
               </select>
             </div>
             <div class="col-2 ajust"><i class="fas fa-transgender-alt"></i></div>
           </div>
           <div class="row">
             <div class="col-10">
               <input type="text" name="user_Metier"  value="<?php echo $user[0]['user_metier']?>" class="form-control" placeholder="Métier">
             </div>
             <div class="col-2 ajust"><i class="fas fa-briefcase"></i></div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="user_Mot_de_passe" class="form-control" placeholder="Mot_de_passe" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-unlock-alt"></i></div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="user_Adresse"  value="<?php echo $user[0]['user_adresse']?>" class="form-control" placeholder="Adresse" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-map-marker-alt"></i></div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="user_Email"  value="<?php echo $user[0]['user_email']?>" class="form-control" placeholder="Email" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-at"></i></div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="user_Ville"  value="<?php echo $user[0]['user_ville']?>" class="form-control" placeholder="Ville" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-home"></i></div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="user_Region"  value="<?php echo $user[0]['user_region']?>" class="form-control" placeholder="Région" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-street-view"></i></div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="user_Date_de_naissance"  value="<?php echo $user[0]['user_date_naissance']?>" class="form-control" placeholder="Date de naissance" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-calendar-alt"></i></div>
           </div>
           <div class="row">
             <div class="col-10" style="background-color:">
               <input type="text" name="user_Numero_portable"  value="<?php echo $user[0]['user_telephone']?>" class="form-control" placeholder="Numero portable" >
             </div>
             <div class="col-2 ajust" style=""><i class="fas fa-phone-alt"></i></div>
           </div>
           <div class="row">
             <div class="col-10">
               <textarea  rows="3" name="user_Message" class="form-control" cols="55" placeholder="  Message profil..." id="message_textarea">
                 <?php echo $user[0]['user_message_profil']?>
               </textarea>
             </div>
             <div class="col-2 ajust"><i class="fas fa-comments"></i></div>
           </div>

           <div class="row" style="background-color:">
             <div class="col-3 offset-5" style="background-color:">
               <input type="file" name="user_Image"  id="file1" accept="image/*" capture style="display:none"/>
               <div id="upfile1" style="cursor:pointer"><i class="fas fa-camera" style="font-size:30px;margin-bottom:10px;"></i></div>
             </div>
           </div>
           <div class="row">
             <div class="col-3 offset-5" ><button type="Submit" id="submit_enregister" name="user_Submit_modifier" class="btn btn-primary">Enregistrer</button></div>
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
