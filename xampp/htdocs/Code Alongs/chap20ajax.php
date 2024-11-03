<html>

<head>
  <script>
    //Chapter 20 - AJAX (Asychronous JavaScript and XML)
    //AJAX makes your web application more responsive and faster, like Windows applications
    function checkCountry(country) {
      //use an asynchronous JS call to the proc page to get a list of matching countries
      
      //step 1
      $suggestionArray = []; //array with the results that come back

      //console.log(country); //for debugging

      document.getElementById("txtSuggestion").innerHTML = "";

      fetch("chap20_GetCountries.php?q=" + country) //pass in the url that you want to hit
        .then(response=> response.json()) 
        .then(data=> {
          //console.log(data); //for debugging
          if (Array.isArray(data)) {
            //document.getElementById("txtSuggestion").innerHTML = data;

            data.forEach(AddCountry);
          }
          else { //no results are coming back
            document.getElementById("lstCountries").innerHTML = "<option>" + data + "," + "</option>";

            document.getElementById("lstCountries").innerHTML = data;

          }
        })
        .catch(error=> console.log("There was an error getting the country"));
    }


    function AddCountry (data, index) {
      document.getElementById("lstCountries").innerHTML += "<option>" + data + "</option>";

      document.getElementById("txtSuggestion").innerHTML += data + ", ";
    }
  </script>
</head>

<body>

  <p><b>Start typing a country:</b></p>
  <form action="">
    <label for="fname">Country:</label>
    <input type="text" id="country" list="lstCountries" name="country" onkeyup="checkCountry(this.value)">
    <datalist id="lstCountries"></datalist>
  </form>
  <p>Suggestions: <span id="txtSuggestion"></span></p>
</body>

</html>