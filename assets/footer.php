<?php

$data = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "footer", "levi");
$columns = calc_footer_columns($data);

?>

<!-- FOOTER START //-->
<footer>
    <div class="container">
        <div class="row g-0">
            <?php if (array_key_exists("destinations", $data) && !empty($data["destinations"])) { ?>

                <div class="col-12 col-sm-12 col-md-<?php echo $columns; ?>">

                    <h6 class="title text-center">
                        <?php if (array_key_exists("title", $data["destinations"][0])) {
                            echo $data["destinations"][0]["title"];
                        } ?>
                    </h6>
                    <ul>

                        <?php foreach ($data["destinations"][0]["elements"] as $destination) { ?>

                            <li class="align-self-center">
                                <a href="destinations.php?id=<?php echo $destination['id']; ?>">
                                    <h4><?php echo ucfirst(strtolower($destination['label'])); ?></h4>
                                </a>
                            </li>

                        <?php } ?>

                    </ul>
                </div>

            <?php }
            if (array_key_exists("contacts", $data) && !empty($data["contacts"])) { ?>

                <div class="col-12 col-sm-12 col-md-<?php echo $columns; ?>">

                    <?php if (array_key_exists("phone", $data["contacts"][0]) && !empty($data["contacts"][0]["phone"])) { ?>

                        <h6 class="title text-center"><?php echo $data["contacts"][0]["phone"]["title"]; ?></h6>
                        <ul id="contact-us">

                            <li class="align-self-center"><a href="tel:<?php echo $data["contacts"][0]["phone"]["text"]; ?>">
                                    <h4><?php echo $data["contacts"][0]["phone"]["text"]; ?></h4>
                                </a>
                            </li>

                        </ul>

                    <?php }
                    if (array_key_exists("email", $data["contacts"][0]) && !empty($data["contacts"][0]["email"])) { ?>

                        <h6 class="title text-center"><?php echo $data["contacts"][0]["email"]["title"]; ?></h6>
                        <ul>

                            <li class="align-self-center"><a href="mailto:<?php echo $data["contacts"][0]["email"]["text"]; ?>">
                                    <h4><?php echo ($data["contacts"][0]["email"]["text"]); ?></h4>
                                </a>
                            </li>

                        </ul>

                    <?php } ?>

                </div>

            <?php }
            if (array_key_exists("other_infos", $data) && !empty($data["other_infos"])) { ?>

                <div class="col-12 col-sm-12 col-md-<?php echo $columns; ?>">

                    <?php if (array_key_exists("social_media", $data["other_infos"][0]) && !empty($data["other_infos"][0]["social_media"])) { ?>

                        <h6 class="title text-center"><?php echo $data["other_infos"][0]["social_media"]["title"]; ?></h6>
                        <ul id="follow-us">

                            <li class="align-self-center">

                                <?php foreach ($data["other_infos"][0]["social_media"]["elements"] as $social) { ?>

                                    <a href="<?php echo $social['href']; ?>" target="_BLANK">
                                        <i class="<?php echo $social['icon']; ?>"></i>
                                    </a>

                                <?php } ?>

                            </li>

                        </ul>

                        <?php if (array_key_exists("useful_links", $data["other_infos"][0]) && !empty($data["other_infos"][0]["useful_links"])) { ?>

                            <h6 class="title text-center">Link utili</h6>
                            <ul>

                            <?php }
                        foreach ($data["other_infos"][0]["useful_links"]["elements"] as $link) { ?>

                                <li class="align-self-center">
                                    <a href="<?php echo constant('PDF_DIR') . DIRECTORY_SEPARATOR . $link['href']; ?>" download>
                                        <h4><?php echo $link['label']; ?></h4>
                                    </a>
                                </li>
                            <?php } ?>
                            </ul>
                        <?php } ?>
                </div>
        </div>
    <?php } ?>
    </div>
</footer>
<!-- FOOTER END //-->