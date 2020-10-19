<?php


function s_inscrire(){
	global $db;
	if( isset($_POST['submit_register']) ){
		$message = "";
		if(!empty ($_POST['user_email_register']) && !empty($_POST['user_nom_register'])  && !empty($_POST['user_prenom_register'] )
		  && !empty($_POST['user_passowrd_register'])){
		    if(filter_var($_POST['user_email_register'], FILTER_VALIDATE_EMAIL) ) {
		  	if(strlen($_POST['user_nom_register']) >= 2   && strlen($_POST['user_prenom_register']) >= 2 && strlen($_POST['user_passowrd_register']) >= 8 ){
		  		if($_POST['user_nom_register'] != $_POST['user_prenom_register'] ){
		  	    	$nom = $_POST['user_nom_register'];
		      		$prenom = $_POST['user_prenom_register'];
		      		$email = $_POST['user_email_register'];
		      		$password = password_hash($_POST['user_passowrd_register'],PASSWORD_BCRYPT);   //Crypte le mot de passe avant de l'insérer dans la base
							$user_pseudonyme= NULL;
							//$user_date_naissance= date("Y-m-d H:i:s");
							$user_date_naissance= NULL;
							$user_ville= NULL;
							$user_adresse= NULL;
							$user_region= NULL;
							$user_telephone= NULL;
							$user_metier= NULL;
							$user_message_profil= NULL;
							$user_img_profil= NULL;
							$user_genre = NULL;
							$user_statut = "membre";
		      		$requete = "INSERT INTO users(user_nom,user_prenom,user_pseudonyme,user_email,user_password,user_date_naissance,user_ville,user_adresse,user_region,user_telephone,user_metier,user_message_profil,user_img_profil,user_statut) VALUES
		      (:nom, :prenom,:pseudonyme,:email,:password,:date_naissance,:ville,:adresse,:region,:telephone,:metier,:message_profil,:img_profil,:statut)";

			      $resultat = $db->prepare($requete);
			      $resultat->bindParam(':nom', $nom);
			      $resultat->bindParam(':prenom', $prenom);
			      $resultat->bindParam(':pseudonyme', $user_pseudonyme);
			      $resultat->bindParam(':email', $email);
			      $resultat->bindParam(':password', $password);
			      $resultat->bindParam(':date_naissance', $user_date_naissance);
			      $resultat->bindParam(':ville', $user_ville);
			      $resultat->bindParam(':adresse', $user_adresse);
			      $resultat->bindParam(':region', $user_region);
			      $resultat->bindParam(':telephone', $user_telephone);
			      $resultat->bindParam(':metier', $user_metier);
			      $resultat->bindParam(':message_profil', $user_message_profil);
			      $resultat->bindParam(':img_profil', $user_img_profil);
			      $resultat->bindParam(':statut', $user_statut);

			
		      if(!$insertion = $resultat->execute()) {
		       //echo "L'inscription n'a pu être effectuée ";   
		       	     afficherPopUp(htmlentities("L'inscription n'a pu être effectuée"));

		       	//$resultat->debugDumpParams();
		       	//die();
		      }
						
		      else  header("Location: Page_d_inscription_finale.php");
		     	}else afficherPopUp(htmlentities("Le nom et le prénom ne peuvent pas être identiques"));
		  }else afficherPopUp(htmlentities("Les informations ne respectent pas la taille requise"));
		    }else afficherPopUp(htmlentities("L'adresse mail n'est pas valide"));
		} 
	}
}


function se_connecter(){
	global $db;
	if(isset($_POST['submit_login'])){
		if(!empty ($_POST['user_email_login']) && !empty($_POST['user_password_login'])){
		  //    $db = connex("socialnetwork","connect.inc.php");    //connection avec la base
		      $email_login = $_POST['user_email_login'];
		      $password_login = $_POST['user_password_login'];
		      //echo $prenom;
		      $requete = "SELECT user_id,user_email,user_password FROM users WHERE user_email = :email  ";
		      $resultat = $db->prepare($requete);
		      $resultat->bindParam(':email',$email_login);

		      if($resultat->execute() && $results = $resultat->fetch(PDO::FETCH_ASSOC)){
						//retournee les resultats de la requêtes, en tableau assiociatif, sinon retourne faux.
						 if(count($results)>0);
						 else afficherPopUp(htmlentities("Les identifiants incorrects"));
						//Verification que le mot de passe fournit est identique à celui qui se trouve dans la base de données en
						//prenant compt du cryptage
						$message =" ";
						if(password_verify($_POST['user_password_login'], $results['user_password'] )  ){

							$_SESSION['id_user'] = $results['user_id'];
							userGlobal();

						 header("Location: Page_d_Profil.php?id_user=".$_SESSION['id_user']);    
					//echo "<script> window.location = 'Page_d_Profil.php?id_user=".$_SESSION['id_user'].";</script>" ;

						 //redirection vers la page indiqué
					 }else afficherPopUp(htmlentities("Les indetifiants sont incorrects"));
						/*$resultat->debugDumpParams();*/
					}else afficherPopUp(htmlentities("Les identifiants saisis ne sont pas corrects"));
		}
	}
}

//Recherche l'id de la dernière ligne inséere dans une table donnée
function getLastId($table,$colonne){
global $db;

$id =" ";
$req = "SELECT max( $colonne ) FROM ".$table; 
//retourne l'id du dernier ulisateur de dans la base de donnée users
$resultat = $db->prepare($req);
if(!$resultat->execute()) {
    $resultat->debugDumpParams();
}
else{
      $tab = $resultat->fetch();
      $id = $tab[0] ;  //l'id de l'utilisateur qui vient de s'inscrire
}
return intval($id);
}




