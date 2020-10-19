<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="mycss/style.css" />
    <link rel="stylesheet" href="fonts/css/all.min.css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/2.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <title>Page de Profil</title>
  </head>
  <body>

  <div class="container" style="background-color:" >


  <!-- Navigation section-->
  <?php
  include 'header.php';
  //include 'RequetesSQL.php';
  userGlobal();

  $superUser_request_page = false ;
  $superUserTable = array();

  if(isset($_GET['supprime_annonce'])){
    $id_annonce = $_GET['supprime_annonce'];
    getTable("DELETE FROM annonces WHERE annonce_id = $id_annonce");
  }

  if(isset($_GET['id_user']) && $_GET['id_user'] != $_SESSION['id_user'] ){
  $superUserTable = $_GET['id_user'];
  $superUser_request_page = false;
  $superUserTable = getUSerById($_GET['id_user'],"","");
  }else{
    $superUser_request_page = true ;
    $superUserTable = getUSerById($_SESSION['id_user'],"","");
  }

  $annonces = [];
  if(isset($_GET['catalogue']) && isset($_GET['gendre'])  ){
    $annonces = recherche($_GET['gendre'],$_GET['catalogue'],$superUserTable['user_id']);
    shuffle($annonces);

  }else{
  $annonces = getAnnoncesById($superUserTable['user_id']);
  shuffle($annonces);
  }

   ?>


<?php
//if(isset($_GET['id_user'])){
  //var_dump($_SESSION['user_connecte']["user_pseudonyme"]);
/*
  $user = userGlobal();
  //var_dump($user);
  if(isset($user) && !empty($user)){
    $_SESSION['user_connecte'] = $user;
    var_dump($_SESSION['user_connecte']["user_pseudonyme"]);
    die();
  }
*/
?>




     <!-- Informations personnelles -->
      <div class="container" >

      <div class="row">
        <div class="col-3" style="background-color:">
          <div class="row" style="margin-top:70px;margin-left:10px">
            <img alt="User Pic" style="width:100%;height:100%" src="<?php echo  explodeImages($superUserTable["user_img_profil"]);?>" id="profil_photo" id="profile-image1" class="img-circle img-responsive">
          </div>
        </div>
        <div class="col-7 offset-1 " style="background-color:">
          <div class="row">
            <div class="5 offset-2">
              <h2>INFORMATIONS</h2><hr>
            </div>
          </div>
          <div class="row espacement " style="background-color:">
            <div class="col-2 "><i class="fas fa-user-circle"></i></div>
             <div class="col-2 "><p class="prod_desc3"> <?php echo $superUserTable["user_nom"]?> </p></div>
             <div class="col-2  offset-2"><i class="fas fa-at"></i></div>
              <div class="col-2 texte_info"><p class="prod_desc3"><?php echo $superUserTable["user_email"]?></p></div>

          </div>
          <div class="row ">

            <div class="col-2"><i class="fas fa-map-marker-alt"></i></div>
            <div class="col-2 "><p class="prod_desc3"><?php echo $superUserTable["user_adresse"]?></p></div>

             <div class="col-2  offset-2"><i class="fas fa-home"></i></div>
             <div class="col-2 texte_info"><p class="prod_desc3"><?php echo $superUserTable["user_ville"]?></p></div>
          </div>
          <div class="row ">
            <div class="col-2 "><i class="fas fa-street-view"></i></div>
            <div class="col-2 texte_info"><p class="prod_desc3"><?php echo $superUserTable["user_telephone"]?></p></div>
             <div class="col-2 offset-2 "><i class="fas fa-calendar-alt"></i></div>
             <div class="col-2 texte_info"><p class="prod_desc3"><?php echo $superUserTable["user_region"]?></p></div>
          </div>
          <div class="row " >
             <div class="col-2 "><i class="fas fa-phone-alt"></i></div>
             <div class="col-2 texte_info"><p class="prod_desc3"><?php echo $superUserTable["user_date_naissance"]?></p></div>
             <div class="col-2 offset-2 " ><i class="fas fa-star"></i></div>
             <div class="col-2 texte_info"><p class="prod_desc3">Rate</p></div>
          </div>
        </div>
        </div>
      </div>



