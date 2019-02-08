<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style1.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="images/favicon.gif" type="image">
        <title>Contact Form Page</title>
    </head>
    
    <body>
        <header>
            <img id="paw" src="images/pawPrint.gif">
            <span>Pet Shop</span>
            <div class="navbar" id="responsiveNavBar">
                <ul>
                    <li><a href="index.html" >HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="store.html">STORE</a></li>
                    <li><a href="contactForm.html" class="active">CONTACT</a></li>
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="setup.html">SIGNUP</a></li>
                    <a href="#" class="icon" onclick="myFunction()">
                        <i class="fa fa-bars"></i></a>
                </ul>
            </div>
        </header>
        
        <main>
            <form method="post" action="php/insertRecord2.php">
                <fieldset>
                    <legend>Contact Form</legend>
                    <label>First Name: </label><br>
                    <input type="text" name="fname" ><br>
                    <label>Last Name:  </lable><br>
                    <input type="text" name="lname"><br>
                    <label>Email:  </label><br>
                    <input type="email" name="email"><br>
                    <label>Phone:  </label><br>
                    <input type="phone" name="phone"><br>
                    <label>Message:  </label><br>
                    <textarea name="message"></textarea><br><br>
                    <button type="submit" value="Submit">Submit</button><br>
                </fieldset>
            </form>
        </main>
            
        <!--including my js file-->
        <script src="js/navbar.js"></script>
        
    </body>
    

</html>
