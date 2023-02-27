<style type="text/css">
	/*#form{
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
	}*/
	.thumbnail
	{
		display: inline-block;
	}
	#browse-image-panel
	{
		position: absolute;
		top: 20px;
		right: 10%;
		width: 80%;
		z-index: 10;
	}

/*	li {
		padding: 0;
	}*/
</style>
<script type="text/javascript">

	$(document).ready(function (){
		//var funcNum = <?php //echo $_GET['CKEditorFuncNum'].';'; ?>
		
		$('#fileExplorer').on('click','img',function(){
			var fileUrl = $(this).attr('title');
			$('#select-image').val(fileUrl);
			// window.close();
			$('#myModal').hide();
		}).hover(function(){	
			$(this).css('cursor','pointer');
		});

	});

	function close_browse(){
		$('#myModal').hide();
	}

</script>

<div id="browse-image-panel">
    <div class="panel" >
    	<div class="panel-heading">
            <h5 class="panel-title">
                browse image
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="close" onclick="close_browse()"></a></li>
                </ul>
            </div>
        </div>
		<div id="fileExplorer" >
			<?php foreach ($fileList as $fileName) { ?>
				<div class="thumbnail" class="col-sm-5">
					<img src="<?php echo base_url().'assets/images/gallery/'.$fileName->image ?>" alt="thumb" title="<?php echo $fileName->image ?>" style="width: 120px; height: 120px; border-radius: 2px;">
					<br>
				</div>
			<?php } ?>
		</div>
    </div>
</div>

