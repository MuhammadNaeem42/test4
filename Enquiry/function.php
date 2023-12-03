<?php
session_start();
include "../include/DBconn.php";


// Business information
if (isset($_POST['save_BI']))
{
    $BI_Outlet_ID = mysqli_real_escape_string($conn, $_POST['BI_Outlet_ID']);
    $BI_Outlet_name = mysqli_real_escape_string($conn, $_POST['BI_Outlet_name']);
    $BI_operating_time = mysqli_real_escape_string($conn, $_POST['BI_operating_time']);
    $BI_phoneNo = mysqli_real_escape_string($conn, $_POST['BI_phoneNo']);
    $BI_Email = mysqli_real_escape_string($conn, $_POST['BI_Email']);
    $BI_Location = mysqli_real_escape_string($conn, $_POST['BI_Location']);

    $query = "INSERT INTO enquiry_bi (BI_Outlet_ID, BI_Outlet_name, BI_operating_time, BI_phoneNo, BI_Email, BI_Location) 
    VALUES ('$BI_Outlet_ID', '$BI_Outlet_name', '$BI_operating_time', '$BI_phoneNo', '$BI_Email', '$BI_Location')";

    $query_run = mysqli_query($conn, $query);


    if($query_run)
    {
        $_SESSION['message'] = "Business informtion inserted into database successfully";
        header("Location: Enquiry_BI.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Business information not inserted into database successfully";
        header("Location: Enquiry_BI.php");
        
        exit(0);
    }
}

if(isset($_POST['update_BI']))
{
    $BI_Outlet_ID = mysqli_real_escape_string($conn, $_POST['BI_Outlet_ID']);
    $BI_Outlet_name = mysqli_real_escape_string($conn, $_POST['BI_Outlet_name']);
    $BI_operating_time = mysqli_real_escape_string($conn, $_POST['BI_operating_time']);
    $BI_phoneNo = mysqli_real_escape_string($conn, $_POST['BI_phoneNo']);
    $BI_Email = mysqli_real_escape_string($conn, $_POST['BI_Email']);
    $BI_Location = mysqli_real_escape_string($conn, $_POST['BI_Location']);

    $query = "UPDATE enquiry_bi 
    SET BI_Outlet_name='$BI_Outlet_name', BI_operating_time='$BI_operating_time' , BI_phoneNo='$BI_phoneNo', BI_Email='$BI_Email', BI_Location='$BI_Location'
    WHERE BI_Outlet_ID='$BI_Outlet_ID' ";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Business informtion inserted into database successfully";
        header("Location: Enquiry_BI.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Business information not inserted into database successfully";
        header("Location: Enquiry_BI.php");
        
        exit(0);
    }
}


if(isset($_POST['delete_BI']))
{
    $BI_Outlet_ID = mysqli_real_escape_string($conn, $_POST['delete_BI']);

    $query = "DELETE FROM enquiry_bi WHERE BI_Outlet_ID='$BI_Outlet_ID'";
    $query_run = mysqli_query($conn, $query);


    if($query_run)
    {
        $_SESSION['message'] = "Business information deleted from database successfully";
        header("Location: Enquiry_BI.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Business information failed in deleting from database";
        header("Location: Enquiry_BI.php");
        
        exit(0);
    }
}

// FAQs
if (isset($_POST['save_FAQs']))
{
    $FAQs_ID = mysqli_real_escape_string($conn, $_POST['FAQs_ID']);
    $FAQs_enquiry = mysqli_real_escape_string($conn, $_POST['FAQs_enquiry']);
    $FAQs_answer = mysqli_real_escape_string($conn, $_POST['FAQs_answer']);

    $query = "INSERT INTO enquiry_faqs (FAQs_ID, FAQs_enquiry, FAQs_answer) 
    VALUES ('$FAQs_ID', '$FAQs_enquiry', '$FAQs_answer')";

    $query_run = mysqli_query($conn, $query);


    if($query_run)
    {
        $_SESSION['message'] = "FAQs inserted into database successfully";
        header("Location: Enquiry_FAQs.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "FAQs not inserted into database successfully";
        header("Location: Enquiry_FAQs.php");
        
        exit(0);
    }
}

if(isset($_POST['delete_FAQs']))
{
    $FAQs_ID = mysqli_real_escape_string($conn, $_POST['delete_FAQs']);

    $query = "DELETE FROM enquiry_faqs WHERE FAQs_ID='$FAQs_ID'";
    $query_run = mysqli_query($conn, $query);


    if($query_run)
    {
        $_SESSION['message'] = "FAQs deleted from database successfully";
        header("Location: Enquiry_FAQs.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "FAQs failed in deleting from database";
        header("Location: Enquiry_FAQs.php");
        
        exit(0);
    }
}

if(isset($_POST['update_FAQs']))
{
    $FAQs_ID = mysqli_real_escape_string($conn, $_POST['FAQs_ID']);
    $FAQs_enquiry = mysqli_real_escape_string($conn, $_POST['FAQs_enquiry']);
    $FAQs_answer = mysqli_real_escape_string($conn, $_POST['FAQs_answer']);

    $query = "UPDATE enquiry_faqs SET FAQs_enquiry='$FAQs_enquiry', FAQs_answer='$FAQs_answer' WHERE FAQs_ID='$FAQs_ID' ";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "FAQs updated into database successfully";
        header("Location: Enquiry_FAQs.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "FAQs not updated into database successfully";
        header("Location: Enquiry_FAQs.php");
        
        exit(0);
    }
}


if(isset($_POST['delete_FAQs']))
{
    $FAQs_ID = mysqli_real_escape_string($conn, $_POST['delete_FAQs']);

    $query = "DELETE FROM enquiry_faqs WHERE FAQs_ID='$FAQs_ID'";
    $query_run = mysqli_query($conn, $query);


    if($query_run)
    {
        $_SESSION['message'] = "FAQs deleted from database successfully";
        header("Location: Enquiry_FAQs.php");
        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "FAQs failed in deleting from database";
        header("Location: Enquiry_FAQs.php");
        
        exit(0);
    }
}


// Contact form

?>

