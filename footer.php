			<!-- footer -->
			<footer class="footer" role="contentinfo">

				<!-- copyright -->
				<p class="copyright">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'boca'); ?>
					<a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="//boca.com" title="HTML5 Blank">HTML5 Blank</a>.
				</p>
				<!-- /copyright -->

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<script>

		/* Bobounce */

			$.fn.loopingAnimation = function(props, dur, eas) {

				  if (this.data('loop') === true)
				    {
				       this.animate( props, dur, eas, function() {
				           if( $(this).data('loop') === true ) $(this).loopingAnimation(props, dur, eas);
				       });
				    }

				    return this;
			};

			$(".bobounce").hover(function(){
				     $(this).data('loop', true).stop().loopingAnimation({ 'margin-top': '-20px'}, 300).loopingAnimation({'margin-top':'2%'},300);
				}, function(){
				     $(this).data('loop', false);
			});


		var isHome = "<?php if (is_home()) { ?>";

		jQuery(document).ready(function($) {
			$('#slider').bjqs({
				'width' : 960,
				'height' : 400,
				'animtype' : 'slide',
				'animspeed' : 2000,
				'hoverpause' : true,
				'showcontrols' : false
			});
		});

		jQuery(document).ready(function($) {
			$('#noticias').bjqs({
				'width' : 480,
				'height' : 160,
				'animtype' : 'slide',
				'animspeed' : 2000,
				'hoverpause' : true,
				'showcontrols' : true,
				'showmarkers' : false,
				'centercontrols' : false,
				'nexttext' : 'próximo',
				'prevtext' : 'anterior'
			});
		});

		/* Single Page */

		jQuery(document)
		.on('click', 'a[href*="#"]', function(){
			if(this.hash){
				jQuery.bbq.pushState('#/' + this.hash.slice(1));
				return false;
			}
		})

		.ready(function(){
			jQuery(window).bind('hashchange', function(event){
				var tgt = location.hash.replace(/^#\/?/,'');
				if(document.getElementById(tgt)){
					jQuery("html, body").stop().animate({ scrollTop: jQuery('#' + tgt).offset().top - 100}, 500);
				}
			});
		});

		/* mostrar menu */
			$window = jQuery(window);
			jQuery(window).scroll(function(){
				var scrolled = $window.scrollTop();
				function limpaTudoMenosO (tgt) {
					jQuery(".header").slideDown("fast");
					jQuery("#menu-fixo-paginas li a").css('color', 'white');
					jQuery("#menu-fixo-paginas li a#item-" + tgt).css('color', '#9dbf57');
				}

				function limpaTudo () {
					jquery("#menu-fixo-paginas li a").css('color', 'white');
				}

				if      (scrolled >= 2900) limpaTudoMenosO ("contato") ;
				else if (scrolled >= 2300) limpaTudoMenosO ("mapa") ;
				else if (scrolled >= 1500) limpaTudoMenosO ("sobre") ;
				else if (scrolled >= 700)  limpaTudoMenosO ("cardapio") ;
				else if (scrolled >= 200)  limpaTudoMenosO ("home") ;
				else jQuery(".header").fadeOut("fast") ;

			});

		var closeIf = "<?php }; ?>";

		/* analytics
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview'); */

		</script>

		<?php if (is_home()) { ?>
			<script src="/boca/wp-content/themes/boca/assets/mapa.js"></script>
		<?php } ?>

	</body>
</html>
