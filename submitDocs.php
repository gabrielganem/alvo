<?php header('Content-Type: text/html; charset=utf-8');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ALVO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="public/bootstrap/css/prettify.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">
   <!-- <link href="css/docs.css" rel="stylesheet"-->


</head>
<body>
<?php include('elements/navigation.php');?>
<?php include('elements/sidebar.php');?>
<div class="container" style="float:right;">
	<div class="row">
		<div class="col-xs-11">
		<h1>Submissão de Documentos</h1>
			<form action="app/upload.php" id="myForm" method="POST" enctype="multipart/form-data" >
				<div class="col-xs-9">
					<input type="text" name="titulo" class="form-control input-hg" placeholder="Titulo do Documento"/>
					<div class="form-group">
					  <input type="file" name="arquivo" class="form-control input-hg" />
					  <span class="input-icon fui-plus"></span>
					</div>
				</div>
				<div class="col-xs-2">
					<button class="btn btn-hg btn-primary glyphicon glyphicon-arrow-up" style="font-size:65px;"></button>
				</div>
			</form>
		</div>
	</div>
		<div class="col-xs-11">
		<?php $i=0;while($i<20){?>
			<div class="col-xs-2">
				<div class="tile" style="margin:5px;">
					<i class="tile-image glyphicon glyphicon-file" style="font-size:65px;margin-bottom:0;"></i>
					<h3 class="tile-title">Arquivo</h3>
					<p>Usuario Dono</p>
				  </div>
			</div>
		<?php $i++;} ?>
		</div>
      </div>
	
	
</div>
	<script scr="public/js/jquery-1.8.3.min.js"></script>
    <script scr="public/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script scr="public/js/jquery.ui.touch-punch.min.js"></script>
    <script scr="public/js/bootstrap.min.js"></script>
    <script scr="public/js/bootstrap-select.js"></script>
    <script scr="public/js/bootstrap-switch.js"></script>
    <script scr="public/js/flatui-checkbox.js"></script>
    <script scr="public/js/flatui-radio.js"></script>
    <script scr="public/js/jquery.tagsinput.js"></script>
    <script scr="public/js/jquery.placeholder.js"></script>
    <script scr="public/js/typeahead.js"></script>
    <script src="bootstrap/js/google-code-prettify/prettify.js"></script>
    <script scr="public/js/application.js"></script>

</body>
</html>