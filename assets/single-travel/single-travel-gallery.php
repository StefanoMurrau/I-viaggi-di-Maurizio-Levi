<?php

    $id_viaggio = $_GET['id'] ;
  
    try 
        {
        $a = mc_get_img_gallery ('LEVI', $id_viaggio , 'viaggio' , $conn) ;
        $count = 0;
        for($i = 0; $i <= 5; $i++) 
            {
            $foto[$i] = $a[$i]['url_foto'] ;
            $count = $count + 1;
            }
        } 
    catch(Exception $e) 
        {
        //echo $e->getMessage() ;
        }


        if($count)
        {

?>     
       
            <!-- GALLERY START //-->
            <section id="gallery">
                <div class="container-fluid">
                    <div class="row g-2">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 gallery-img-container">
                            <div id="start" style="background-image:url('<?php echo $foto[0]; ?>')"></div>                     
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 gallery-img-container">
                            <div id="middle">
                                <div class="row gx-2">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="upper" style="background-image:url('<?php echo $foto[1]; ?>')"></div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="lower" style="background-image:url('<?php echo $foto[2]; ?>')"></div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="lower" style="background-image:url('<?php echo $foto[3]; ?>')"></div>
                                    </div>
                                </div>
                            </div>             
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 gallery-img-container">                     
                            <div id="end" style="background-image:url('<?php echo $foto[4]; ?>')"></div>             
                        </div>   
                    </div>
                </div>
            </section>
            <!-- GALLERY END //-->
<?php

        }

        ?>