function updateFavoris(){
	global $db;

	if(isset ($_POST['favori_user']) && isset ($_POST['favori_fav_id']) && isset ($_POST['favori_date']) && isset ($_POST['favori_type'])
	){
		$requete = "";
		$favori_id = $_POST['favori_id'];
		$favori_user = $_POST['favori_user'];
		$favori_fav_id = $_POST['favori_fav_id'];
		$favori_date = $_POST['favori_date'];
		$favori_type = $_POST['favori_type'];
		$requete = "UPDATE favoris SET `favori_user` = '$favori_user', `favori_fav_id` = '$favori_fav_id' ,`favori_date`= '$favori_date' ,`favori_type` = '$favori_type' WHERE  `favori_id` = '$favori_id' " ;
		$resultat = $db->prepare($requete);
		echo $requete;
		if(!$insertion = $resultat->execute()) "L'opération a échouée";
	}
}

function updateMessages(){
	global $db;

	$requete = "";
	if(isset ($_POST['message_source']) && isset ($_POST['message_destination']) && isset ($_POST['message_contenu']) && isset ($_POST['message_date']) &&
	isset ($_POST['message_lu'])
	){
		$message_id = $_POST['message_id'];
		$message_source = $_POST['message_source'] ;
		$message_destination = $_POST['message_destination'] ;
		$message_contenu = $_POST['message_contenu'] ;
		$message_date = $_POST['message_date'] ;
		$message_lu = $_POST['message_lu'] ;
		$requete = "UPDATE messages SET  `message_source` = '$message_source',  `message_destination`= '$message_destination', `message_contenu` = '$message_contenu',`message_date` = '$message_date', `message_lu` = '$message_lu'  WHERE  message_id = '$message_id' " ;
		$resultat = $db->prepare($requete);
		if(!$insertion = $resultat->execute()) "L'opération a échouée";
	}
}

function afficherPopUp($message){
	echo "<script>alert(\"$message\")</script>";
}

function insererDansTable($table){
	global $db;
	$requete = "";
	if ($table = 'annoces'){
		if(isset($_POST['annonce_user']) && isset ($_POST['annonce_marque']) && isset($_POST['annonce_taille'])  && isset($_POST['annonce_couleur'])
			&& isset($_POST['annonce_type'])&& isset($_POST['annoce_cible'])&& isset($_POST['annonce_etat'])
			&& isset($_POST['annonce_service'])&& isset($_POST['annonce_dispobilite']) && isset($_POST['annonce_images'])
		){
			$annonce_user = $_POST['annonce_user'];
			$annonce_marque = $_POST['annonce_marque'];
			$annonce_taille = $_POST['annonce_taille'];
			$annonce_couleur = $_POST['annonce_couleur'];
			$annonce_type = $_POST['annonce_type'];
			$annoce_cible = $_POST['annoce_cible'];
			$annonce_etat = $_POST['annonce_etat'];
			$annonce_service = $_POST['annonce_service'];
			$annonce_dispobilite = $_POST['annonce_dispobilite'];
			$annonce_images  = $_POST['annonce_images'] ;

			$requete = "INSERT INTO annonces(annonce_user,annonce_marque,annonce_taille,annonce_couleur,annonce_type,annonce_etat,annonce_service,annonce_cible,annonce_disponibilite,annonce_images) VALUES
			('$annonce_user','$annonce_marque' ,'$annonce_taille','$annonce_couleur','$annonce_type','$annonce_etat','$annonce_service','$annoce_cible','$annonce_dispobilite','$annonce_images')";
			$resultat = $db->prepare($requete);
			echo $requete;
			if(!$insertion = $resultat->execute()) "L'opération a échouée";
		}
	}
	if ($table = 'users'){
        echo "adadazdzd";
		if (  isset ($_POST['user_Pseudonyme']) && isset($_POST['user_Date_de_naissance'])  && isset($_POST['user_Gendre'])  && isset ($_POST['user_Ville']) && isset ($_POST['user_Adresse']) &&
		isset ($_POST['user_Region']) && isset ($_POST['user_Telephone'])  && isset ($_POST['user_Nom'])
		&& isset ($_POST['user_Prenom'])&& isset ($_POST['user_Email'])&&isset ($_POST['user_Password'])&& isset ($_POST['user_statut']) ){
		$user_Pseudonyme = $_POST['user_Pseudonyme'];
		$user_Date_naissance = $_POST['user_Date_de_naissance'];
		$user_Gendre = $_POST['user_Gendre'];
		//$user_Metier = $_POST['user_Metier'];
		$user_Region = $_POST['user_Region'];
		$user_Password = $_POST['user_Password'];
		$user_Email = $_POST['user_Email'];
		//$user_img_profil = $_POST['user_Image'];
		$user_Ville = $_POST['user_Ville'];
		$user_Adresse = $_POST['user_Adresse'];
		//$user_Message = $_POST['user_Message'];
		$user_Nom = $_POST['user_Nom'];
		$user_Prenom = $_POST['user_Prenom'];
		$user_Telephone = $_POST['user_Telephone'] ;
		$user_statut = $_POST['user_statut'] ;

			$requete = "INSERT INTO users (user_nom,user_prenom,user_pseudonyme,user_email,user_password, user_date_naissance,user_ville ,user_adresse , user_region,user_telephone,user_genre,user_statut)
			VALUES ('$user_Nom','$user_Prenom','$user_Pseudonyme','$user_Email','$user_Password','$user_Date_naissance','$user_Ville','$user_Adresse','$user_Region','$user_Telephone',
			'$user_Gendre','$user_statut') ";
			$resultat = $db->prepare($requete);
			echo $requete;
			if(!$insertion = $resultat->execute()) "L'opération a échouée";
	}
	}
	if ($table = 'messages'){
		if(isset ($_POST['message_source']) && isset ($_POST['message_destination']) && isset ($_POST['message_contenu']) &&
		isset ($_POST['message_lu']))
		{
			$message_id = $_POST['message_id'];
			$message_source = $_POST['message_source'] ;
			$message_destination = $_POST['message_destination'] ;
			$message_contenu = $_POST['message_contenu'] ;

			$message_lu = $_POST['message_lu'] ;
			$requete = "INSERT INTO messages (message_source,message_destination,message_contenu,message_lu) VALUES ('$message_source','$message_destination','$message_contenu','$message_lu') " ;
			$resultat = $db->prepare($requete);
			if(!$insertion = $resultat->execute()) "L'opération a échouée";
		}
	}
	if ($table = 'favoris'){
	if(isset ($_POST['favori_user']) && isset ($_POST['favori_fav_id']) && isset ($_POST['favori_type'])
	){
		$requete = "";
		$favori_id = $_POST['favori_id'];
		$favori_user = $_POST['favori_user'];
		$favori_fav_id = $_POST['favori_fav_id'];
		$favori_type = $_POST['favori_type'];
		$requete = "INSERT INTO favoris (favori_user,favori_fav_id,favori_type) VALUES ('$favori_user','$favori_fav_id','$favori_type') " ;
		$resultat = $db->prepare($requete);
		//echo $requete;
		if(!$insertion = $resultat->execute()) "L'opération a échouée";
	}
	}
}



