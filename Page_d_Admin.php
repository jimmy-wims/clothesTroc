

<?php
session_start();
include 'connection.php';
$db = connex("id12155121_bdsite","connect.inc.php");
include 'RequetesSQL.php';




$tableSelec = "";
$modif = false;
$id_modif = "";
$eltID = "";
$insertion =false;
$champsTable = array();
$table = array();

if(isset($_POST["boutonrecherche"])){
  redirection(strtolower($_POST['recherche']));
}
if (isset($_GET['table']) && isset($_GET['insertion'])){
  $tableSelec = $_GET['table'];
  $insertion = true;

}
if (isset($_POST['submit_insertion'])){
  if(strtolower($_POST['table_traitee']) == 'users'){
    insererDansTable(strtolower($_POST['table_traitee']));
  }
  if(strtolower($_POST['table_traitee']) == 'annonces'){
    insererDansTable(strtolower($_POST['table_traitee']));

  }
  if(strtolower($_POST['table_traitee']) == 'favoris'){
    insererDansTable(strtolower($_POST['table_traitee']));

  }
  if(strtolower($_POST['table_traitee']) == 'messages'){
    insererDansTable(strtolower($_POST['table_traitee']));

  }
}
if (isset($_GET['table']) && isset($_GET['id_supprime'])){
  if($_GET['table'] == "Users"){
    $id_supp = $_GET["id_supprime"];
    getTable("DELETE FROM users WHERE `user_id` = '$id_supp' ");
  }
  if($_GET['table'] == "Annonces"){
    $id_supp = $_GET["id_supprime"];
    getTable("DELETE FROM annonces WHERE `annonce_id` = '$id_supp' ");
  }
  if($_GET['table'] == "Messages"){
    $id_supp = $_GET["id_supprime"];
    getTable("DELETE FROM messages WHERE `message_id` = '$id_supp' ");
  }
  if($_GET['table'] == "Favoris"){
    $id_supp = $_GET["id_supprime"];
    getTable("DELETE FROM favoris WHERE `favori_id` = '$id_supp' ");
  }
}

if (isset($_GET['table']) && isset($_GET['motif']) && $_GET['table'] == 'Users' ){
  $tableSelec = "Users";
  $eltID = 'user_id';
  if($_GET['motif'] == 'affichage'){
    $modif = false;
  }else{
    if(isset($_GET['id_selec'])){
      $id_modif = $_GET['id_selec'];
      $modif = true;
    }
  }
}
if (isset($_GET['table']) && isset($_GET['motif']) && $_GET['table'] == 'Annonces'){
  $tableSelec = "Annonces";
  $eltID = 'annonce_id';
  if($_GET['motif'] == 'affichage'){
    $modif = false;
  }else{
    if(isset($_GET['id_selec'])){
      $id_modif = $_GET['id_selec'];
      $modif = true;

    }
  }
}
if (isset($_GET['table'])  && isset($_GET['motif']) && $_GET['table'] == 'Messages'){
  $tableSelec = "Messages";
  $eltID = 'message_id';

  if($_GET['motif'] == 'affichage'){
    $modif = false;
  }else{
    if(isset($_GET['id_selec'])){
      $id_modif = $_GET['id_selec'];
      $modif = true;
    }
  }
}
if (isset($_GET['table'])  && isset($_GET['motif']) && $_GET['table'] == 'Favoris'){
  $tableSelec = "Favoris";
  $eltID = 'favori_id';
  if($_GET['motif'] == 'affichage'){
    $modif = false;
  }else{
    if(isset($_GET['id_selec'])){
      $id_modif = $_GET['id_selec'];
      $modif = true;
    }
  }
}

if (isset($_POST['user_Submit_register'])){
s_inscrire_final(true);
}
if (isset($_POST['submit_modif_annonce'])){
creerAnnonce(true);
}
if (isset($_POST['submit_message'])){

updateMessages();
}
if (isset($_POST['submit_favori'])){
  updateFavoris();
}



?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="mycss/sb-admin.css" />
    <link rel="stylesheet" href="fonts/css/all.min.css" />
