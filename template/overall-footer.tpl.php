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
				speed: 800,
				max_row: 1,
				duration: 5000
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
	
		<!-- Piwik -->
		<script type="text/javascript">
			var _paq = _paq || [];
			_paq.push(['trackPageView']);
			_paq.push(['enableLinkTracking']);
			(function() {
				var u="//piwik.reggid213.net/";
				_paq.push(['setTrackerUrl', u+'piwik.php']);
				_paq.push(['setSiteId', 1]);
				var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
				g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
			})();
		</script>
		<noscript><p><img src="//piwik.reggid213.net/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
		<!-- End Piwik Code -->
	</body>

</html>
