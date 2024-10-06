<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if ($opt2 == 'email-sent') {
    
    $e = "<p class='greencent'>The message has been successfully sent. You will receive a response as soon as possible.</p>";
} else if ($opt2 == 'write-success') {
    
    $e = "<p class='greencent'>Article successfully written!</p>";
} else if ($opt2 == 'edit-success') {
    
    $e = "<p class='greencent'>Article successfully edited!</p>";
} else if ($opt2 == 'delete-success') {
    
    $e = "<p class='greencent'>Article successfully deleted!</p>";
} else if ($opt2 == 'add-category-success') {
    
    $e = "<p class='greencent'>Category successfully created!</p>";
} else if ($opt2 == 'edit-category-success') {
    
    $e = "<p class='greencent'>Category successfully edited!</p>";
} else if ($opt2 == 'category-delete-success') {
    
    $e = "<p class='greencent'>Category successfully deleted!</p>";
} else if ($opt2 == 'registration-start') {
    
    $e = "<p class='greencent'>You have successfully applied! You will receive login details within the next 24 hours.</p>";
} else if ($opt2 == 'profile-update') {
    
    $e = "<p class='greencent'>You have successfully updated your profile! You will receive an email as confirmation.<br>
    If you changed your username or password, please log out and log in again.</p>";
} else if ($opt2 == 'registration-completed') {
    
    $e = "<p class='greencent'>You have successfully registered a new member! An email has been sent.</p>";
} else {
    
    $e = "<p class='redcent'>No content! Access restricted.</p>";
}

$content =
"
<section id='content'>
<h1 class='cent'>INFO</h1>
$e
</section>
";

?>
