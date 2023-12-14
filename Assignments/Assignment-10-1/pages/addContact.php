<?php

/* HERE I REQUIRE AND USE THE STICKYFORM AND PDO CLASS. STICKFORM DOES ALL THE VALIDATION AND CREATES THE STICKY FORM, WHILE PDO CLASS COMMUNICATE WITH DATABASE */

require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');
    $stickyForm = new StickyForm();


/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO.*/

$elementsArr = [
    "masterStatus"=>[
      "status"=>"noerrors",
      "type"=>"masterStatus"
    ],
      "name"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
      "errorOutput"=>"",
      "type"=>"text",
      "value"=>"Scott",
          "regex"=>"name"
      ],
      "address"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Address cannot be blank and must be a valid address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"123 street",
        "regex"=>"address"
      ],

      "city"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>city cannot be blank. Number cannot be used</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"anywhere",
        "regex"=>"city"
      ],

      "state"=>[
        "type"=>"select",
        "options"=>["MI"=>"Michigan","OH"=>"Ohio","PA"=>"Pennslyvania","TX"=>"Texas"],
            "selected"=>"OH",
            "regex"=>"state"
        ],

      "phone"=>[
          "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be a written as 999.999.9999</span>",
      "errorOutput"=>"",
      "type"=>"text",
          "value"=>"999.999.9999",
          "regex"=>"phone"
    ],
    
    "email"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>cannot be blank, and must be written as proper email</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"iahmed3@test.com",
        "regex"=>"email"
      ],

      "dob"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>must be of format mm/dd/yyyy</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"12/25/1999",
        "regex"=>"dob"
      ],

      "contacts"=>[
        "type"=>"checkbox",
        "action"=>"notRequired",
        "status"=>["Newsletter"=>"", "Email Updates"=>"", "Text Updates"=>""]
      ],

      "age"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must select at least one option</span>",
        "errorOutput"=>"",
        "action"=>"required",
        "type"=>"radio",
        "value"=>["10-18"=>"", "19-30"=>"", "30-50"=>"", "51+"=>""]
      ]
  ];

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING. CALLED FROM ROUTES PAGE*/
function init_addContact(){
    global $elementsArr, $stickyForm;
  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.*/
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    $elementsArr=$postArr;

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".*/
    if($elementsArr['masterStatus']['status'] == "noerrors"){
      
      /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE */
      return addData($_POST);

    }
    else{
      /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  */
      return getForm("",$elementsArr);
    }
    
  }

  /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */
  else {
      return getForm("", $elementsArr);
    } 
}

/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post){
    global $elementsArr, $stickyForm;

  // IF EVERYTHING WORKS ADD THE DATA
  $pdo = new PdoMethods();
    
  /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
  $sql = "INSERT INTO Contacts (name, address, city, state, phone, email, dob, contacts, age) VALUES (:name, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";
  
      if(isset($_POST['contacts'])){
          $contacts = "";
          foreach($_POST['contacts'] as $v){
            $contacts .= $v.",";
          }
          /* REMOVE THE LAST COMMA FROM THE CONTACTS */
          $contacts = substr($contacts, 0, -1);
        }
        else {
          $contacts = "";
        }
  
        if(isset($_POST['age'])){
          $age = $_POST['age'];
        }
        else {
          $age = "";
        }

    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
    $bindings = [
          [':name',$_POST['name'],'str'],
          [':address',$_POST['address'],'str'],
          [':city',$_POST['city'],'str'],
          [':state',$_POST['state'],'str'],
          [':phone',$_POST['phone'],'str'],
          [':email',$_POST['email'],'str'],
          [':dob',$_POST['dob'],'str'],
          [':contacts',$contacts,'str'],
          [':age',$age,'str']
        ];

  /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
  $result = $pdo->otherBinded($sql, $bindings);

  /* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
  if($result === 'error'){
    return getForm("<p>There was a problem processing your form</p>", $elementsArr);
  }
  else {
    return getForm("<p>Contact Information Added</p>", $elementsArr);
  }

}
   

/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){
    global $elementsArr, $stickyForm;
$options = $stickyForm->createOptions($elementsArr['state']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="">
    <div class="form-group">
      <label for="name">Name (letters only){$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>
    <div class="form-group">
      <label for="address">Address (just number and street){$elementsArr['address']['errorOutput']}</label>
      <input type="text" class="form-control" id="address" name="address" value="{$elementsArr['address']['value']}" >
    </div>
    <div class="form-group">
      <label for="city">City (letters only){$elementsArr['city']['errorOutput']}</label>
      <input type="text" class="form-control" id="city" name="city" value="{$elementsArr['city']['value']}" >
    </div>
    <div class="form-group">
      <label for="state">State</label>
      <select class="form-control" id="state" name="state">
        $options;
      </select>
    </div>
    <div class="form-group">
      <label for="phone">Phone (format 999.999.9999) {$elementsArr['phone']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
    </div>
    <div class="form-group">
      <label for="email">Email Address{$elementsArr['email']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
    </div>
    <div class="form-group">
      <label for="dob">Date of Birth (format mm/dd/yyyy){$elementsArr['dob']['errorOutput']}</label>
      <input type="text" class="form-control" id="dob" name="dob" value="{$elementsArr['dob']['value']}" >
    </div>

    <p>Please check all contact types you would like (Optional)</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="contact1" value="Newsletter" {$elementsArr['contacts']['status']['Newsletter']}>
      <label class="form-check-label" for="contact1">Newsletter</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="contact2" value="Email Updates" {$elementsArr['contacts']['status']['Email Updates']}>
      <label class="form-check-label" for="contact2">Email Updates</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="contact3" value="Text Updates" {$elementsArr['contacts']['status']['Text Updates']}>
      <label class="form-check-label" for="contact3">Text Updates</label>
    </div>
        

    <p>Please select an age range (you must select one):</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age1" value="10-18" {$elementsArr['age']['value']['10-18']}>
      <label class="form-check-label" for="age1">10-18</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age2" value="19-30" {$elementsArr['age']['value']['19-30']}>
      <label class="form-check-label" for="age2">19-30</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age3" value="30-50" {$elementsArr['age']['value']['30-50']}>
      <label class="form-check-label" for="age3">30-50</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age4" value="51+" {$elementsArr['age']['value']['51+']}>
      <label class="form-check-label" for="age4">51+</label>
      {$elementsArr['age']['errorOutput']}
    </div>

    <div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return $acknowledgement."<br>".$form;

}

?>