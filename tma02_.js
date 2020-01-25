// This code provides two functions to the page:-
//  validate()
//     This returns true if all field on the page are valid and false otherwise.
//     Its role is to control submission so only a valid page can be sent to the server
//     validate() operates by calling fieldcheck() described below for each field in turn 
//     only is each and every field is valid will validate return true.
//
//   fieldcheck(id)
//     This takes the unique id of a field and returns true is it is valid or false if not.
//     The unique id itself is used to access the element value.

//   Whilst there are more advanced ways to achieve this, we check for the type we expect
//   This does mean some repetition of similar code, and that we can only test expected id's, but is straight forward to follow.



 


function fieldcheck(id){  //check if the field represented by the unique identifier id is valid.
    if(document.getElementById(id) === null) { return true;}                           // ignore null
    fbid = "fb"+id;                                          // add prefix to get associated feedback unique id.
                                                             // We can do this because in the HTML we decided every element would have a 
                                                             //  corresponding feedback element prefixed with "fb"
    var fieldvalue = document.getElementById(id).value.trim(); 
                                                             //fetch the value of the field we are being asked about (trimming off any leading and trailing whitespace)
                                                             // It is very important to appreciate we can access the data entered by the user here
    var pattern;                                             // variable to hold regular expression                                                         
    var failmessage;                                         // variable to hold message shoudld test fail
    
    // Choose regular expression and fail message.
    //test firstname
    if (id == "firstname"){                         // Allow alpha numeric
      pattern = /^[a-z A-Z0-9]*$/ ;                 // test the value against an appropriate regular expression 
      failmessage="Only letters, numbers and spaces are permitted here";
    }
    
      if (id == "lastname"){                             // Allow alpha numeric
      pattern = /^[a-z A-Z0-9]*$/ ;                      // test the value against an appropriate regular expression 
        failmessage="Only letters, numbers and spaces are permitted here";
    }
 
   //test for email
    if (id == "email"){                           //Allow valid email
      pattern = /^.+?\@.*?$/  ;                  // test the value against an appropriate regular expression 
     failmessage ="Only valid email addresses are permitted here";
    }
    
    //test for bookingreference
    if (id == "bookingreference"){                           //Allow valid bookingreference
      pattern = /^[a-zA-Z]{3}-[0-9]{4}$/  ;                  // test the value against an appropriate regular expression 
     failmessage ="Only valid Booking References are permitted here";
    }
    
    // perform test and report    
      if (pattern.test( fieldvalue )){     // test the string against the regular expression. 
         // Update HTML to reflect pass
         document.getElementById(fbid).innerHTML= "Valid :" + fieldvalue; // add a feedback message to the feedback spanreport = "Valid :";
         document.getElementById(fbid).style.backgroundColor="lightgreen";  // change the feedback span to green
         return true;
      }
       else{                                        // there has not been a match
         report ="Only letters, numbers and spaces are permitted here";
         document.getElementById(fbid).innerHTML= failmessage + fieldvalue; // add a feedback message to the feedback spanreport = "Valid :";     
         document.getElementById(fbid).style.backgroundColor="red";      // change the feedback span to red 
         return false;
       }
    }       
    

 


	
// Function to validate form

function validate(){
   valid = fieldcheck("firstname");
   valid = valid && fieldcheck("lastname");
   valid = valid && fieldcheck("email");
   valid = valid && fieldcheck("bookingreference");
   return valid;
	}

	

