// When creating a scorecard if the user is playing a golf course they have already played 
// they must pick the option to either select tees they have already played or create new tees
// if they are creating new tees then they also have to put rating and slope
// this toggles either showing radio button of all old tees or creating a new tee with rating and slope
// in the function you pass if you want to show it as display block or none
function toggleTees(display) {
    var toggleTees = document.getElementById("toggleTees");
    toggleTees.style.display = display;
  }

