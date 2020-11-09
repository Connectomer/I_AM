<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-database.js"></script>


<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-analytics.js"></script>

<style>
<?php include 'main.css'; ?>
</style>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyAgsZ8kmIgBr2Mmb74SZnz7hAl9U3lVbPA",
    authDomain: "i-am-5c796.firebaseapp.com",
    databaseURL: "https://i-am-5c796.firebaseio.com",
    projectId: "i-am-5c796",
    storageBucket: "i-am-5c796.appspot.com",
    messagingSenderId: "478004048698",
    appId: "1:478004048698:web:a0082e531a92056a35d603",
    measurementId: "G-9VYX0QVG7V"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  var action;

  function sendMessage(){
    action = document.getElementById("action").value.toLowerCase();
    var refr = firebase.database().ref(`messages/${action}`);

    var trigger = false;

    refr.off();
    refr.on('value', function(snapshot) {
        if(snapshot.exists()){
          var html = "<p class='text'>";
          html += snapshot.val();
          html += "</p>";
          document.getElementById("descript").innerHTML += html;
          document.getElementById("firstSubmit").disabled = true;
        }else{
          document.getElementById("firstSubmit").disabled = true;
          document.getElementById("descriptionSubmission").className = "show";
        }
    });
    return false;
  }

  function createDescription(){

    var description = document.getElementById("description").value;

    document.getElementById("secondSubmit").disabled = true;

    var refr2 = firebase.database().ref(`messages/${action}`);
    refr2.set(description);
    return false;
  }

</script>

<?php
  $class = 'hidden';

  echo <<< END
  You walk your dog through the local park. Suddenly you hear Australian gibberish. <br> <br>
  "hy geeve me yah fuckin' moolah bloody oath cobber" <br> <br>
  Uh oh! The Australian holds up a gun and signals you to give him your wallet. <br> <br>
  "bark bark!", says your dog. <br> <br>
  An old lady hears the Australian and begins to yell. <br> <br>
  "Holdeth still young p'rson, I shall calleth the police on mine own telephoneth!", the old lady shouts, vigorously shaking. <br> <br>
  What are you doing? <br> <br> <br>
  <b>I am...</b>

  END;
 ?>

<form onsubmit="return sendMessage();">
  <input id="action" placeholder="..." autocomplete="off" onkeypress="return event.charCode != 32">
  <input class="show" id="firstSubmit" type="submit">
</form>

<form onsubmit="return createDescription();" class="hidden" id="descriptionSubmission">
  <p>What happens? </p>
  <textarea id="description" placeholder="..." autocomplete="off" cols="50" rows="10"></textarea>
  <input class="show" id="secondSubmit" type="submit">
</form>

<div id="descript">

</div>
