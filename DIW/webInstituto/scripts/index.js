
/**
 * index.js
 * - All our useful JS goes here, awesome!
 */
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 1000*60); // Change image every 60 seconds
}

console.log("JavaScript is amazing!");
i = 5;
while(i--){
  console.log(i);
}

jQuery(function($){
    $('.matchheight').matchHeight();
});