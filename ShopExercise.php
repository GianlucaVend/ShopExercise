<!-- Gianluca Venditti -->
<?php
require_once ("GianlucaVendittiInclude.php");

//function calls our display headers 
//we create a form with form action 
//We then display out label for customer type: example: regular or corporate
// and then we display our number of copies
// add an input number for numnber of copies 
// and then add a submit button that will bring us to our next page. 

function GetInfoForm()
{
    WriteHeaders("Shop Exercise", "Shop Exercise");
    
    echo "<form action = ? method=post>";
    echo"<div>";
    DisplayLabel("Customer type: "); //use reuseable function displaying the label

    //setting up form data
    echo "<select name=\"f_customer\" id=\"customerType\">
                <option value=\"regular\">Regular</option>
                <option value=\"corporate\">Corporate</option>
                <option value=\"government\">Government</option>
          </select>";
    echo"</div>";
    
    echo"<div>";
    DisplayLabel("Number of copies: ");

    //creating input for number of copies textbox
    echo "<input type=\"number\" name=\"f_NumberofCopies\"
            id=\"numberofCopies\">";
    echo"</div>";

    //submit button that loads up  CalculateShowResultsForm(); 
    DisplayButton("f_submit", "SUBMIT");
    echo "</form"; 
    
    WriteFooters();
}

// Display results for gui page, containg data from the prevoious page 
function CalculateShowResultsForm()
{

    $CustomerType = $_POST["f_customer"];          // declaring f_custoemr to a post array, getting input from getInfoForm()
    $NumberofCopies = $_POST["f_NumberofCopies"];  // declaring f_numberofCopies to post array, input from form

    $price = GetCostofPage($CustomerType);        // assinging GetCostofPage to price variable 

    $subtotal;
    $tax;
    $total;

    CalculateTotal($NumberofCopies, $price, $subtotal, $tax, $total);   // passing in varibales by ref from get cost of page function

    WriteHeaders("Results", "Shop Exercise");

    echo "<div>";
    DisplayLabel("Customer Type: ");
    echo "$CustomerType </div>";

    echo "<div>";
    DisplayLabel("Number of Copies: ");
    echo "$NumberofCopies </div>";

    echo "<div>";
    DisplayLabel("Subtotal: $ ");
    echo number_format($subtotal,2) . "</div>";

    echo "<div>";
    DisplayLabel("Tax:$ ");
    echo number_format($tax,2) . "</div>";

    echo "<div>";
    DisplayLabel("Total:$ ");
    echo number_format($total,2) . "</div>";

    WriteFooters();
}

function GetCostofPage($CustomerType)
{
    $price; 

    if($CustomerType == "government") //if customer is government price is 0.10
        $price = 0.10;
    else
        if($CustomerType == "corporate") // otherwise if corporate price is 0.15
            $price = 0.15;
        else
            $price = 0.20;   // otherwise default is 0.20 price

    return $price;       
}

function CalculateTotal($NumberofCopies, $price, &$subtotal, &$tax, &$total) // we pass by reference to return multiple values 
{
    $subtotal = $NumberofCopies * $price;
    $tax = 0.13 * $subtotal;
    $total = $subtotal + $tax;
}

//Main

if (isset($_POST["f_submit"]))   //if F_submit is set/ meaning if the user has clicked submit(true), it displays results function
  CalculateShowResultsForm();    // otherwise if isset f_submit is not set (false), displays out get info form... which is GetInfoForm()
else
	GetInfoForm();
?>