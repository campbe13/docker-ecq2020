<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Shakespeare Generator</title>
        <link rel = "stylesheet" href = "./styles/main_styling.css" />
    </head>
    <body>
        
        <?php
        
        //require statements
        require_once "model/DataStorage.php";
        
        // define variables and set to empty values
        $model = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if (empty($_POST["model"])) 
            {
                $modelErr = "Selection is required!";
            }
            else 
            {
                $model = test_input($_POST["model"]);
            }
        }

        function test_input($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

    <!-- This section will handle the form part -->
    <header>
        <img class="icon" src="images/shakespeare.png" alt="shakespeare image">
        <img class="spotlight" src="images/spotlight.png" alt="spotlight">
        <h2>Shakespeare Generator</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">  

        Please select the number of characters in the model: <br><br>
        <label class="container">
            <input type="radio" name="model" value="3" checked>3 (default)
            <span class="checkmark"></span>
        </label>
        <label class="container">
            <input type="radio" name="model" value="6" >6
            <span class="checkmark"></span>
        </label>
        <label class="container">
            <input type="radio" name="model" value="10" >10
            <span class="checkmark"></span>
        </label>
        <br>
        <input type="submit" name="submit" value="Submit">  
        </form>
    </header>

    <!-- This section will handle the generated text -->
    <section class="border_image">
        <?php
        // if model has been assigned from the form start generating the text.
        // Varify that the model is 3, 6 or 10. If not it will set it to 3.
        if($_POST['model'] != '3' && $_POST['model'] != '6' && $_POST['model'] != '10')
        {
            $_POST['model'] = '3';
        }
        
        if(isset($_POST['model']) && $model != "")
        {
            // Validation of the currect data.
            if($_POST['model'] == '3' || $_POST['model'] == '6' || $_POST['model'] == '10')
            {
                echo '<h2>Your Input: '.$_POST['model']."</h2>";
                
                $modelData = new DataStorage();
                
                //Constants
                define('FIRST3', "Fir");
                define('FIRST6', "First ");
                define('FIRST10', "First Citi");
                
                $counter = 0; // to count the characters.
                

                
                if($_POST['model'] == '3')
                {
                    $currentKey=FIRST3;
                }
                
                if($_POST['model'] == '6')
                {
                    $currentKey=FIRST6;
                }
                
                if($_POST['model'] == '10')
                {
                    $currentKey=FIRST10;
                }
                
                $text = $currentKey;
                
                //Varifies the key
                if(isset($currentKey))
                {
                    // looping for 1000 characters
                    while($counter < 1000)
                    {
                        $randomProb = rand() / getrandmax();
                        $probabilitySum = 0.0; 
                        
                        $currentValue = $modelData->getValueFromKey($currentKey);
                        // PMC catch no data error 2020-02-17
			if ($currentValue == '')  {
				echo "Data lookup error, null returned, key: ".$currentKey ; 
				break;
			}
			// PMC
                        $jsonCurrentValue = json_decode($currentValue, true);
                        foreach($jsonCurrentValue as $letter => $probability)
                        {
                            $probabilitySum += $probability;
                            if($probabilitySum > $randomProb)
                            {
                                $text.=$letter; 
                                break;
                            }
                        }
                        
                        $currentKey = substr($text, -((int)($_POST['model'])));
                        
                        $counter++;
                        
                    }
                    
                    echo nl2br($text); //displaying the whole text.
                    
                }
                // throws an exception if the character was not set.
                else
                {
                    throw new InvalidArgumentException("No starting character was set.");
                }
                
            }
        }
        ?>    
    </section>
    
    <!-- The footer section will be used for refferences. -->
    <footer>
        <p class="blured">What, you egg? [He stabs him.]</p>
        <p class="blured">&copy; <?php echo date("Y"); ?> Jeffrey and Michael</p>
        <p class="blured">images from wikimedia.org</p>
    </footer>
    </body>
</html>
