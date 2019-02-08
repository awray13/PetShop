        
function myFunction() {
    var x = document.getElementById("responsiveNavBar");
    if (x.className === "navbar") {
        x.className += " responsive";
        //lower the pets image location so the nav bar doesn't overlap the image.
        document.getElementById("pets").style.top = "600px";

    } else {
        x.className = "navbar";
        //raise the pets image location so the nav bar doesn't overlap the image.
        document.getElementById("pets").style.top = "200px";
    }

}
    