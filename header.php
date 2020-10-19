<?php
session_start();
include 'connection.php';
$db = connex("id12155121_bdsite","connect.inc.php");
include 'RequetesSQL.php';

?>


<div class="row sticky-top" style="background-color:">
    <div class="col-12">
      <div class="row" style="background-color:">
        <div class="col-1">
          <!--<nav class="navbar navbar-expand-lg navbar-light bg-light">                 -->
          <a class="navbar-brand" href="Page_d_accueil.php"><img src="img/logo.png" id="imgLogo"  alt=""></a>
        </div>
        <div class="col-2">
          <div class="wrap" >
              <div class="menu" >
                  <div class="mini-menu" style="width:100%;height:100%;margin-top:0">
                    <ul>
                      <li class="sub">
                          <a href="#" class="list-group-item">Catégories</a>
                          <ul>
                             <li><a href="Page_d_accueil.php?recherche_membre=true">Membres</a></li>
                             <li><a href="Page_d_accueil.php?recherche_annonce=true">Annonces</a></li>
                             <li><a href="Page_d_accueil.php?localisation=true">Localisation</a></li>
                          </ul>
                      </li>
                    </ul>
                </div>
            </div>
          </div>
        </div>
        <?php
        $var = "";
        if (isset($_GET['recherche_membre'])){
          $var= "membres";
        }
        if (isset($_GET['recherche_annonce'])){
          $var= "annonces";
        }
        if (isset($_GET['localisation'])){
          $var= "localisation";
        }
        if(isset($_POST['lancerRecherche'])){
          if(!empty($_POST['mot_recherche'])){
            if($_POST['type_recherche'] == 'annonces') header("Location: page_listing_annonces.php?recherche_type=".$_POST['type_recherche']."&recherche_mot=". $_POST['mot_recherche']);     //redirection
            if($_POST['type_recherche'] == 'membres') header("Location: Page_listing_utilisateurs.php?recherche_type=".$_POST['type_recherche']."&recherche_mot=". $_POST['mot_recherche']);     //redirection
            if($_POST['type_recherche'] == 'localisation') header("Location: Page_listing_utilisateurs.php?recherche_type=".$_POST['type_recherche']."&recherche_mot=". $_POST['mot_recherche']);     //redirection
          }
        }
        ?>
        <div class="col-3 ">
          <form action="Page_d_accueil.php" method="post">
          <div class="row">
            <div class="col-6" >
              <div class="active-cyan-3 active-cyan-4 mb-4">
                <input type="text"  name="mot_recherche" class="form-control" id="search_box"  style="height:14%"  placeholder="Search" >

                <input name="type_recherche" type="hidden" value="<?php echo $var ?>">
              </div>
            </div>
            <div class="col-6" >
              <!--<a href="Page_d_accueil.php?php echo $var."&lancerRecherche=true"?>"><div class=""><i class="fas fa-search"></i></div></a> -->
              <button type="Submit" name="lancerRecherche" ><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
        </div>
        <div class="col-1 offset-3" >
          <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class=""><i class="fas fa-bars"></i></div>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Page_d_creation_annonce.php">Créer Annonce</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Page_listing_utilisateurs.php">Membres</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="page_listing_annonces.php">Annonces</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="page_listing_annonces.php?set_favoris=true">Annonces Favoris </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Page_listing_utilisateurs.php?set_favoris=true">Membres Favoris</a>
          <?php if(isset($_SESSION['id_user']) && isAdmin($_SESSION['id_user'])) {?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="Page_d_Admin.php?id_user=<?php echo $_SESSION['id_user']?>">Admin</a>
          <?php }?>
          </div>
        </div>
        <div class="col-1">
          <a class="nav-link dropdown" href="Page_d_Messages.php" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <div><i class="fas fa-envelope-open-text"></i></div>
          </a>
        </div>
        <div class="col-1">
          <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div ><i class="fas fa-user-tie"></i></div>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="Page_d_Profil.php?id_user=<?php echo $_SESSION['user_connecte']['user_id'];?>" >Profil</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="Page_d_Modif_Profil.php">Modifier Profil</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="Logout.php">Se déconnecter</a>
            </div>
          </a>
        </div>
      </div>
      </div>
</div>
