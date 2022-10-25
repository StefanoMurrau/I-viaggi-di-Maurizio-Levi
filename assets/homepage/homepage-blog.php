<?php

$blog_contents = array(
    array(
        "title" => "Venezia Autentica",
        "image"=> "https://blog.therebelwatchtower.info/wp-content/uploads/2022/07/Venezia_Piazza-San-Marco.jpg",
        "url" => "https://blog.therebelwatchtower.info/venezia-autentica/"
        ),
    array(
        "title" => "Una musica nell'Aires",
        "image"=> "https://blog.therebelwatchtower.info/wp-content/uploads/2022/07/Tango-abbraccio.-Foto-di-Roberto-Carretta.jpg",
        "url" => "https://blog.therebelwatchtower.info/una-musica-nellaires/"
        ),
    array(
        "title" => "La sorprendente Eivissa",
        "image"=> "https://blog.therebelwatchtower.info/wp-content/uploads/2022/06/ibiza-2734874_1280-1.jpg",
        "url" => "https://blog.therebelwatchtower.info/la-sorprendente-eivissa/"
        )
    ) ;

    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "homepage-blog", "levi") ;
?>

<?php



?>

	<!-- BLOG START //-->
	<?php if( array_key_exists("blog", $data) && !empty($data["blog"]) ){ ?>
		<section id="blog">
			<div class="container">
					<div class="row g-0 mb-5">
						<div class="col-12 col-sm-12 text-center mx-auto mb-3">
							<p class="payoff">News</p>
							<h2 class="title">Care <span class="accent">Viaggiatrici</span><br/>Cari <span class="accent">Viaggiatori</span></h2>
						</div>
					</div>
					<div class="row row-cols-1 row-cols-md-3 g-4">

						<?php foreach ($blog_contents as $blog_content) { ?>

							<div class="col">
								<div class="card h-100">
									<img src="<?php echo $blog_content['image']; ?>" class="card-img-top" alt="<?php echo $blog_content['title']; ?>">
									<div class="card-body">
										<p class="card-text"><?php echo $blog_content['title']; ?></p>
									</div>
									<div class="card-footer text-center">
										<a target="_BLANK" href="<?php echo $blog_content['url']; ?>" >
											<button type="submit" class="levi-primary-btn">Scopri di più</button>
										</a>
									</div>
								</div>
							</div>

						<?php } ?>  

					</div>

			</div>
		</section>
        <?php } ?>
<!-- BLOG END //-->