function s_inscrire_final($admin){
	global $db;
	$message = "";

		$user_nom = "";
		$user_prenom ="" ;
		$user_statut = "";
		$user_email = "";
		$user_password = "";
		//var_dump($_POST);

		if($admin or (isset ($_POST['user_Pseudonyme']) && isset($_POST['user_Date_de_naissance'])  && isset($_POST['user_Gendre']) &&
		isset ($_POST['user_Metier']) && isset ($_POST['user_Ville']) && isset ($_POST['user_Adresse']) &&
		isset ($_POST['user_Region']) && isset ($_POST['user_Telephone']) && isset ($_POST['user_Message']) &&
		isset ($_FILES['user_Image']) )
	){

		$user_pseudonyme= htmlentities( $_POST['user_Pseudonyme']);
		$user_date_naissance= $_POST['user_Date_de_naissance'];
		$user_genre= htmlentities($_POST['user_Gendre']);
		$user_metier= htmlentities($_POST['user_Metier']);
		$user_ville= htmlentities($_POST['user_Ville']);
		$user_adresse= htmlentities($_POST['user_Adresse']);
		$user_region= htmlentities($_POST['user_Region']);
		$user_telephone= $_POST['user_Telephone'];
		$user_messages= htmlentities($_POST['user_Message']);
		if(!$admin){
			$dernier_id = getLastId(" users", 'user_id');
			
			$user_img_profil= "users/".$dernier_id."/"."photoprofil/".$_FILES['user_Image']['name'];
		}else{
			$dernier_id = $_POST['user_id'] ;
			$user_img_profil = $_POST['user_Image'];
		}

		if ($admin){
			$user_nom = $_POST['user_Nom'];
			$user_prenom = $_POST['user_Prenom'];
			$user_statut = $_POST['user_statut'];
			$user_email = $_POST['user_Email'];
			$user_password = $_POST['user_Password'];
			$requete = "UPDATE users SET user_nom=:user_nom,user_prenom=:user_prenom,user_pseudonyme=:pseudonyme, user_email=:user_email,user_password=:user_password,user_date_naissance=:date_naissance,
			 user_ville=:ville,user_adresse=:adresse,user_region=:region,user_telephone=:telephone,user_metier=:metier,user_message_profil=:message_profil,user_img_profil=:img_profil,user_genre=:genre,user_statut=:user_statut
			 WHERE user_id = :dernier_id ";
		}else{
			$requete = "UPDATE users SET user_pseudonyme=:pseudonyme, user_date_naissance=:date_naissance,
			 user_ville=:ville,user_adresse=:adresse,user_region=:region,user_telephone=:telephone,user_metier=:metier,user_message_profil=:message_profil,user_img_profil=:img_profil,user_genre=:genre
			 WHERE user_id = :dernier_id ";
		}

		//$requete = "UPDATE photosuser SET `like` = '$update' WHERE  id_photosuser = '$endroit' " ;

	  $resultat = $db->prepare($requete);
	  $resultat->bindParam(':pseudonyme', $user_pseudonyme);
	  $resultat->bindParam(':date_naissance', $user_date_naissance);
	  $resultat->bindParam(':ville', $user_ville);
	  $resultat->bindParam(':adresse', $user_adresse);
	  $resultat->bindParam(':region', $user_region);
	  $resultat->bindParam(':telephone', $user_telephone);
	  $resultat->bindParam(':metier', $user_metier);
	  $resultat->bindParam(':message_profil', $user_messages);
	  $resultat->bindParam(':img_profil', $user_img_profil);
	  $resultat->bindParam(':genre', $user_genre);
	  $resultat->bindParam(':dernier_id', $dernier_id);
		if($admin){
			$resultat->bindParam(':user_nom', $user_nom);
			$resultat->bindParam(':user_prenom', $user_prenom);
			$resultat->bindParam(':user_email', $user_email);
			$resultat->bindParam(':user_password', $user_password);
			$resultat->bindParam(':user_statut', $user_statut);
		}

			//var_dump($resultat);
			if(!$insertion = $resultat->execute()) {
				echo "L'inscription finale n'a pu être effectuée ";
				//$resultat->debugDumpParams();
			}
			else {
				//$resultat->debugDumpParams();
				//die();

				if(!$admin){
				$pathDossierUSer ="users/".$dernier_id."/";
				if(!file_exists($pathDossierUSer)) mkdir($pathDossierUSer) ;  //on vérifie si le fichier existe déja
				//$pathDossierUSer ="users/".$dernier_id."/"."photoprofil/";
				sauvegarderImageProfil($dernier_id);
				if(!file_exists($pathDossierUSer."photoprofil")) mkdir($pathDossierUSer."photoprofil") ;  //on vérifie si le fichier existe déja
				//header("Location: Page_d_accueil.php");
				header("Location: Page_d_Reseau_social.php");
			  }
			}
		}
}


