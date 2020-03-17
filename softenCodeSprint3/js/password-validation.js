
var myInput = document.getElementById("psw");
var myReInput = document.getElementById("repsw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var recheck = document.getElementById("recheck");
    
document.getElementById("message").style.display = "block";
letter.classList.remove("invalid");
letter.classList.add("valid");
capital.classList.remove("invalid");
capital.classList.add("valid");
number.classList.remove("invalid");
number.classList.add("valid");
length.classList.remove("invalid");
length.classList.add("valid");
recheck.classList.remove("invalid");
recheck.classList.add("valid");

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
      
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }
    
  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
      
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
  
  // Validate same password
  if(myReInput.value !== myInput.value) {  
    recheck.classList.remove("valid");
    recheck.classList.add("invalid");
  } else if(myReInput.value === "" || myInput.value == "") {
    recheck.classList.remove("valid");
    recheck.classList.add("invalid");
  } else {
    recheck.classList.remove("invalid");
    recheck.classList.add("valid");
  }
}

// Re-password
myReInput.onkeyup = function() {
  // Validate same password
  if(myReInput.value !== myInput.value) {  
    recheck.classList.remove("valid");
    recheck.classList.add("invalid");
  } else if(myReInput.value === "" || myInput.value == "") {
    recheck.classList.remove("valid");
    recheck.classList.add("invalid");
  } else {
    recheck.classList.remove("invalid");
    recheck.classList.add("valid");
  }
}