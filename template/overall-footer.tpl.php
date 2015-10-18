   </section>
		
		<?php require_once 'footer.tpl.php'; ?>
	
		<script src="<?php echo BASEPATH; ?>/libs/jquery-2.1.3.min.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/ckeditor/ckeditor.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/newsTicker.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/lightbox/js/lightbox.min.js"></script>
		
		<script>
						
			$('#newsticker').newsTicker({
				row_height: 42,
				max_rows: 2,
				duration: 10000
			});
		
			var roxyFileman = 'libs/fileman/index.html'; 
			$(function(){
				CKEDITOR.replace( 'desc_long',{
					filebrowserBrowseUrl:roxyFileman,
					filebrowserImageBrowseUrl:roxyFileman+'?type=image',
					removeDialogTabs: 'link:upload;image:upload'
				}); 
			});

		</script>
	
	
	</body>

</html>
