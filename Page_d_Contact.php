<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="mycss/style.css" />
    <link rel="stylesheet" href="fonts/css/all.min.css" />

    <title>Page Contact</title>
  </head>
  <body>

    <div class="container" style="background-color:" >


      <!-- Navigation section-->
      <?php
      include 'header.php';
      //include 'RequetesSQL.php';
      if(isset($_POST['contact_submit'])){
        enregistrerMessageContact();
      }
       ?>

       <?php if(@$_GET['contact']) {?>
         <div class="espacement desc_panel" style="" >
           <div class="row">
             <div class="col-md-12 text-center" >
               <h2 class="section-heading text-uppercase">Contactez-Nous</h2>
               <p class="section-subheading text-muted">* * * Envoyer nous un message * * *</p>
             </div>
           </div>

           <form  action="#" method="POST" class="register-form"  >
            <div class="row">
              <div class="col-6 offset-3 ">
                <div class="form-group">
                  <textarea class="form-control"  placeholder="Saisir votre message *" name="contact_contenu" style="width:400px;height:400px"  data-validation-required-message="Saisir votre message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="row">
              <div class="col-6 offset-3 text-center">
                <div></div>
                <button class="btn btn-primary" name="contact_submit" type="Submit">Envoyer Message</button>
              </div>
            </div>

          </form>
     <?php }?>

      <?php if(@$_GET['infos']) {?>

       <section class="page-section espacement" id="qui_sommes_nous">
           <div class="row">
             <div class="col-lg-12 text-center">
               <h2 class="section-heading text-uppercase">Qui Sommes-Nous</h2>
               <p class="section-subheading text-muted">Equipe Clothes Troc</p>
             </div>
           </div>
           <div class="row">
             <div class="col-lg-12">
               <p class="text-left">
                <h1 class="title-left">Clothes Troc</h1>
                      <p class="text-left">
                        Un site de mise en relation entre des personnes qui sont géographiquement proches.
                        Cette mise en relation permet différents types de services:
                        En effet, il existe trois types de services :  </p>
                      <p> L'échange de vêtements  </p>
                      <p> Le don de vêtements  </p>
                      <p> La vente de vêtements </p>
               </p>
           </div>
         </div>
      </section>
    <!--fin du panel pour les vet -->
  <?php }?>
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