<!--    <link rel="stylesheet" href="mycss/style.css" />
     <link rel="stylesheet" href="myjs/myjs.js" /> -->
    <title>Page_d_Admin</title>
  </head>
  <body>

    <div class="container" style="background-color:" >


      <div id="example-table"></div>




     <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

       <a class="navbar-brand mr-1" href="Page_d_Admin.php">Administration</a>

       <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
         <i class="fas fa-bars"></i>
       </button>


       <!-- Navbar Search -->
       <form action="Page_d_Admin.php" method="POST" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="Page_d_Admin.php" method="POST" >
         <div class="input-group">
           <input type="text" class="form-control" name="recherche" placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
           <div class="input-group-append">
             <button class="btn btn-primary"  type="Submit" name="boutonrecherche">
               <i class="fas fa-search"></i>
             </button>
           </div>
         </div>
       </form>

       <!-- Navbar -->
       <ul class="navbar-nav ml-auto ml-md-0">
         <!--
         <li class="nav-item dropdown no-arrow mx-1">
           <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-bell fa-fw"></i>
             <span class="badge badge-danger">9+</span>
           </a>
           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
             <a class="dropdown-item" href="#">Action 1</a>
             <a class="dropdown-item" href="#">Action 2</a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="#">Action 3</a>
           </div>
         </li>-->
         <li class="nav-item dropdown no-arrow mx-1">
           <a href="Page_d_Admin.php?table=Messages&motif=affichage" class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-envelope fa-fw"></i>
           </a>
           <!--
           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
             <a class="dropdown-item" href="#">Action 1</a>
             <a class="dropdown-item" href="#">Action 2</a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="#">Action 3</a>
           </div> -->
         </li>
         <li class="nav-item dropdown no-arrow">
           <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-user-circle fa-fw"></i>
           </a>
           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
             <a class="dropdown-item" href="Logout.php">Déconnexion</a>
             <a class="dropdown-item" href="Page_d_accueil.php">Accueil</a>
             <a class="dropdown-item" href="Page_d_Profil.php">Profil</a>
           </div>
         </li>
       </ul>

     </nav>

     <div id="wrapper">
       <!-- Sidebar -->
       <ul class="sidebar navbar-nav">
         <li class="nav-item active">
           <a class="nav-link" href="Page_d_Admin.php">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Panneau Admin</span>
           </a>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-fw fa-chart-area"></i>
             <span>Pages</span>
           </a>
           <div class="dropdown-menu" aria-labelledby="pagesDropdown">
             <h6 class="dropdown-header">Pages</h6>
             <a class="dropdown-item" href="register.html">Inscription</a>
             <a class="dropdown-item" href="">Page inscription finale</a>
             <a class="dropdown-item" href="">Connexion</a>
             <a class="dropdown-item" href="">Page Profil</a>
             <a class="dropdown-item" href="">Page Accueil</a>
             <a class="dropdown-item" href="">Page annonce</a>
             <a class="dropdown-item" href="">Page Contact</a>
             <a class="dropdown-item" href="">Page creation annonce</a>
             <a class="dropdown-item" href="">Page Messages</a>
             <a class="dropdown-item" href="">Page Modificaton annonce</a>
             <a class="dropdown-item" href="">Page Modificaton Profil</a>
             <a class="dropdown-item" href="">Page Modif Profil</a>
             <a class="dropdown-item" href="">Page affichage annonces</a>
             <a class="dropdown-item" href="">Page affichage utilisateurs</a>
             <div class="dropdown-divider"></div>
           </div>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-table"></i>
             <span>Tables BDD</span>
           </a>
           <div class="dropdown-menu" aria-labelledby="pagesDropdown">
             <h6 class="dropdown-header">Tables </h6>
             <a class="dropdown-item" href="Page_d_Admin.php?table=Users&motif=affichage">Users</a>
             <a class="dropdown-item" href="Page_d_Admin.php?table=Annonces&motif=affichage">Annonces</a>
             <a class="dropdown-item" href="Page_d_Admin.php?table=Messages&motif=affichage">Messages</a>
             <a class="dropdown-item" href="Page_d_Admin.php?table=Favoris&motif=affichage">Favoris</a>
             <div class="dropdown-divider"></div>
           </div>
         </li>
       </ul>

       <div id="content-wrapper">

         <div class="container-fluid">

           <!-- Breadcrumbs-->
           <ol class="breadcrumb">
             <li class="breadcrumb-item">
               <a href="#">Panneau Admin</a>
             </li>
             <li class="breadcrumb-item active">Tables dans la base</li>
           </ol>

           <!-- Icon Cards-->
           <div class="row">
             <div class="col-xl-3 col-sm-6 mb-3">
               <div class="card text-white bg-primary o-hidden h-100">
                 <div class="card-body">
                   <div class="card-body-icon">
                     <i class="fas fa-fw fa-comments"></i>
                   </div>
                   <div class="mr-5"><b><?php echo count(getTable("Select * FROM users"))?> Membres inscrits !</b></div>
                 </div>
                 <a href="Page_d_Admin.php?table=Users&motif=affichage" class="card-footer text-white clearfix small z-1" href="#">
                   <span class="float-left">Voir Users</span>
                   <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                   </span>
                 </a>
               </div>
             </div>
             <div class="col-xl-3 col-sm-6 mb-3">
               <div class="card text-white bg-warning o-hidden h-100">
                 <div class="card-body">
                   <div class="card-body-icon">
                     <i class="fas fa-fw fa-list"></i>
                   </div>
                   <div class="mr-5"><b><?php echo count(getTable("Select * FROM annonces"))?> Annonces existantes ! </b></div>
                 </div>
                 <a href="Page_d_Admin.php?table=Annonces&motif=affichage" class="card-footer text-white clearfix small z-1" href="#">
                   <span class="float-left">Voir Annonces</span>
                   <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                   </span>
                 </a>
               </div>
             </div>
             <div class="col-xl-3 col-sm-6 mb-3">
               <div class="card text-white bg-success o-hidden h-100">
                 <div class="card-body">
                   <div class="card-body-icon">
                     <i class="fas fa-fw fa-shopping-cart"></i>
                   </div>
                   <div class="mr-5"><b><?php echo count(getTable("Select * FROM messages"))?> Messages enregistrés! </b></div>
                 </div>
                 <a href="Page_d_Admin.php?table=Messages&motif=affichage"  class="card-footer text-white clearfix small z-1" href="#">
                   <span class="float-left">Voir Messages</span>
                   <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                   </span>
                 </a>
               </div>
             </div>
             <div class="col-xl-3 col-sm-6 mb-3">
               <div class="card text-white bg-danger o-hidden h-100">
                 <div class="card-body">
                   <div class="card-body-icon">
                     <i class="fas fa-fw fa-life-ring"></i>
                   </div>
                   <div class="mr-5"><b><?php echo count(getTable("Select * FROM favoris"))?> Favoris effectés </b>
                   </div>
                 </div>
                 <a href="Page_d_Admin.php?table=Favoris&motif=affichage"  class="card-footer text-white clearfix small z-1" href="#">
                   <span class="float-left">Voir Favoris</span>
                   <span class="float-right">
                     <i class="fas fa-angle-right"></i>
                   </span>
                 </a>
               </div>
             </div>
           </div>
         </div>
         <!-- /.container-fluid -->
         <!-- Sticky Footer -->
       </div>
       <!-- /.content-wrapper -->
     </div>


     <div class="row" >
       <div class=" card card-cascade narrower col-8 offset-1" style="background-color:">

       <!--Card image-->
       <div
         class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
         <div>
           <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
             <i class="fas fa-th-large mt-0"></i>
           </button>
           <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
             <i class="fas fa-columns mt-0"></i>
           </button>
         </div>
         <a href="" class="white-text mx-3">Table <?php echo $tableSelec; ?></a>
         <div>
           <!--
           <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
             <i class="fas fa-pencil-alt mt-0"></i>
           </button>-->
           <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
             <?php if($modif){?>
            <div type="" class="btn btn-outline-white btn-rounded btn-sm px-2">
             <a href="Page_d_Admin.php?table=<?php echo $tableSelec?>&id_supprime=<?php echo $id_modif?>"><i class="far fa-trash-alt mt-0"></i></a></div>
           <?php }?>
            <?php if(isset($_GET['table'])){ ?>
            <div type="" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <a href="Page_d_Admin.php?table=<?php echo $tableSelec?>&insertion=true">
              <i class="fas fa-plus-square"></i></a></div>
             <!--<i class="far fa-trash-alt mt-0"></i> -->
           <?php }?>
           </button>
           <div type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
             <i class="fas fa-info-circle mt-0"></i>
           </div>
         </div>
       </div>
       <!--/Card image-->
           <!--Table-->
           <form enctype="multipart/form-data" action="Page_d_Admin.php" method="POST" class="register-form" >

           <table class="table table-hover mb-0 a" style="width:100%;background-color:" >
             <!--Table head-->
             <thead>
               <tr>
              <?php
              if(  $tableSelec == "Users"){
                $champsTable = array( "Id", "Nom","Prenom","Pseudo","Email","Password","Naissance","Ville","Adresse","Region","Tel","Gendre","Statut");
                $champsBDD = array( "user_id","user_Nom","user_Prenom","user_Pseudonyme","user_Email","user_Password","user_Date_de_naissance","user_Ville","user_Adresse","user_Region","user_Telephone","user_Gendre","user_statut");
                $champsBDDAff = array( "user_id","user_nom","user_prenom","user_pseudonyme","user_email","user_password","user_date_naissance","user_ville","user_adresse","user_region","user_telephone","user_genre","user_statut");
                if(!$modif) $table = getTable("SELECT * FROM users");
                else $table = getTable("SELECT * FROM users where `user_id`= '$id_modif' ");
              }

              if( $tableSelec == "Annonces"){
                //$tableSelec = "annonces";
                $champsTable = array("Id","User","Marque","Taille","Couleur","Type","Etat","Service","Cible","Disponibili","Images");
                $champsBDD = array( "annonce_id","annonce_user","annonce_marque","annonce_taille","annonce_couleur","annonce_type","annonce_etat","annonce_service","annoce_cible","annonce_dispobilite","annonce_images");
                $champsBDDAff = array( "annonce_id","annonce_user","annonce_marque","annonce_taille","annonce_couleur","annonce_type","annonce_etat","annonce_service","annonce_cible","annonce_disponibilite","annonce_images");
                //$table = getTable("SELECT * FROM annonces");
                if(!$modif) $table = getTable("SELECT * FROM annonces");
                else $table = getTable("SELECT * FROM annonces where `annonce_id`= '$id_modif' ");
              }

            if(  $tableSelec == "Messages"){
              //$tableSelec = "messages";
              $champsTable = array( "Id","source","destination","contenu","date","lu");
              $champsBDD =  array( "message_id","message_source","message_destination","message_contenu","message_date","message_lu");
              $champsBDDAff =  array( "message_id","message_source","message_destination","message_contenu","message_date","message_lu");
              if(!$modif) $table = getTable("SELECT * FROM messages");
              else $table = getTable("SELECT * FROM messages where `message_id`= '$id_modif' ");
            }

              if(  $tableSelec == "Favoris"){
                //$tableSelec = "favoris";
                $champsTable = array( "Id","favori_user","favori_id","Date","Type");
                $champsBDD =  array( "favori_id","favori_user","favori_fav_id","favori_date","favori_type");
                $champsBDDAff =  array( "favori_id","favori_user","favori_fav_id","favori_date","favori_type");
                if(!$modif) $table = getTable("SELECT * FROM favoris");
                else $table = getTable("SELECT * FROM favoris where `favori_id`= '$id_modif' ");
              }
              ?>
              <?php foreach ($champsTable as $key => $value){ ?>
                <th class="th-lg" style="padding:2px" >
                  <a href=""><?php echo $champsTable[$key]?>
                  </a>
                </th>
              <?php } ?>
               </tr>
             </thead>
             <tbody>
               <?php if ($insertion){ ?>
                 <?php foreach ($champsBDD as $k => $v){ ?>
                 <td><input  type="text" name="<?php echo $champsBDD[$k]?>" value="" class="form-control input_admin"></td>
               <?php }?>

               <?php }else {?>

               <?php foreach ($table as $key => $val){ ?>
               <tr >
                 <?php foreach ($champsBDD as $k => $v){ ?>
                   <?php if ($modif) {?>
                     <td style="padding:10px;margin:0px;" class="cell-breakWord"><input  type="text" name="<?php echo $champsBDD[$k]?>" value="<?php echo $table[$key][$champsBDDAff[$k]];?>" class="form-control input_admin"></td>
                  <?php }else {?>
                  <td style="padding:10px;margin:0px;" class="cell-breakWord"><a  href="Page_d_Admin.php?table=<?php echo $tableSelec?>&motif=modfif&id_selec=<?php echo $table[$key][$champsBDDAff[0]]?>"> <?php echo $table[$key][$champsBDDAff[$k]];?></a></td>
                <?php }?>

                <?php }?>
                </tr>
              <?php }} ?>
             </tbody>
             <!--Table body-->
           </table>
           <?php if($modif AND !isset($_GET['id_supprime']) && isset($_GET['table'])  ){
             if ( $_GET['table'] == 'Users'){
             ?>
           <div class="col-3 offset-5" ><button type="Submit" name="user_Submit_register" class="btn btn-primary">Enregistrer</button></div>
         <?php }else if( $_GET['table'] == 'Annonces') { ?>
           <div class="col-3 offset-5" ><button type="Submit" name="submit_modif_annonce" class="btn btn-primary">Enregistrer</button></div>

         <?php }else if ( $_GET['table'] == 'Messages') { ?>
           <div class="col-3 offset-5" ><button type="Submit" name="submit_message" class="btn btn-primary">Enregistrer</button></div>

       <?php } else if ( $_GET['table'] == 'Favoris') { ?>
         <div class="col-3 offset-5" ><button type="Submit" name="submit_favori" class="btn btn-primary">Enregistrer</button></div>
       <?php }}?>
       <?php if($insertion){?>
         <div class="col-3 offset-5" ><button type="Submit" name="submit_insertion" class="btn btn-primary">Enregistrer</button></div>
         <input name="table_traitee" type="hidden" value="<?php echo $tableSelec ?>">
       <?php }?>
         </form>

       </div>
           <!--Table-->
   </div>

</div>
     <!-- Table with panel -->




     <!-- Table with panel -->
     <!-- Bootstrap core JavaScript-->






<!--fin du panel pour les vet -->


<footer class="">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Site de mise en relation </span>
    </div>
  </div>
</footer>

    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/libs/popper.js"></script>
    <script type="text/javascript" src="js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="myjs/sb-admin.min.js"></script>
    <script type="text/javascript" src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/jquery.min.js"></script>
    <script src="myjs/myjs.js"></script>
  </body>
</html>