<!-- Début de la catégorie des vêtements -->
     <div class="row">
       <div class="col-3">
         <div class="row">
           <div class="col-3 offset-2 ">
             <div class="row">
               <div class="wrap">
                   <div class="menu">
                       <div class="mini-menu">
                           <ul>
                       <li class="sub">
                           <a href="#" class="list-group-item">FEMME</a>
                           <ul>
                              <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=jupe&gendre=femme"><p class="prod_desc2">Jupes</p></a></li>
                              <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=robe&gendre=femme"><p class="prod_desc2">Robes</p></a></li>
                              <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=chaussure&gendre=femme"><p class="prod_desc2">Chaussures</p></a></li>
                              <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=sac&gendre=femme"><p class="prod_desc2">Sacs</p></a></li>
                              <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=jean&gendre=femme"><p class="prod_desc2">Jeans</p></a></li>
                              <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=chemise&gendre=femme"><p class="prod_desc2">Chemises</p></a></li>
                           </ul>
                       </li>
                       <li class="sub">
                           <a href="#" class="list-group-item">HOMME</a>
                           <ul>
                             <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=basket&gendre=homme"><p class="prod_desc2">Baskets</p></a></li>
                             <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=costard&gendre=homme"><p class="prod_desc2">Costards</p></a></li>
                             <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=jean&gendre=homme"><p class="prod_desc2">Jeans</p></a></li>
                             <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=pull_Gillet&gendre=homme"><p class="prod_desc2">Pull&Gilets</p></a></li>
                             <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=veste&gendre=homme"><p class="prod_desc2">Vestes</p></a></li>
                             <li><a href="Page_d_Profil.php?id_user=<?php echo $superUserTable['user_id']?>&catalogue=chemise&gendre=homme"><p class="prod_desc2">Chemises</p></a></li>
                           </ul>
                       </li>
                   </ul>
                     </div>
                   </div>
               </div>
             </div>
           </div>
         </div>
       </div>


      <div class="col-9 "  style="background-color:">
        <!-- Carousel des produits-->

        <?php

        $nbr_lignes = calculerNLignes(count($annonces),4);
        $index = 0;
        //echo count($annonces);
        //var_dump($annonces);
        /*
        if(isset($annonces[25])){
          echo "lolo";
        }
        die();*/

        for($i=1; $i<=$nbr_lignes; $i++){
        ?>
        <div class="row">

          <?php if (isset($annonces[$index]) ){ ?>
             <div class="col-md-3 cart_interval_profil espacement cart_interval_border" style="background-color:">
               <div class="row" style="background-color:">
                <a href="Page_d_Annonce.php?aff_annonce=<?php echo $annonces[$index]['annonce_id'];?>"><img src="<?php echo explodeImages($annonces[$index]['annonce_images'])?>"  id="cart_img"  alt=""></a>
               </div>
               <div class="row bottom_card" >
                 <div class="col-6 info_produit_profil"  style="background-color:">
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_type']?></p>
                     </div>
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_taille']?></p>
                     </div>
                   </div>
                 </div>
                 <div class="col-6 info_produit_profil" style="background-color:" >
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_marque']?></p>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_service']?></p>
                     </div>
                   </div>
                 </div>
                 <?php if ($superUser_request_page) {?>
                 <div class="col-12 info_produit_profil" style="background-color:" >
                   <div class="row">
                     <div class="col-4">
                      <a href="Page_d_modif_annonce.php?id_annonce=<?php echo $annonces[$index]['annonce_id'] ?>"> <p class='prod_desc'><i class="fas fa-edit"></i></p></a>
                     </div>
                     <div class="col-4 offset-2">
                       <a href="Page_d_Profil.php?supprime_annonce=<?php echo $annonces[$index]['annonce_id']?>"><p class='prod_desc'><i class="fas fa-trash-alt"></i></p></a>
                     </div>
                   </div>
                 </div>
               <?php } ?>
               </div>
             </div>
             <?php $index++; }?>

             <?php if (isset($annonces[$index]) ){ ?>
             <div class="col-md-3 cart_interval_profil espacement cart_interval_border">
               <div class="row" style="background-color:">
                  <a href="Page_d_Annonce.php?aff_annonce=<?php echo $annonces[$index]['annonce_id'];?>"><img src="<?php echo explodeImages($annonces[$index]['annonce_images'])?>"  id="cart_img"  alt=""></a>
               </div>
               <div class="row bottom_card" >
                 <div class="col-6 info_produit_profil"  style="background-color:">
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_type']?></p>
                     </div>
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_taille']?></p>
                     </div>
                   </div>
                 </div>
                 <div class="col-6 info_produit_profil" style="background-color:" >
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_marque']?></p>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_type']?></p>
                     </div>
                   </div>
                 </div>
                    <?php if ($superUser_request_page) {?>
                 <div class="col-12 info_produit_profil" style="background-color:" >
                   <div class="row">
                     <div class="col-4">
                      <a href="Page_d_modif_annonce.php?id_annonce=<?php echo $annonces[$index]['annonce_id'] ?>"> <p class='prod_desc'><i class="fas fa-edit"></i></p></a>
                     </div>
                     <div class="col-4 offset-2">
                       <a href="Page_d_Profil.php?supprime_annonce=<?php echo $annonces[$index]['annonce_id']?>"><p class='prod_desc'><i class="fas fa-trash-alt"></i></p></a>
                     </div>
                   </div>
                 </div>
               <?php } ?>
               </div>
             </div>
             <?php $index++; }?>

             <?php if (isset($annonces[$index]) ){ ?>
             <div class="col-md-3 cart_interval_profil espacement cart_interval_border">
               <div class="row" style="background-color:">
                <a href="Page_d_Annonce.php?aff_annonce=<?php echo $annonces[$index]['annonce_id'];?>">  <img src="<?php echo explodeImages($annonces[$index]['annonce_images'])?>"  id="cart_img"  alt=""></a>
               </div>
               <div class="row bottom_card" >
                 <div class="col-6 info_produit_profil"  style="background-color:">
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_type']?></p>
                     </div>
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_taille']?></p>
                     </div>
                   </div>
                 </div>
                 <div class="col-6 info_produit_profil" style="background-color:" >
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_marque']?></p>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_service']?></p>
                     </div>
                   </div>
                 </div>
                    <?php if ($superUser_request_page) {?>
                 <div class="col-12 info_produit_profil" style="background-color:" >
                   <div class="row">
                     <div class="col-4">
                      <a href="Page_d_modif_annonce.php?id_annonce=<?php echo $annonces[$index]['annonce_id'] ?>"> <p class='prod_desc'><i class="fas fa-edit"></i></p></a>
                     </div>
                     <div class="col-4 offset-2">
                       <a href="Page_d_Profil.php?supprime_annonce=<?php echo $annonces[$index]['annonce_id']?>"><p class='prod_desc'><i class="fas fa-trash-alt"></i></p></a>
                     </div>
                   </div>
                 </div>
               <?php } ?>
               </div>
             </div>
             <?php $index++; } ?>

             <?php if (isset($annonces[$index]) ){ ?>
             <div class="col-md-3 cart_interval_profil espacement cart_interval_border ">
               <div class="row" style="background-color:">
                  <a href="Page_d_Annonce.php?aff_annonce=<?php echo $annonces[$index]['annonce_id'];?>"><img src="<?php echo explodeImages($annonces[$index]['annonce_images']);?>"  id="cart_img"  alt=""></a>
               </div>
               <div class="row bottom_card" >
                 <div class="col-6 info_produit_profil"  style="background-color:">
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_type']?></p>
                     </div>
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_taille']?></p>
                     </div>
                   </div>
                 </div>
                 <div class="col-6 info_produit_profil" style="background-color:" >
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_marque']?></p>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-12">
                       <p class='prod_desc'><?php echo $annonces[$index]['annonce_service']?></p>
                     </div>
                   </div>
                 </div>
                    <?php if ($superUser_request_page) {?>
                 <div class="col-12 info_produit_profil" style="background-color:" >
                   <div class="row">
                     <div class="col-4">
                      <a href="Page_d_modif_annonce.php?id_annonce=<?php echo $annonces[$index]['annonce_id'] ?>"> <p class='prod_desc'><i class="fas fa-edit"></i></p></a>
                     </div>
                     <div class="col-4 offset-2">
                       <a href="Page_d_Profil.php?supprime_annonce=<?php echo $annonces[$index]['annonce_id']?>"><p class='prod_desc'><i class="fas fa-trash-alt"></i></p></a>
                     </div>
                   </div>
                 </div>
               <?php } ?>
               </div>
             </div>
             <?php $index++;}?>

        </div>
        <?php
      }
        ?>

       </div>
     </div>
<!-- fin du carousel-->

<!-- Début du footer -->
<?php
include 'footer.php';
 ?>







    </div>


    <?php
    //}
    ?>


    <script type="text/javascript" src="js/libs/popper.js"></script>
    <script type="text/javascript" src="js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="js/libs/bootstrap.min.js"></script>

    <script src="js/libs/jquery.min.js"></script>
    <script src="myjs/myjs.js"></script>
  </body>
</html>
