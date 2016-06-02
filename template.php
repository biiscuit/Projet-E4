<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mon Site - <?= $titrePage ?> </title>
 	<meta name="viewport" content="width=device-width, initial-scale=1">

 	<link rel="stylesheet" href="style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body>

  <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Repair&Co</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($section=="0")?"class='active'":'' ?>><a href="index.php?section=0">Accueil</a></li>
            <li <?php echo ($section=="1")?"class='active'":'' ?>><a href="index.php?section=1">Catégories</a></li>
            <li <?php echo ($section=="2")?"class='active'":'' ?>><a href="index.php?section=2">Fournisseurs</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<?php if(isset($_SESSION['id_client'])){
          		?>
          	<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon Espace Perso <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="index.php?section=3&action=1">Mon Panier <?= count($_SESSION['panier']->getListeId()) == 0 ? '' : '- '.count($_SESSION['panier']->getListeId()) .' produit(s)' ?></a></li>
                <li><a href="index.php?section=3&action=2">Mes Factures</a></li>
                <li><a href="index.php?section=3&action=3">Mes Rendez-Vous</a></li>
              </ul>
            </li>
          	<li><a><form method="POST" style="display:inline;"><button style="background-color:transparent;border:none;" type="submit" name="deconnexion">Déconnexion</button></form></a></li>
          	<?php 
          		}
          		else{
          	?>
          	<li><a type="button" class="btn" data-toggle="modal" data-target="#sign-in">Se Connecter</a></li>
			<li><a type="button" class="btn" data-toggle="modal" data-target="#sign-up">S'inscrire</a></li>
          	<?php 
          		}
          	?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

		<!-- Modal SIGN IN-->
		<div class="modal fade" id="sign-in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center" id="myModalLabel">Connexion</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
		      		<div class="col-md-12">
				        <form class="form-signin" method="POST">
					        <label for="inputEmail" class="sr-only">Adresse Mail</label>
					        <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Adresse Mail" required> <br/>
					        <label for="inputPassword" class="sr-only">Mot de Passe</label>
					        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Mot de Passe" required> <br/>
					        <button class="btn btn-md btn-primary btn-block" name="connexion" type="submit">Se Connecter</button>
					    </form>
					</div>
				</div>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal SIGN UP-->
		<div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title text-center" id="myModalLabel">Inscription</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
		      		<div class="col-lg-8 col-lg-push-2">
				        <form class="form-signin" method="POST">
				        	
				        	<b>Civilité :</b>
				        	<div class="radio-inline">
							  <label><input type="radio" name="gender" value="Mr" checked>Mr</label>
							</div>
							<div class="radio-inline">
							  <label><input type="radio" name="gender" value="Mlle">Mlle</label>
							</div>
							<div class="radio-inline">
							  <label><input type="radio" name="gender" value="Mme">Mme</label>
							</div>

				        	<label for="inputNom" class="sr-only">Nom</label>
					        <input type="text" id="inputNom" name="inputNom" class="form-control" placeholder="Nom" required> <br/>

					        <label for="inputPrenom" class="sr-only">Prénom</label>
					        <input type="text" id="inputPrenom" name="inputPrenom" class="form-control" placeholder="Prénom" required> <br/>

					        <label for="inputAdresse" class="sr-only">Adresse</label>
					        <input type="text" id="inputAdresse" name="inputAdresse" class="form-control" placeholder="Adresse" required> <br/>

					        <label for="inputVille" class="sr-only">Ville</label>
					        <input type="text" id="inputVille" name="inputVille" class="form-control" placeholder="Ville" required> <br/>

					        <label for="inputCP" class="sr-only">Code Postal</label>
					        <input type="text" id="inputCP" name="inputCP" maxlength="5" class="form-control" placeholder="Code Postal" required> <br/>

					        <label for="inputTel" class="sr-only">Téléphone</label>
					        <input type="tel" id="inputTel" name="inputTel" class="form-control" placeholder="Téléphone"> <br/>

					        <label for="inputEmail" class="sr-only">Adresse Mail</label>
					        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Adresse Mail" required> <br/>

					        <label for="inputPassword" class="sr-only">Mot de Passe</label>
					        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de Passe" required> <br/>

					        <label for="inputPassword2" class="sr-only">Mot de Passe</label>
					        <input type="password" id="inputPassword2" name="inputPassword2" class="form-control" placeholder="Vérification Mot de Passe" required> <br/>

					        <!-- FAIRE UN TEST: meme mot de passe et telephone correct et CP correct -->

					        <button class="btn btn-lg btn-primary btn-block" name="inscription" type="submit">S'inscrire</button>
					    </form>
					</div>
				</div>
		      </div>
		    </div>
		  </div>
		</div>

    	<!-- Main jumbotron for a primary marketing message or call to action -->
	    <div class="jumbotron">
	      <div class="container">
	        <?php echo $content; ?>
	      </div>
	    </div>

    <footer class="footer navbar-inverse">
      <div class="container text-center">
        <p> &copy Repair&co 2016.</p>
      </div>
    </footer>

        <!-- JavaScript bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>

</html>