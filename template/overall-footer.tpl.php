   </section>
		
		<?php require_once 'footer.tpl.php'; ?>
	
		<script src="<?php echo BASEPATH; ?>/libs/jquery-2.1.3.min.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/jquery-ui-1.11.4/jquery-ui.min.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/datepicker-de.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/jonthornton-jquery-timepicker-19a3380/jquery.timepicker.min.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/ckeditor/ckeditor.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/lightbox/js/lightbox.min.js"></script>
		<script src="<?php echo BASEPATH; ?>/libs/jquery.newsTicker.js"></script>
		
		<script>
			//jqueryui datepicker
			$('#date_picker').datepicker({
				inline: true,
				altField: '#event_date',
				dateFormat: 'yy-mm-dd',
				regional: 'de',
				defaultDate: new Date(<?php if ($eventId != 'new' && $eventId != null) echo $event -> getDate('jquery'); ?>)
			});
			
			$('#event_date').change(function(){
				$('#date_picker').datepicker('setDate', $(this).val());
			});	
			
			//timepicker
			$(function() {
				$('#event_time').timepicker({
					'timeFormat': 'H:i'
				});
			});

			var newsticker1 = $('#newsticker1 .newsitem').newsTicker({
				row_height: 100,
				speed: 800
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
