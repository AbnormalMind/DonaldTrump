<!DOCTYPE html>
<html>
    <head>
        <title>Mexican Invaders</title>
        <link rel="stylesheet" type="text/css" href="css/core.css">
        <link rel="stylesheet" type="text/css" href="css/typeography.css">
        <style>
    
            /* Styling needed for a fullscreen canvas and no scrollbars. */
            body, html { 
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            }

            #starfield {
                width:100%;
                height:100%;
                z-index: -1;
                position: absolute;
                left: 0px;
                top: 0px;
            }
            #gamecontainer {
                width: 800px;
                margin-left: auto;
                margin-right: auto;
            }
            #gamecanvas { 
                width: 800px;
                height: 600px;
            }
            #info {
                width: 800px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
        <div id="starfield"></div>
        <div id="gamecontainer">
        <canvas id="gameCanvas"></canvas>
        
		
		
		
        <div id="LeaderBoard">
			
			<span id="innerLeaderBoard"></span>
		
		
			<form name="form" action="update.php" method="post">
				Enter your username: <input type="text" name="username" id="subject" value="">
									
										<input class="hidden" id="hiddenLVL" type="text" name="level">
										<input class="hidden" id="hiddenNumber" type="text" name="mexNum">
									
				<input type="submit" name="submitButton">
			</form>
		
		
		
		
			
		<?PHP
		
		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "TrumpGame";

			
			
		
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			if($conn->connect_error){
				
			}
			
			$sql = "SELECT Username, Level, MexicansCaught
					FROM LeaderBoard
					ORDER BY Username DESC
					LIMIT 5;";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				 // output data of each row
				 while($row = $result->fetch_assoc()) {
					 echo "<br> ". $row["Username"]. " &nbsp". $row["Level"]. " " . $row["MexicansCaught"] . "<br>";
				 }
			} else {
				echo "0 results";
			}
			
			?>
		
		
		
			<button onclick="$('#LeaderBoard').hide();">Hide</button>
		
		</div>
		
        <button onclick="$('#LeaderBoard').show()">Show Leaderboard</button>
        </div>
        <div id="info">
            <p>The Donald has been elected! He needs your help to build that wall! Launch bricks at the Mexican resistance to build up your wall, catch Mexicans to prevent your wall from being destroyed! Move with arrow keys, fire with the space bar.</p>
            <p><a id="muteLink" href="#" onclick="toggleMute()">mute</a> | 
                <a href="http://github.com/dwmkerr/spaceinvaders">spaceinvaders on github</a> | 
                <a href="http://www.dwmkerr.com/experiments">more experiments</a> | <a href="http://www.dwmkerr.com">dwmkerr.com</a></p>
        </div>
		<script src="js/jquery.js"></script>
        <script src="js/starfield.js"></script>
        <script src="js/spaceinvaders.js"></script>
        <script>

            //  Create the starfield.
            var container = document.getElementById('starfield');
            var starfield = new Starfield();
            starfield.initialise(container);
            starfield.start();

            //  Setup the canvas.
            var canvas = document.getElementById("gameCanvas");
            canvas.width = 800;
            canvas.height = 600;

            //  Create the game.
            var game = new Game();

            //  Initialise it with the game canvas.
            game.initialise(canvas);

            //  Start the game.
            game.start();

            //  Listen for keyboard events.
            window.addEventListener("keydown", function keydown(e) {
                var keycode = e.which || window.event.keycode;
                //  Supress further processing of left/right/space (37/29/32)
                if(keycode == 37 || keycode == 39 || keycode == 32) {
                    e.preventDefault();
                }
                game.keyDown(keycode);
            });
            window.addEventListener("keyup", function keydown(e) {
                var keycode = e.which || window.event.keycode;
                game.keyUp(keycode);
            });

            function toggleMute() {
                game.mute();
                document.getElementById("muteLink").innerText = game.sounds.mute ? "unmute" : "mute";
            }
        </script>
		
		
			
		
		
    </body>
</html>