<!DOCTYPE HTML>
<html>
    <head>
        <title>Shakespeare text generator</title>
        <style>
            body {
                background-color:beige;
                color:	rgb(102, 51, 0);
            }
            #textOutput {border-style: inset;}
        </style>
    </head>
    <body>
        <h1>Shakespeare Text Generator</h1>
        
        <!-- Form which will be handled within this file-->
        <form action="" method="post">
            <p>
                Please select the number of characters in the model: <br>
                <label><input type="radio" name="nb_of_chars" value="3"/>3 (default)</label> <br>
                <label><input type="radio" name="nb_of_chars" value="6"/>6</label> <br>
                <label><input type="radio" name="nb_of_chars" value="10"/>10</label> <br>
        
            </p>
            <input type="submit" value="Submit">
        </form>
        <br>
    </body>
</html>    

<!-- Form handling -->
<?php
    //Gets executed when the user selects 'Submit'
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        //If user didn't select any choice, default is 3.
        $nb_of_chars;
        if(isset($_POST['nb_of_chars'])){
            $nb_of_chars=$_POST['nb_of_chars'];
        } else {
            $nb_of_chars=3;
        }
        
        //Echo generated text
        include "classes/TextGenerator.php";
        $generator = new TextGenerator($nb_of_chars);
        $resultStr = $generator->createText();
        echo nl2br($resultStr);
        
    }
    
?>