//Stocke les donneés de l'utilisateur connecté dans le tableau GLOBALS dans la page Profil.php
function userGlobal(){
	global $db;
	if(isset($_SESSION['id_user'])) {
		//global $db;
		$id = $_SESSION['id_user'];
		$requete = "SELECT * FROM users WHERE user_id = :id ";
		$resultat = $db->prepare($requete);
		$resultat->bindParam(':id',$id);
		$resultat->execute();
		/*$resultat->debugDumpParams();**/
		$user_connecte = $resultat->fetch(PDO::FETCH_ASSOC);
		if(isset($user_connecte) && !empty($user_connecte)){
			$_SESSION['user_connecte'] = $user_connecte;
			//var_dump($_SESSION['user_connecte']["user_pseudonyme"]);
		}
	}
}

//Création  et modification d'annonce
function creerAnnonce($admin){
	global $db;
	if(isset($_POST['creer_annonce']) OR isset($_POST['submit_modif_annonce']) ){

	if(!empty ($_POST['annonce_marque']) && !empty($_POST['annonce_taille'])  && !empty($_POST['annonce_couleur'])
		&& !empty($_POST['annonce_type'])&& !empty($_POST['annoce_cible'])&& !empty($_POST['annonce_etat'])
		&& !empty($_POST['annonce_service'])&& !empty($_POST['annonce_dispobilite']) && 	(isset($_FILES['annonce_images']) OR $admin)
		) {
		    
			$annonce_marque = $_POST['annonce_marque'];
			$annonce_taile =  $_POST['annonce_taille'];
			$annonce_couleur =  $_POST['annonce_couleur'];
			$annonce_type =  $_POST['annonce_type'];
			$annonce_etat =  $_POST['annonce_etat'];
			$annonce_cible =  $_POST['annoce_cible'];
			$annonce_service =  $_POST['annonce_service'];
			$annonce_dispobilite =  $_POST['annonce_dispobilite'];
			if (!$admin){
			$user = $_SESSION['id_user'];
			$annonce_images =  $_FILES['annonce_images']['type'];
			
		}elseif ($admin) {
				//c'est normalement annonce_id et pas user_Id
				$id_annonce = $_POST['annonce_id'];
				$annonce_images = $_POST['annonce_images'];
				$user = $_POST['annonce_user'];
			}

			//L'id de l'annonce à modifier par l'utilisateur
			if (isset($_POST['submit_modif_annonce']) && !$admin){
			//$id_annonce = $_GET['modif_annonce'];
			$id_annonce = $_POST['hidden_id'];
		  }
			if (isset($_POST['creer_annonce']) ){
			    
				$requete = "INSERT INTO annonces(annonce_user,annonce_marque,annonce_taille,annonce_couleur,annonce_type,annonce_etat,annonce_service,annonce_cible,annonce_disponibilite) VALUES
		(:user, :marque,:taille,:couleur,:type,:etat,:service,:cible,:disponibilite)";
	}else {


		$requete = "UPDATE annonces SET annonce_user=:user,
																	annonce_marque=:marque,
																	annonce_taille=:taille,
																	annonce_couleur=:couleur,
																	annonce_type=:type,
																	annonce_etat=:etat,
																	annonce_service=:service,
																	annonce_cible=:cible,
																	annonce_disponibilite=:disponibilite WHERE annonce_id = :id_annonce ";
	}

		$resultat = $db->prepare($requete);
		$resultat->bindParam(':user', $user);
		$resultat->bindParam(':marque', $annonce_marque);
		$resultat->bindParam(':taille', $annonce_taile);
		$resultat->bindParam(':couleur', $annonce_couleur);
		$resultat->bindParam(':type', $annonce_type);
		$resultat->bindParam(':etat', $annonce_etat);
		$resultat->bindParam(':cible', $annonce_cible);
		$resultat->bindParam(':service', $annonce_service);
		$resultat->bindParam(':disponibilite', $annonce_dispobilite);
		if (isset($_POST['submit_modif_annonce']) ){
			$resultat->bindParam(':id_annonce', $id_annonce);
		}
		//$resultat->bindParam(':images', $annonce_images);
		if(!$insertion = $resultat->execute()){
		    //$resultat->debugDumpParams();
		    echo "La modification d'annonce n'a pu être effectuée ";}
		else{
		   
		    
			//echo "La création s'est terminée avec succès";
			if (!$admin){
				$nbrfichiers = count($_FILES['annonce_images']['name']);
				$tabChemins = array();
				if($nbrfichiers > 0){
				     
			  	   
					$lastid = getLastId(" annonces",'annonce_id');
				
					for ($x = 0; $x < $nbrfichiers; $x++) {
						//Chemins des images d'une annonce
						$tabChemins[$x]= sauvegarderImages($user,$lastid,$x) ;
					}
					//var_dump($tabChemins);
					$tableChemins = implode("@%&",$tabChemins);
					sauvegardeCheminsImages($tableChemins);
				}
			}
		}
		//$resultat->debugDumpParams();
	}
	}
}


