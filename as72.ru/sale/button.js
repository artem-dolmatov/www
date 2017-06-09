jQuery.noConflict() 
 var b = document.getElementById('b');
b.onclick = function(e) {
  b.className = "button load";   
  b.innerHTML = ""; 
    
  setTimeout(function() {
      b.className = "button success";
      b.innerHTML = "<b>OK</b>";
  }, 2000);
}

var eb = document.getElementById('e');
eb.onclick = function(e) {
  eb.className = "button load";   
  eb.innerHTML = ""; 
    
  setTimeout(function() {
      eb.className = "button error";
      eb.innerHTML = "<b>X</b>";
      setTimeout(function() {
        eb.className = "button";
        eb.innerHTML = "<b>error</b>";
    }, 2000);
  }, 2000);
}