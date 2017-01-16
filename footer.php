<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aeris
 */

?>

	<footer>
	    <!-- <address>
	        OBSERVATOIRE MIDI-PYRENEES<br>
	        14, avenue Edouard Belin - 31400 TOULOUSE<br>
	        Tél. +33 (0)5 61 33 29 29<br>
	        Fax : +33 (0)5 61 33 28 88<br>
	    </address> -->
	    <section>
	        <p>© Copyright Pôle Aeris 2016 - Service de données OMP (SEDOO)</p>
	    </section>
	    <section role="tutelles">
	        <figure>
	            <a href="http://http://www.ac-toulouse.fr/" title="Lien vers le site de l'Académie de Toulouse">
	                <img src="<?php bloginfo( 'template_url' ); ?>/images/ac-toulouse_logo.jpg" alt="">
	            </a>
	            <figcaption>
	                <a href="http://http://www.ac-toulouse.fr/" title="Lien vers le site de l'Académie de Toulouse">Académie de Toulouse</a>
	            </figcaption>
	        </figure>
	        <figure>
	           <a href="http://www.univ-tlse3.fr" title="Lien vers le site de l'Université Paul Sabatier - Toulouse 3">
	                <img src="<?php bloginfo( 'template_url' ); ?>/images/logo_univ-tlse.png" alt="">
	            </a>
	            <figcaption>
	                <a href="http://www.univ-tlse3.fr" title="Lien vers le site de l'Université Paul Sabatier - Toulouse 3">Université Paul Sabatier - Toulouse 3</a>
	            </figcaption>
	        </figure>
	    </section>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