function sauvegardeCheminsImages($chemins){
	global $db;
	$lastid = getLastId(" annonces",'annonce_id');
	$requete = "UPDATE annonces SET annonce_images=:cheminsImages
	 WHERE annonce_id = :dernier_id ";
	 $resultat = $db->prepare($requete);
	 $resultat->bindParam(':cheminsImages', $chemins);
	 $resultat->bindParam(':dernier_id', $lastid);
	 if(!$insertion = $resultat->execute()){
	      echo "Opération échouée ";
	 } else{
	     afficherPopUp("Opération réuissie");
	 }
	
}


function sauvegarderImageProfil($id_user){
	$fileType = $_FILES["user_Image"]["type"]; //returns the type of the input
	$path ="users/";
	$id_user .="/";
	$path .=$id_user;
	//echo $path;
	if(!file_exists($path)) mkdir($path) ;  //on vérifie si le fichier existe déja
	$path .='photoprofil';
	if(!file_exists($path)) mkdir($path) ;  //on vérifie si le fichier existe déja

		//verification du type de l'image
		if(($fileType == "image/gif")  || ($fileType == "image/jpeg") ||($fileType == "image/jpg") ||($fileType == "image/png")  || ($fileType == "image/x-icon")  || ($fileType == "image/jfif")  ){

				//Verification de l'existence préalable du fichier dans le répertoire image
				if(file_exists($path.$_FILES["user_Image"]["name"])) {
				 //echo "File already exists";
				 $path .="/".$_FILES["user_Image"]["name"];
				 return $path;
				}
				else{
				//Déplacement du fichier de son emplacement temporaire à l'emplacement spécifié
					$path .="/";
					move_uploaded_file($_FILES["user_Image"]["tmp_name"],$path.$_FILES["user_Image"]["name"]);
					return $path;
				}
 }else{
	 echo "Cette extenstion du fichier n'est supportée";
 }
}

//sauvegarde d'imagas d'annoces dans le dossier de l'utilisateur
function sauvegarderImages($id_user,$id_annonce,$indice){
	 $fileType = $_FILES["annonce_images"]["type"][$indice]; //returns the type of the input
	 $path ="users/";
	 $id_user .="/";
	 $path .=$id_user;
	 //echo $path;
	 if(!file_exists($path)) mkdir($path) ;  //on vérifie si le fichier existe déja
	 $id_annonce .="/";
	 $path .=$id_annonce;
	 if(!file_exists($path)) mkdir($path) ;  //on vérifie si le fichier existe déja

   	 //verification du type de l'image
  	 if(($fileType == "image/gif")  || ($fileType == "image/jpeg") ||($fileType == "image/jpg") ||($fileType == "image/png")  || ($fileType == "image/x-icon") || ($fileType == "image/jfif") ){

	    	 //Verification de l'existence préalable du fichier dans le répertoire image
	    	 if(file_exists($path.$_FILES["annonce_images"]["name"][$indice])) {
	    	  //echo "File already exists";
	    	  $path .=$_FILES["annonce_images"]["name"][$indice];
	    	  return $path;
	    	 }
	    	 else{
	    	 //Déplacement du fichier de son emplacement temporaire à l'emplacement spécifié
	      	 move_uploaded_file($_FILES["annonce_images"]["tmp_name"][$indice],$path.$_FILES["annonce_images"]["name"][$indice]);
	      	 $path .=$_FILES["annonce_images"]["name"][$indice];
	      	 return $path;
    	       }
	}else{
		echo "Cette extenstion du fichier n'est supportée";
	}
}


function getAnnonce($id_annonce){
	global $db;
	$requete = "SELECT * FROM annonces WHERE annonce_id = :annonce ";
	 $resultat = $db->prepare($requete);
	 $resultat->bindParam(':annonce', $id_annonce);
	 if(!$insertion = $resultat->execute()) echo "Opération échouée ";
 	 else{
		 $res = $resultat->fetch(PDO::FETCH_ASSOC);
		 return $res;
	 }

}
function getAnnoncesById($id_user){
	global $db;
	$tabAnnonces = [];
	$requete = "SELECT * FROM annonces WHERE annonce_user = :user ";
	 $resultat = $db->prepare($requete);
	 $resultat->bindParam(':user', $id_user);
	 if(!$insertion = $resultat->execute()) echo "Opération échouée ";
 	 else{
		 while($results = $resultat->fetch(PDO::FETCH_ASSOC)){
						$tabAnnonces [] = $results;
		 }
		 return $tabAnnonces;

	 }
}


function getTable($requete){
	global $db;
	$tab = [];
	//$requete = "SELECT * FROM annonces WHEr ";
	 $resultat = $db->prepare($requete);
	 if(!$insertion = $resultat->execute()) echo "Opération échouée ";
 	 else{
		 while($results = $resultat->fetch(PDO::FETCH_ASSOC)){
						$tab [] = $results;
		 }
		 return $tab;
	 }
}

function isAdmin($id_user){
	global $db;
	$reponse = false;
	$tab = [];
	$requete = "SELECT user_statut FROM users WHERE user_id = '$id_user' ";
	 $resultat = $db->prepare($requete);
	 if(!$insertion = $resultat->execute()) echo "Opération échouée ";
	 else{
		 while($results = $resultat->fetch(PDO::FETCH_ASSOC)){
						$tab [] = $results;
		 }
		 if(isset($tab)&& !empty($tab) && $tab[0]['user_statut'] == 'admin') return true;
		 else return false;
	 }
	 return false;
}

