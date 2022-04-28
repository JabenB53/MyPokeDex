<!doctype html>

<html>
    <head>
        <meta charset="utf-8">
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <title>Pokedex</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="styles.css">

    </head>

    <body>
	<h1 style="text-align: center; margin: auto; width: 50vw; color: #FFFFFF">The Pokedex</h1>
	<div id = "entryDiv" style="text-align: center; margin: auto; width: 50vw; color: #FFFFFF">
		<p>Enter the Pokemon's number here (1-898):</p>
		<input type="number" name="numberEntry" id="numberEntry" value = "1" min = "1" max="898">
		<input type="button" id ="submitButton" value="Submit">
	</div>
	<br>
	<div id= "display" style="text-align: center; margin: auto; float: initial;">
		
	</div>
	
	<script>
	var theForm = $("#numberEntry") // get the pokemon number from the user

	$("#submitButton").click(function() {
			fetch('https://pokeapi.co/api/v2/pokemon/' + numberEntry.value)
            .then(function (response) {
                return response.json(); // turn the data into a json object
            })
            .then(function (data) {
				displayInfo(data); // display the information
            })
            .catch(function (err) {
                console.log('error: ' + err); // catch any errors that occur
            });
	})
	
	function displayInfo(data)
	{
		$("#display").empty(); // empty the display
		$("#display").removeClass("displayStyle"); // remove the styling around the display
		
		pokeName = document.createElement("p"); // create an element for the Pokemon's name
        pokeName.innerHTML = '<b>NAME:</b> ' + data.name.toUpperCase(); 
		
		pokeSprite = document.createElement("img") // create an element for the Pokemon's sprite
		pokeSprite.src = data.sprites.front_default;
		pokeSprite.alt = data.name;
		
		pokeType = document.createElement("p"); // create an element to contain the Pokemon's type(s)
		pokeType.innerHTML = "<b>TYPE</b>: "
		pokeType.innerHTML += data.types[0].type.name.toUpperCase() + " ";
		if (data.types.length > 1)
			pokeType.innerHTML += " & " + data.types[1].type.name.toUpperCase() + " ";
		pokeType.innerHTML +="<br>"
		
		pokeStats = document.createElement("div"); // create a div to contain the Stats
		pokeStats.setAttribute('id', 'stats');
		pokeStats.setAttribute('style', 'overflow: auto;');
		
		statNames = document.createElement("div"); // create a div to contain stat names
		statNames.setAttribute('id', 'statNames');
		statNames.setAttribute('style', 'width: 35%; float: left; clear: none; margin: 0px;');
		HPLabel = document.createElement("p"); // create an element to display each stat's name
		HPLabel.setAttribute('class', 'statNameStyle');
		AttackLabel = document.createElement("p");
		AttackLabel.setAttribute('class', 'statNameStyle');
		DefenseLabel = document.createElement("p");
		DefenseLabel.setAttribute('class', 'statNameStyle');
		SpAttackLabel = document.createElement("p");
		SpAttackLabel.setAttribute('class', 'statNameStyle');
		SpDefenseLabel = document.createElement("p");
		SpDefenseLabel.setAttribute('class', 'statNameStyle');
		SpeedLabel = document.createElement("p");
		SpeedLabel.setAttribute('class', 'statNameStyle');
		HPLabel.innerHTML = "HP: "; 
		AttackLabel.innerHTML = "Attack:" ;
		DefenseLabel.innerHTML = "Defense: ";
		SpAttackLabel.innerHTML = "SpAttack: ";
		SpDefenseLabel.innerHTML = "SpDefense: ";
		SpeedLabel.innerHTML = "Speed: ";
		
		statValues = document.createElement("div"); // create a div to contain stat vlaue bars
		statValues.setAttribute('id', 'statValues');
		statValues.setAttribute('style', 'width: 60%; float: right; clear: none; margin: 0px');
		HPBar = document.createElement("p"); // create an element to display each stat's value
		HPBar.setAttribute('class', 'statBarStyle');
		AttackBar = document.createElement("p");
		AttackBar.setAttribute('class', 'statBarStyle');
		DefenseBar = document.createElement("p");
		DefenseBar.setAttribute('class', 'statBarStyle');
		SpAttackBar = document.createElement("p");
		SpAttackBar.setAttribute('class', 'statBarStyle');
		SpDefenseBar = document.createElement("p");
		SpDefenseBar.setAttribute('class', 'statBarStyle');
		SpeedBar = document.createElement("p");
		SpeedBar.setAttribute('class', 'statBarStyle');
		HPBar.innerHTML = data.stats[0].base_stat; // get each stat from the file MAX = 255 Blissey
		AttackBar.innerHTML = data.stats[1].base_stat + "<br>"; // MAX = 181 Kartana
		DefenseBar.innerHTML = data.stats[2].base_stat + "<br>"; // MAX = 180 Atk Deoxys 
		SpAttackBar.innerHTML = data.stats[3].base_stat + "<br>"; // MAX = 230 Shuckle
		SpDefenseBar.innerHTML = data.stats[4].base_stat + "<br>"; // MAX = 230 Shuckle
		SpeedBar.innerHTML = data.stats[5].base_stat + "<br>"; // MAX = 200 Regieleki
		SpeedBar.setAttribute('style','background-color: Yellow; width: ' + (data.stats[5].base_stat / 255) * 99 + '%;'); // set each stat bar to a percentage of the width
		HPBar.setAttribute('style','background-color: Pink; width: ' + (data.stats[0].base_stat / 255) * 99 + '%;');
		AttackBar.setAttribute('style','background-color: Orange; width: ' + (data.stats[1].base_stat / 255) * 99 + '%');
		DefenseBar.setAttribute('style','background-color: #6969FB; width: ' + (data.stats[2].base_stat / 255) * 99 + '%;');
		SpAttackBar.setAttribute('style','background-color: Red; width: ' + (data.stats[3].base_stat / 255) * 99 + '%;');
		SpDefenseBar.setAttribute('style','background-color: #00FF00; width: ' + (data.stats[4].base_stat / 255) * 99 + '%;');
		
		$("#display").append(pokeName); // append all of these elements
		$("#display").append(pokeSprite);
		$("#display").append(pokeType);
		$("#display").append(pokeStats);
			$("#stats").append(statNames);
				$("#statNames").append(HPLabel);
				$("#statNames").append(AttackLabel);
				$("#statNames").append(DefenseLabel);
				$("#statNames").append(SpAttackLabel);
				$("#statNames").append(SpDefenseLabel);
				$("#statNames").append(SpeedLabel);
			$("#stats").append(statValues);
				$("#statValues").append(HPBar);
				$("#statValues").append(AttackBar);
				$("#statValues").append(DefenseBar);
				$("#statValues").append(SpAttackBar);
				$("#statValues").append(SpDefenseBar);
				$("#statValues").append(SpeedBar);
		$("#display").addClass("displayStyle");	// add the styling for the display div
	}
	
	fetch('https://pokeapi.co/api/v2/pokemon/1') // load Bulbasaur to start
            .then(function (response) {
                return response.json(); // turn the data into a json object
            })
            .then(function (data) {
				displayInfo(data); // display the information
            })
            .catch(function (err) {
                console.log('error: ' + err); // catch any errors that occur
            });
	
	</script>
    </body>

</html>