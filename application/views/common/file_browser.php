

<!DOCTYPE html>
<html>
<?php //$this->load->view('common/head'); ?>
<head>
	<title> File Browser</title>
	<style type="text/css">
		body {
			font-family: 'Sogoe UI', Verdana, Helvetica, sans-serif;
			font-size: 80%;
		}

		#form{
			width: 600px;
		}

		#folderExplorer {
			float: left;
			width: 100px;
		}

		#fileExplorer {
			float: left;
			width: 680px;
			border-left: 1px solid #dff0ff;
		}

		.thumbnail {
			float: left;;
			margin: 3px;
			padding: 3px;
			border: 1px solid #dff0ff;
		}

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}

		li {
			padding: 0;
		}
	</style>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function (){
			var funcNum = <?php echo $_GET['CKEditorFuncNum'].';'; ?>
			$('#fileExplorer').on('click','img',function(){
				var fileUrl = $(this).attr('title');
				window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
				window.close();
			}).hover(function(){	
				$(this).css('cursor','pointer');
			});

		});
	</script>
</head>

<body>
	<div id="fileExplorer">
		<?php foreach ($fileList as $fileName) { ?>
			<div class="thumbnail">
				<img src="<?php echo base_url().$fileName ?>" alt="thumb" title="<?php echo base_url().$fileName ?>" width="120" height="100">
				<br>
			</div>
		<?php } ?>
	</div>

</body>
</html>