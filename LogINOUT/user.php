<?php
session_start();

if(!isset($_SESSION['email'])){
    header('location: login.php');
}

?>
<!DOCTYPE html>
<hmtl lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name = "Homepage" content = "Homepage">
        <title>Booking Appointment System</title>

        <!-- CSS -->
        <link href="testing.css" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>


    <body>
        <!-- Nav bar -->
        <?php include("includes/navbar.php"); ?>

        <!-- Introduction row -->
        <div class = "row col-12 mx-auto shadow">
            <div class = "col xcol col-after">
                <br><br><br>
                <h1> 
                    Succulent-Plant Kuching
                </h1>
                <h3>
                    Live Love Laugh
                </h3>
                <br>
                <h4 style="padding-right: 100px;">
                    Cacti-Succulent Kuching is a locally owned and operated company 
                    that specializes in selling a wide variety of succulent plants and related products. 
                    Affordably priced succulent plants of all types and sizes 
                    as well as gardening tools, soils, and fertilizers are available.
                </h4>
                <br>
                <button type="button" class="rounded-pill" >
                    Visit us
                </button>
            </div>
            <div class ="col" style="padding: 0">
                <img src="images/bg.jpg" alt="background" style="width: 100%; padding: 0;">
            </div>
        </div>  

        <!-- Promotion text -->
        <br><br>
        <h2 class="text-center" style="padding:0; margin:0;">Promotions</h2>

        <!-- Promotion container - cards -->
        <div class="row col-12 row-cols-1 row-cols-md-4  g-5" style="margin:0;">
        

            <div class="col">
                <div class="card h-100">
                    <img src="Homepage_Images/promo_plant1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rickrack Cactus</h5>
                        <h6 class="card-subtitle mb-2 text-muted fst-italic">
                            Selenicereus anthonyanus
                        </h6>
                        <!-- <div class="col-12 card-text row"><div class="col-3 text-decoration-line-through text-left">$200</div><div class="col-9 text-danger" style="padding-left: 0">50%</div></div> -->
                        <h6 class="text-decoration-line-through">$200 <small class="text-danger">50%</small></h6>
            
                        <p class="card-text">$100</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="Homepage_Images/promo_plant2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rickrack Cactus</h5>
                        <h6 class="card-subtitle mb-2 text-muted fst-italic">
                            Selenicereus anthonyanus
                        </h6>
                        <div class="col-12 card-text row"><div class="col-3 text-decoration-line-through text-left">$200</div><div class="col-9 text-danger" style="padding-left: 0">50%</div></div>
                        

                        <p class="card-text">$100</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="Homepage_Images/promo_plant3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rickrack Cactus</h5>
                        <h6 class="card-subtitle mb-2 text-muted fst-italic">
                            Selenicereus anthonyanus
                        </h6>
                        <div class="col-12 card-text row"><div class="col-3 text-decoration-line-through text-left">$200</div><div class="col-9 text-danger" style="padding-left: 0">50%</div></div>
                        

                        <p class="card-text">$100</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="Homepage_Images/promo_plant4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rickrack Cactus</h5>
                        <h6 class="card-subtitle mb-2 text-muted fst-italic">
                            Selenicereus anthonyanus
                        </h6>
                        <div class="col-12 card-text row"><div class="col-3 text-decoration-line-through text-left">$200</div><div class="col-9 text-danger" style="padding-left: 0">50%</div></div>
                        

                        <p class="card-text">$100</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="Homepage_Images/promo_plant5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rickrack Cactus</h5>
                        <h6 class="card-subtitle mb-2 text-muted fst-italic">
                            Selenicereus anthonyanus
                        </h6>
                        <div class="col-12 card-text row"><div class="col-3 text-decoration-line-through text-left">$200</div><div class="col-9 text-danger" style="padding-left: 0">50%</div></div>
                        

                        <p class="card-text">$100</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="Homepage_Images/promo_plant6.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rickrack Cactus</h5>
                        <h6 class="card-subtitle mb-2 text-muted fst-italic">
                            Selenicereus anthonyanus
                        </h6>
                        <div class="col-12 card-text row"><div class="col-3 text-decoration-line-through text-left">$200</div><div class="col-9 text-danger" style="padding-left: 0">50%</div></div>
                        

                        <p class="card-text">$100</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="Homepage_Images/promo_plant6.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rickrack Cactus</h5>
                        <h6 class="card-subtitle mb-2 text-muted fst-italic">
                            Selenicereus anthonyanus
                        </h6>
                        <div class="col-12 card-text row"><div class="col-3 text-decoration-line-through text-left">$200</div><div class="col-9 text-danger" style="padding-left: 0">50%</div></div>
                        

                        <p class="card-text">$100</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <img src="Homepage_Images/promo_plant6.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rickrack Cactus</h5>
                        <h6 class="card-subtitle mb-2 text-muted fst-italic">
                            Selenicereus anthonyanus
                        </h6>
                        <div class="col-12 card-text row"><div class="col-3 text-decoration-line-through text-left">$200</div><div class="col-9 text-danger" style="padding-left: 0">50%</div></div>
                        

                        <p class="card-text">$100</p>
                    </div>
                </div>
            </div>     
        </div>
        

        <br><br>
        <h2 class="text-center why-choose-us" style="font-family: 'Untitled Serif',Georgia,Moderat,Helvetica Neue,Helvetica,Arial,sans-serif; font-weight: 700; font-style: normal; text-rendering: optimizeLegibility; padding-top: 50px; padding-bottom: 50px; margin-bottom: 0px;">Why choose us?</h2>

        <div class="row col-12 row-cols-1 row-cols-md-4  g-5" style="margin:0;">
            <div class="col">
                <div class="card h-100 border-0">
                <!-- <img src="Homepage_Images/promo_plant1.jpg" class="card-img-top" alt="..."> -->
                    <img alt="icon" src="https://res.cloudinary.com/patch-gardens/image/upload/c_scale,h_144,q_auto:good,w_144/v1/cms/SVG_Quality_illustration.svg">                                                                                                                                            
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Best Quality
                        </h5>
                        <h6 class="card-subtitle mb2 text-muted text-center">
                            The plants are all carefully nourished by our excellent team. With the outmost care, comes with the outmost quality.
                        </h6>
                    </div>
                
                </div>

            </div>
        </div>





    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>








</hmtl>