function calculerNLignes($nbr_annonces,$modulo){
	$nbr_lignes =   1;
	if ($nbr_annonces > 0  ){
		if (floor($nbr_annonces/$modulo) == 0 ){
			$nbr_lignes = 1;
		}else if(floor(($nbr_annonces/$modulo)) > 0 && $nbr_annonces % $modulo == 0){
			$nbr_lignes = floor(($nbr_annonces/$modulo)) ;
		}else if(floor(($nbr_annonces/$modulo)) > 0 && $nbr_annonces % $modulo != 0){
			$nbr_lignes = floor(($nbr_annonces/$modulo)) + 1 ;
		}
	}
	return $nbr_lignes;
}

function explodeImages($images){
	$images = explode("@%&",$images);
	return $images[0];
}


function enregistrerMessage(){
	global $db;
	//$id_messg =  $_SESSION['id_user'];

	$source_messg =  $_SESSION['id_user'];
	$destination_messg =$_GET['destination_source'];
	//$contenu_messg =  $_POST['contenu_message'];
	$contenu_messg =  $_POST['contenu_message'];
	$lu_mssg = 0 ;
	//$id_messg =  $_SESSION['id_user'];

	if( isset($_POST['submit_message']) ){
		if(!empty($source_messg)  && !empty( $destination_messg)
			&& !empty($contenu_messg ) ){
				$requete = "INSERT INTO messages(message_source,message_destination,message_contenu,message_lu) VALUES
				(:source_message,:destination_message,:contenu_message,:lu_message)";

		$resultat = $db->prepare($requete);
	  $resultat->bindParam(':source_message', $source_messg);
	  $resultat->bindParam(':destination_message', $destination_messg);
	  $resultat->bindParam(':contenu_message', $contenu_messg);
	  $resultat->bindParam(':lu_message', $lu_mssg);
	 	 //var_dump($resultat);
	 	 if(!$insertion = $resultat->execute()) {
	 		 echo "L'inscription n'a pu être effectuée ";
	 		 /*$resultat->debugDumpParams();*/
	 	 }else{
	 	     echo "<script> window.location = 'Page_d_Messages.php';</script>" ;
	 	 }
		}
	}
}
function enregistrerMessageContact(){
	global $db;
	$source_messg =  $_SESSION['id_user'];

	$destination_messg = -1;
	$contenu_messg =  $_POST['contact_contenu'];
	$lu_mssg = 0 ;

		if(!empty($source_messg)  && !empty( $destination_messg) && !empty($contenu_messg ) ){

				$requete = "INSERT INTO messages(message_source,message_destination,message_contenu,message_lu) VALUES
				(:source_message,:destination_message,:contenu_message,:lu_message)";
		$resultat = $db->prepare($requete);
	  $resultat->bindParam(':source_message', $source_messg);
	  $resultat->bindParam(':destination_message', $destination_messg);
	  $resultat->bindParam(':contenu_message', $contenu_messg);
	  $resultat->bindParam(':lu_message', $lu_mssg);
	 	 //var_dump($resultat);
	 	 if(!$insertion = $resultat->execute()) {
	 		 echo "L'inscription n'a pu être effectuée ";
	 		 /*$resultat->debugDumpParams();*/
	 	 }
	}
}

function ajouterAuFavoris($id_user,$id_favori_fav,$favori_type){
	global $db;
	$user_id =  $id_user;
	$fav_favori_id =  $id_favori_fav;
	$type_favori =  $favori_type;
	if(!dejaFavoris($id_user,$id_favori_fav,$favori_type)){
		if(!empty($user_id)  && !empty( $fav_favori_id) && !empty($type_favori ) ){
			$requete = "INSERT INTO favoris(favori_user,favori_fav_id,favori_type) VALUES
			(:user_id,:fav_favori_id,:type_favori)";
			$resultat = $db->prepare($requete);
			$resultat->bindParam(':user_id', $user_id);
			$resultat->bindParam(':fav_favori_id', $fav_favori_id);
			$resultat->bindParam(':type_favori', $type_favori);
		}
		if(!$insertion = $resultat->execute()) {
	 	 echo "L'inscription n'a pu être effectuée ";
	  }
	}
}

function dejaFavoris($id_user,$id_favori_fav,$favori_type){
	global $db;
	$user_id =  $id_user;
	$fav_favori_id =  $id_favori_fav;
	$type_favori =  $favori_type;
	if(!empty($user_id)  && !empty( $fav_favori_id) && !empty($type_favori ) ){
		$requete = "SELECT * FROM favoris WHERE favori_user = :user_id AND favori_fav_id = :fav_favori_id AND favori_type =:type_favori";
		$resultat = $db->prepare($requete);
		$resultat->bindParam(':user_id', $user_id);
		$resultat->bindParam(':fav_favori_id', $fav_favori_id);
		$resultat->bindParam(':type_favori', $type_favori);
	}
	if($resultat->execute() && $results = $resultat->fetch(PDO::FETCH_ASSOC)){
		//retournee les resultats de la requêtes, en tableau assiociatif, sinon retourne faux.
		 if(count($results)>0){
			 	return true;
		 }else{
			 return false;
		 }
	 }
}

function getAnnoncesByFavorisID($id_user,$type){
	global $db;
	$user_id =  $id_user;
	$tabIdAnnonces = [];
	if(!empty($user_id) ){
		$requete = "SELECT favori_fav_id FROM favoris WHERE favori_user = :user_id AND favori_type = :type ";
		$resultat = $db->prepare($requete);
		$resultat->bindParam(':user_id', $user_id);
		$resultat->bindParam(':type', $type);
	}
	if($resultat->execute()){
		//retournee les resultats de la requêtes, en tableau assiociatif, sinon retourne faux.
		while($results = $resultat->fetch(PDO::FETCH_ASSOC)){
					 $tabIdAnnonces [] = $results;
		}
		return $tabIdAnnonces;
	 }
	 return [];
}

