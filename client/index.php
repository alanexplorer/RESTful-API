<?php

  $json = "";

  if(isset($_POST['btn-signup'])){

    $adress = $_POST['txt_url'];

    switch ($_POST['txt_metodo']) {
      case 1:
          $json = json_decode(file_get_contents($adress,true));
          break;
      case 2:
          echo $json;
          break;
      case 3:
          echo $json;
          break;
      case 4:
          echo $json;
          break;
      }
  }

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport">
    <meta name="description" content="">
    <meta name="Alan Pereira da Silva" content="Cliente do Servidor RESTful">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">
  </head>

  <body class="badge-light" >
  	<div class="container">
  			 <div class="text-center">
         		</div>
             <form class="needs-validation jumbotron" novalidate method="post">
               <p class="lead">Faça sua requisição para o servidor RESTful</p>
             <!-- form line 1 -->
                       <div class="form-row">
                           <div class="col-sm-2 mb-3">
                             <select class="custom-select" id="txt_metodo" required name="txt_metodo">
                                <option value="1">GET</option>
                                <option value="2">POST</option>
                                <option value="3">PUT</option>
                                <option value="4">DELETE</option>
                              </select>
                           </div>
                           <div class="col-sm-8 mb-3">
                             		<input type="text" class="form-control" id="txt_url" value="" required name="txt_url">
                             		<div class="invalid-feedback">
                               		Digite um endereço para a requisição !
                             		</div>
                           </div>
                           <div class="col-sm-2 mb-3">
                                 <button class="btn btn-primary" type="submit" name="btn-signup">Ir</button>
                           </div>
                     </div>
               <!-- fim form line 1 -->
  						 <!-- form line 2 -->
                       <div class="form-row">
  											 <div class="col-sm-6 mb-3">
  	                        <textarea class="form-control rounded-0" name="txt_set" rows="15"></textarea>
  	                     </div>
                         <div class="col-sm-6 mb-3">
                            <textarea class="form-control rounded-0" id="txt_get" rows="15" disabled><?php print_r($json); ?></textarea>
                         </div>
                     </div>
               <!-- fim form line 2 -->
                 <hr>
               </form>
                   <script>
   				// Example starter JavaScript for disabling form submissions if there are invalid fields
   				(function() {
   				  'use strict';
   				  window.addEventListener('load', function() {
   					// Fetch all the forms we want to apply custom Bootstrap validation styles to
   					var forms = document.getElementsByClassName('needs-validation');
   					// Loop over them and prevent submission
   					var validation = Array.prototype.filter.call(forms, function(form) {
   					  form.addEventListener('submit', function(event) {
   						if (form.checkValidity() === false) {
   						  event.preventDefault();
   						  event.stopPropagation();
   						}
   						form.classList.add('was-validated');
   					  }, false);
   					});
   				  }, false);
   				})();
   				</script>
            <!-- InstanceEndEditable -->
      </div>
  </body>
</html>
