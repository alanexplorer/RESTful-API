<?php
  require_once 'phplot/phplot.php';

  $json = "";

  if(isset($_POST['btn-signup'])){

    $url = $_POST['txt_url'];
    $arr = $_POST['txt_set'];

    switch ($_POST['txt_metodo']) {
      case 1:
          $ch = curl_init();
          curl_setopt( $ch, CURLOPT_URL, $url);
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
          $json = curl_exec($ch);
          curl_close($ch);
          break;
      case 2:
          $ch = curl_init($url);
          curl_setopt( $ch, CURLOPT_POSTFIELDS, $arr );
          curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
          $json = curl_exec($ch);
          curl_close($ch);
          $json = "Requisição POST enviado para o Bando de Dados\n\n".print_r(json_decode($arr), true);
          break;
      case 3:
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
          curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
          $response = curl_exec($ch);
          curl_close($ch);

          if($response){
            $json = "Requisição PUT enviado, o banco de dados foi atualizado";
          }
          break;
      case 4:
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
          curl_exec($ch);
          $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          curl_close($ch);
          $json = "Consulta Deleta do Bando de Dados";
          break;
      case 5:

          $ch = curl_init();
          curl_setopt( $ch, CURLOPT_URL, $url);
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
          $file = curl_exec($ch);
          $json = json_decode($file, true);
          curl_close($ch);
          $media = $json['Media'];
          $mediana = $json['Mediana'];
          $maximo = $json['Maximo'];
          $minimo = $json['Minimo'];
          $desvio = $json['Desvio'];
          $q1 = $json['Q1'];
          $q3 = $json['Q3'];


          $data = array(array('', 3,  $minimo, $q1, $media, $q3, $maximo));

          $plot = new PHPlot(400, 600);
          $plot->SetTitle('Consulta');
          $plot->SetDataType('data-data');
          $plot->SetDataValues($data);
          $plot->SetPlotType('boxes');
          $plot->SetImageBorderType('plain');
          $plot->SetLineStyles('dashed');
          $plot->SetLineWidths(array(3, 3, 1));
          $plot->SetDataColors(array('blue', 'blue', 'red', 'blue'));
          $plot->SetPointShapes('star');
          $plot->DrawGraph();


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
                                <option value="5">BOXPLOT</option>
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
  	                        <textarea class="form-control rounded-0" name="txt_set" rows="15" placeholder=""></textarea>
  	                     </div>
                         <div class="col-sm-6 mb-3">
                            <textarea class="form-control rounded-0" id="txt_get" rows="15" disabled><?php echo $json; ?></textarea>
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
