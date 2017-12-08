/* CSE326 : Web Application Development
 * Lab 10 - Maze Assignment
 * 이   름: 김   종  수
 * 학   번: 2010048128
 */

"use strict";

var loser = null;  // whether the user has hit a wall

window.onload = function() {
	$("start").observe("click", startClick);
};

// called when mouse enters the walls;
// signals the end of the game with a loss
function overBoundary(event) {
	var boundary = $$("div.boundary");
	for (var i = 0; i < boundary.length; i++) {
		if (!boundary[i].hasClassName("invalid")) {
			boundary[i].addClassName("youlose");
		}
	}
	$("status").innerHTML = "You lose! Press \"S\" to restart.";

	$("maze").stopObserving("mouseleave", overBody);
	$("end").stopObserving("mouseover", overEnd);
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
	$("maze").observe("mouseleave", overBody);
	var boundary = $$("div.boundary");
	for (var i = 0; i < boundary.length; i++) {
		boundary[i].observe("mouseover", overBoundary);
	}
	$("end").observe("mouseover", overEnd);

	var boundary = $$("div.boundary");
	for (var i = 0; i < boundary.length; i++) {
		boundary[i].removeClassName("youlose");
	}
	$("status").innerHTML = "Start";
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
	$("status").innerHTML = "You win!";

	$("maze").stopObserving("mouseleave", overBody);
	var boundary = $$("div.boundary");
	for (var i = 0; i < boundary.length; i++) {
		boundary[i].stopObserving("mouseover", overBoundary);
	}
	$("end").stopObserving("mouseover", overEnd);
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
	var boundary = $$("div.boundary");
	for (var i = 0; i < boundary.length; i++) {
		if (!boundary[i].hasClassName("invalid")) {
			boundary[i].addClassName("youlose");
		}
	}
	$("status").innerHTML = "You cheat! Press \"S\" to restart.";

	var boundary = $$("div.boundary");
	for (var i = 0; i < boundary.length; i++) {
		boundary[i].stopObserving("mouseover", overBoundary);
	}
	$("end").stopObserving("mouseover", overEnd);
}



