<?php
/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/

require_once('../classes/StickyForm.php');
require_once('../classes/Crud.php');
    $stickyForm = new StickyForm();


/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/

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

      "email"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>cannot have special charcters or blank, and must have a domain name</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"iahmed3@test.com",
        "regex"=>"email"
      ],

      "password"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>password cannot be blank</span>",
        "errorOutput"=>"",
        "type"=>"password",
        "value"=>"password",
        "regex"=>"password"
      ],

      "status"=>[
        "type"=>"select",
        "options"=>["Staff"=>"Staff","Admin"=>"Admin"],
            "selected"=>"sf",
        ],
  ];

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init_addAdmin(){
    global $elementsArr, $stickyForm;
  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    $elementsArr=$postArr;

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
    if($elementsArr['masterStatus']['status'] == "noerrors"){
      
      /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
      return addAdminData($_POST);

    }
    else{
      /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
      return getAdminForm("",$elementsArr);
    }
    
  }

  /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */
  else {
      return getAdminForm("", $elementsArr);
    } 
}

/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addAdminData($post){
    global $elementsArr, $stickyForm;

  // IF EVERYTHING WORKS ADD THE DATA
      $crud = new Crud();
      $result=$crud->addAdmin();

      if($result == "error"){
        return getAdminForm("<p>There was a problem processing your form</p>", $elementsArr);
      }
      else {
        return getAdminForm("<p>Admin Information Added</p>", $elementsArr);
      }

}
   

/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getAdminForm($acknowledgement, $elementsArr){
    global $elementsArr, $stickyForm;
$options = $stickyForm->createOptions($elementsArr['status']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="">
    <div class="form-group">
        <label for="name">Username (letters Only)</label>
        <input type="text" class="form-control" name="name" value='{$elementsArr["name"]["value"]}'>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" value='{$elementsArr["email"]["value"]}'>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value='{$elementsArr["password"]["value"]}'>
 
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            $options;
        </select>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" name="submit" value="Add Admin" >
    </div>
    HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return $acknowledgement."<br>".$form;

}


?>