function filterAnnonces($tablesAnnoces,$tabIDs,$type_favori){
	$annonces = [];
	if($type_favori == 'annocesFavoris'){
		$colonne_id = 'annonce_id';
	}else{
		$colonne_id = 'user_id';
	}

	foreach ($tablesAnnoces as $keyA => $val) {
		foreach ($tabIDs as $key => $value) {
			if($tablesAnnoces[$keyA][$colonne_id] == $tabIDs[$key]['favori_fav_id'] ){
				$annonces [] = $tablesAnnoces[$keyA];
			}
		}
	}
	return $annonces;
}


function supprimerFavori($id_user,$id_favori_fav,$favori_type){
	global $db;
	if (dejaFavoris($id_user,$id_favori_fav,$favori_type)){
		$user_id =  $id_user;
		$fav_favori_id =  $id_favori_fav;
		$type_favori =  $favori_type;
		$requete = "DELETE FROM favoris WHERE favori_user = :user_id AND favori_fav_id = :fav_favori_id AND favori_type =:type_favori";
		$resultat = $db->prepare($requete);
		$resultat->bindParam(':user_id', $user_id);
		$resultat->bindParam(':fav_favori_id', $fav_favori_id);
		$resultat->bindParam(':type_favori', $type_favori);
		if(!$resultat->execute()) "Echec de suppression";
		if($favori_type=='annonce'){
			//header("Location: page_listing_annonces.php?set_favoris=true");
			echo "<script> window.location = 'page_listing_annonces.php?set_favoris=true';</script>" ;
		}
		if($favori_type=='user'){
			//header("Location: Page_d_accueil.php?set_favoris=true");
			echo "<script> window.location = 'Page_listing_utilisateurs.php?set_favoris=true';</script>" ;
		}
	}
}


function redirection($table){
	if ($table == "users"){
		echo "<script> window.location = 'Page_d_Admin.php?table=Users&motif=affichage';</script>" ;
	}
	if ($table == "annonces"){
		echo "<script> window.location = 'Page_d_Admin.php?table=Annonces&motif=affichage';</script>" ;
	}
	if ($table == "favoris"){
		echo "<script> window.location = 'Page_d_Admin.php?table=Favoris&motif=affichage';</script>" ;
	}
	if ($table == "messages"){
		echo "<script> window.location = 'Page_d_Admin.php?table=Messages&motif=affichage';</script>" ;
	}

}
function getConversationsById($destination_id){
	global $db;
	$id_source = $_SESSION['id_user'] ;
	/*$id_destination = $destination_id;*/
	$id_destination = $destination_id;
	$requete = "SELECT * FROM messages WHERE message_source = :source_id AND message_destination = :destination_id OR message_source =:destination_id AND message_destination =:source_id  ";
	$resultat = $db->prepare($requete);
	$resultat->bindParam(':source_id',$id_source);
	$resultat->bindParam(':destination_id',$id_destination);
	$tabMessages = [];
	if(!$insertion = $resultat->execute()){	echo "Opération échouée "; }//		$resultat->debugDumpParams()
	else{
		//echo "fefe";
		while($results = $resultat->fetch(PDO::FETCH_ASSOC)){
					 $tabMessages [] = $results;
		}
		return $tabMessages;
	}
}

function changerCles($array){
	global $db;
		$arr = [];
		foreach($array as $key=> $value){
			$arr[$array[$key]['message_source']] = $array[$key];
		}
		return $arr;
}


function getUSerById($id,$recherche,$table){
	global $db;
	//$requete = "SELECT ".$recherche. " FROM ". $table;

	$requete = "SELECT * FROM users WHERE user_id = :id ";
	$resultat = $db->prepare($requete);
	$resultat->bindParam(':id',$id);
	$resultat->execute();
	//$resultat->debugDumpParams();
	if(!$insertion = $resultat->execute()) echo "Recherche echouée";
	else{

		return $resultat->fetch(PDO::FETCH_ASSOC);
	}
}

