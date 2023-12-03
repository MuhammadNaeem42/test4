<?php 
session_start();
include "../include/DBconn.php";
?>

<?php

$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $subject = $_POST['subject'];
   $message = $_POST['message'];

   if (empty($name)) {
       $errors[] = 'Name is empty';
   }

   if (empty($email)) {
       $errors[] = 'Email is empty';
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[] = 'Email is invalid';
   }

   if (empty($subject)) {
    $errors[] = 'subject is empty';
}

   if (empty($message)) {
       $errors[] = 'Message is empty';
   }

   if (empty($errors)) {
       $toEmail = 'cskmarco123@gmail.com';
       $emailSubject = 'New email from your contact form';
       $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=utf-8'];
       $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
       $body = join(PHP_EOL, $bodyParagraphs);

       if (mail($toEmail, $emailSubject, $body, $headers)) 

           header('Location: Enquiry.php');
       } else {
           $errorMessage = 'Oops, something went wrong. Please try again later';
       }

   } else {

       $allErrors = join('<br/>', $errors);
       $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
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
        <link href="../style/.css" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>

    <body>
        <!-- Nav bar -->
        <div class="">
            <br><br><br>
            <?php include("../include/navigation.php"); ?>
        </div>
        <br><br><br>
        
        <!-- Contact form  -->

        <div class="row col-12 shadow mb-5" style="margin-left:0px;">
            <div class="col-7">
                <div class="row">
                    <h2 class="text-center mb-5">Contact us</h2>
                </div>


                <form method="POST" id="contact-form">
                    <div class="row">
                        <div class="col-5 mx-auto">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="First name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5 mx-auto">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="example@gmail.com">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5 mx-auto">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="subject">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-5 mx-auto">
                            <label class="form-label">Enquiry</label>
                            <textarea name ="message" class="form-control" placeholder="Please raise your enquiries here" rows="3"></textarea>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-5 mx-auto">
                            <button class="btn btn-danger" type="submit" value="Send">Send</button>
 

                        </div>
                    </div>
                    </div>
                    
                </form>
                

            <div class="col-5 mx-auto">
                <img src="Enquiry_Images/email.png" alt="Image" class="img-fluid">
            </div>

        </div>



        <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
           
        <script>
            const constraints = {
                name: {
                    presence: { allowEmpty: false }
                },
                email: {
                    presence: { allowEmpty: false },
                    email: true
                },
                message: {
                    presence: { allowEmpty: false }
                }
            };

            const form = document.getElementById('contact-form');

            form.addEventListener('submit', function (event) {
                const formValues = {
                    name: form.elements.name.value,
                    subject: form.elements.subject.value,

                    email: form.elements.email.value,
                    message: form.elements.message.value
                };

                const errors = validate(formValues, constraints);

                if (errors) {
                event.preventDefault();
                const errorMessage = Object
                    .values(errors)
                    .map(function (fieldValues) { return fieldValues.join(', ')})
                    .join("\n");

                alert(errorMessage);
                }
            }, false);
        </script>
        <!-- Business information -->
        <div class="row col-12 shadow mb-5" style="margin-left:0px;">
            <div class="row ">
                <h2 class="text-center mb-3">Business information</h2>
                <hr claas="" style="margin-right:0px;">
       
            </div>

                <?php
                $query = "SELECT * FROM enquiry_bi";
                $query_run = mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $enquiry_bi)
                    {
                        ?>

                        <div class="row ">
                            <div class="card h-100" style="border:0">
                                <h4 class="text-center">Outlet</h4>
                                <div class="card-body">
                                    <h5 class="text-center"><?php echo $enquiry_bi['BI_Outlet_name'];?></h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="card h-100" style="border:0">
                                <h4 class="text-center">Operating time</h4>
                                <div class="card-body">
                                    <h5 class="text-center"><?php echo $enquiry_bi['BI_operating_time'];?></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card h-100" style="border:0">
                                <h4 class="text-center">Phone number</h4>
                                <div class="card-body">
                                    <h5 class="text-center"><?php echo $enquiry_bi['BI_phoneNo'];?></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card h-100" style="border:0">
                                <h4 class="text-center">Email</h4>
                                <div class="card-body">
                                    <h5 class="text-center"><?php echo $enquiry_bi['BI_Email'];?></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card h-100" style="border:0">
                                <h4 class="text-center">Location</h4>
                                <div class="card-body mx-auto">
                                    <div class="mymap ">
                                        <iframe  src="<?php echo $enquiry_bi['BI_Location'];?>"
                                        class="googlemap" allowfullscreen="" loading="lazy"
                                        referpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
                    }
                }
                else
                {
                    echo "No Business Information found";
                }
                ?>
        </div>

        

        
        <!-- FAQs  -->
        <div class="row col-12 shadow mb-5 mx-auto" style="margin-left:0px;">
            <div class="row mx-auto">
                <h2 class=" mb-3 text-center">Frequently Asked Questions (FAQs)</h2>
                <hr claas="justify-content-center" style="margin-right:0px;">
            </div>

            <?php
                $query = "SELECT * FROM enquiry_faqs";
                $query_run = mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $enquiry_faq)
                    {
                        ?>

                        <div class="row">
                            <div class="card h-100" style="border:0">
                                <h4 class="text-center"><?php echo $enquiry_faq['FAQs_enquiry'];?></h4>
                                <div class="card-body">
                                    <h5 class="text-center"><?php echo $enquiry_faq['FAQs_answer'];?></h5>
                                </div>

                            </div>

                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "No FAQs found";
                }
            ?>

        </div>



        <?php include('../include/footer.php') ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    </body>
</html>