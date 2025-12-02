<?php
// This is a simple PHP script to process form submissions.
// For a real-world application, you would add robust validation,
// error handling, and security measures.

// Check if the request method is POST.
// Forms typically send data using the POST method for security and data size reasons.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect data from the form.
    // Using htmlspecialchars to prevent XSS attacks when displaying data back (though not directly done here).
    // Using trim to remove leading/trailing whitespace.
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // --- Basic Validation (You'd want more comprehensive validation in production) ---
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // If there are no validation errors, proceed with processing
    if (empty($errors)) {
        // --- Simulate sending an email ---
        // In a real scenario, you would use PHP's mail() function or a more robust
        // library (like PHPMailer) to send an actual email.

        $to = "info@laurelsconsulting.com"; // Your company's email
        $subject = "New Contact Form Submission from Laurels Website";
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        $email_body = "You have received a new message from your website contact form.\n\n";
        $email_body .= "Name: " . $name . "\n";
        $email_body .= "Email: " . $email . "\n";
        $email_body .= "Message:\n" . $message . "\n";

        // Uncomment the line below to actually attempt sending the email
        // For this to work, your server needs to be configured to send mail (e.g., with sendmail or postfix)
        // $mail_sent = mail($to, $subject, $email_body, $headers);

        // For demonstration, we'll just output a success message
        // In a real application, you'd redirect the user to a "thank you" page
        // header("Location: thank_you.html");
        // exit();

        echo "<!DOCTYPE html>
              <html lang='en'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <title>Message Sent!</title>
                  <script src='https://cdn.tailwindcss.com'></script>
                  <style>
                      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
                      body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
                  </style>
              </head>
              <body class='flex items-center justify-center min-h-screen bg-gray-100'>
                  <div class='bg-white p-8 rounded-lg shadow-lg text-center'>
                      <h1 class='text-3xl font-bold text-green-600 mb-4'>Message Sent Successfully!</h1>
                      <p class='text-gray-700 mb-6'>Thank you for contacting Laurels Consulting. We will get back to you shortly.</p>
                      <a href='index.html' class='inline-block bg-indigo-600 text-white font-bold py-2 px-6 rounded-md hover:bg-indigo-700 transition duration-300'>Go Back to Home</a>
                  </div>
              </body>
              </html>";

    } else {
        // If there are errors, display them
        echo "<!DOCTYPE html>
              <html lang='en'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <title>Form Submission Error</title>
                  <script src='https://cdn.tailwindcss.com'></script>
                  <style>
                      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
                      body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
                  </style>
              </head>
              <body class='flex items-center justify-center min-h-screen bg-gray-100'>
                  <div class='bg-white p-8 rounded-lg shadow-lg text-center'>
                      <h1 class='text-3xl font-bold text-red-600 mb-4'>Error Submitting Form</h1>
                      <p class='text-gray-700 mb-6'>Please correct the following issues:</p>
                      <ul class='list-disc list-inside text-red-700 mb-6'>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "    </ul>
                      <a href='index.html#contact' class='inline-block bg-indigo-600 text-white font-bold py-2 px-6 rounded-md hover:bg-indigo-700 transition duration-300'>Go Back to Form</a>
                  </div>
              </body>
              </html>";
    }

} else {
    // If someone tries to access this script directly without a POST request
    echo "<!DOCTYPE html>
          <html lang='en'>
          <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <title>Access Denied</title>
              <script src='https://cdn.tailwindcss.com'></script>
              <style>
                  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
                  body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
              </style>
          </head>
          <body class='flex items-center justify-center min-h-screen bg-gray-100'>
              <div class='bg-white p-8 rounded-lg shadow-lg text-center'>
                  <h1 class='text-3xl font-bold text-red-600 mb-4'>Direct Access Not Allowed</h1>
                  <p class='text-gray-700 mb-6'>This page should only be accessed via a form submission.</p>
                  <a href='index.html' class='inline-block bg-indigo-600 text-white font-bold py-2 px-6 rounded-md hover:bg-indigo-700 transition duration-300'>Go Back to Home</a>
              </div>
          </body>
          </html>";
}
?>