function modifierProfilUser(){
	global $db;

if(!empty ($_POST['user_Nom']) && !empty($_POST['user_Prenom'])  && !empty($_POST['user_Pseudonyme'])
&& !empty($_POST['user_Gendre']) && !empty($_POST['user_Metier']) && !empty($_POST['user_Mot_de_passe'])
&& !empty($_POST['user_Adresse']) && !empty($_POST['user_Email']) && !empty($_POST['user_Ville'])
&& !empty($_POST['user_Region']) && !empty($_POST['user_Date_de_naissance']) && !empty($_POST['user_Numero_portable'])
&& !empty($_POST['user_Message']) && !empty ($_FILES['user_Image'])

){

	$nom = $_POST['user_Nom'];
	$prenom = $_POST['user_Prenom'];
	$pseudonyme = $_POST['user_Pseudonyme'];
	$gendre = $_POST['user_Gendre'];
	$metier = $_POST['user_Metier'];
	$mot_de_passe = password_hash($_POST['user_Mot_de_passe'],PASSWORD_BCRYPT);
	$adresse = $_POST['user_Adresse'];
	$email = $_POST['user_Email'];
	$ville = $_POST['user_Ville'];
	$region = $_POST['user_Region'];
	$date_de_naissance = $_POST['user_Date_de_naissance'];
	$numero_portable = $_POST['user_Numero_portable'];
	$message = $_POST['user_Message'];
	$id_user = $_SESSION['id_user'];
	$image_profil = "users/".$id_user."/"."photoprofil/".$_FILES['user_Image']['name'];


		$requete = "UPDATE users SET user_nom=:nom, user_prenom=:prenom,user_pseudonyme=:pseudonyme,user_email=:email,user_password=:password,user_date_naissance=:date_naissance,
		 user_ville=:ville,user_adresse=:adresse,user_region=:region,user_telephone=:telephone,user_metier=:metier,user_message_profil=:message_profil,user_img_profil=:img_profil,user_genre=:genre
		 WHERE user_id = :id_user ";

  $resultat = $db->prepare($requete);
  $resultat->bindParam(':nom', $nom);
  $resultat->bindParam(':prenom', $prenom);
  $resultat->bindParam(':pseudonyme', $pseudonyme);
  $resultat->bindParam(':genre', $gendre);
  $resultat->bindParam(':password', $mot_de_passe);
  $resultat->bindParam(':date_naissance', $date_de_naissance);
  $resultat->bindParam(':ville', $ville);
  $resultat->bindParam(':adresse', $adresse);
  $resultat->bindParam(':email', $email);
  $resultat->bindParam(':region', $region);
  $resultat->bindParam(':telephone', $numero_portable);
  $resultat->bindParam(':metier', $metier);
  $resultat->bindParam(':message_profil', $message);
  $resultat->bindParam(':img_profil', $image_profil);
  $resultat->bindParam(':id_user', $id_user);
		//var_dump($resultat);
		if(!$insertion = $resultat->execute()) {
			echo "L'inscription n'a pu être effectuée ";
			/*$resultat->debugDumpParams();*/
		}else{
			$pathDossierUSer ="users/".$id_user."/";
			if(!file_exists($pathDossierUSer)) mkdir($pathDossierUSer) ;  //on vérifie si le fichier existe déja
			//$pathDossierUSer ="users/".$dernier_id."/"."photoprofil/";

			sauvegarderImageProfil($id_user);
			if(!file_exists($pathDossierUSer."photoprofil")) mkdir($pathDossierUSer."photoprofil") ;  //on vérifie si le fichier existe déja
	}
}
echo "<script> window.location = 'Page_d_Profil.php';</script>" ;
}


function recherche($type_recherche,$recherche_mot,$id_user_recherche){
	global $db;
	$requete = "";
	$tab = []	;
	//La recherche pour la barre de recherche
	if($type_recherche == 'annonces'){
		$requete = "SELECT * FROM annonces  WHERE annonce_type LIKE '%$recherche_mot%' OR annonce_marque LIKE '%$recherche_mot%' ";
	}
	if($type_recherche == 'membres'){
	    $monId = $_SESSION['id_user'];
		$requete = "SELECT * FROM users  WHERE user_nom LIKE '%$recherche_mot%' OR user_prenom LIKE '%$recherche_mot%' OR user_pseudonyme LIKE '%$recherche_mot%' AND user_id != $monId  ";
  }
	if($type_recherche == 'localisation'){
		$requete = "SELECT * FROM users  WHERE user_ville LIKE '%$recherche_mot%' OR user_adresse LIKE '%$recherche_mot%' OR user_region LIKE '%$recherche_mot%' ";
  }
	//La recherche du catalogue dans la page profil
	if($type_recherche == 'femme' or $type_recherche == 'homme' ){
		if($type_recherche == 'femme'){
		    if($id_user_recherche == -1) {
		        $requete = "SELECT * FROM annonces  WHERE annonce_type LIKE '%$recherche_mot%' AND annonce_cible LIKE '%$type_recherche%'  ";
		    }else{
			$requete = "SELECT * FROM annonces  WHERE annonce_user = '$id_user_recherche' AND annonce_type LIKE '%$recherche_mot%' AND annonce_cible LIKE '%$type_recherche%'  ";
		    }
		}
		if($type_recherche == 'homme'){
		    if($id_user_recherche == -1) {
		        $requete = "SELECT * FROM annonces  WHERE  annonce_type LIKE '%$recherche_mot%' AND annonce_cible LIKE '%$type_recherche%' ";
		    }else{
		        $requete = "SELECT * FROM annonces  WHERE annonce_user = '$id_user_recherche' AND annonce_type LIKE '%$recherche_mot%' AND annonce_cible LIKE '%$type_recherche%' ";
		    }
		}
  }
	if(!empty($recherche_mot) && !empty($requete) ){
		if(strlen($recherche_mot) >= 2){
		    $resultat = $db->prepare($requete);
		    if($resultat->execute()){
			    while($results = $resultat->fetch(PDO::FETCH_ASSOC)){
	 							$tab [] = $results;
	 		     }
 		     }
		}
	}
	return $tab;
}

function messageAverfier($id_source,$id_destination){
	$messages = getMesMessagesEnCoursNonLus($id_source,$id_destination);
	$retour = false;
	if ($messages == NULL){
		$retour =  false;
	}else{
		$retour	= true;
	}
	return $retour;
}
function getMesMessagesEnCoursNonLus($id_source,$id_destination){
	$req = "SELECT * FROM messages WHERE message_source='$id_source' AND message_destination='$id_destination' AND message_lu='0'";

	$messages = NULL;
	$messages = getTable($req);
	//die();
	return $messages;
}

function mettreAJourMesagesEncours($id_message,$etat_message){
	global $db;
	$requete = "UPDATE messages SET message_lu=:etat_message
	 WHERE message_id=:id_message ";
	 $resultat = $db->prepare($requete);
	 $resultat->bindParam(':etat_message', $etat_message);
	 $resultat->bindParam(':id_message', $id_message);
	 if(!$insertion = $resultat->execute()){
		 echo "Opération échouée ";
	 }
}






 ?>
