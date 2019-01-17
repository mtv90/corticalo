function openNav() {
    document.getElementById("myNav").style.height = "100%";
  }
  
function closeNav() {
  let  selectedItem = document.getElementById("myNav");
  selectedItem.style.height = "0%";
}
//////////////////////////////////////////////////////////////////
// Funktionalität für die Konfiguration bzw Erstellung einer Frage
let type;

  function showFormats(type) {
      
      this.type = type;
      if (type.length == 0) { 
                document.getElementById("showFormat").innerHTML = "";
                return;
            }
      if(type == 1){
      var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("showFormat").innerHTML = this.responseText;
                  
              }
          };
          xmlhttp.open("GET", "/getformats/"+ type , true);
          xmlhttp.send();
        }else{
          document.getElementById("showFormat").innerHTML = "";
          return;
        }
   
  }
    
function showRanges(str) {

  if(this.type == 1 && (str == 6 || str == 7)) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("showRange").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "/getranges/"+ str , true);
    xmlhttp.send();
  }else{
    document.getElementById("showRange").innerHTML = "";
    return;
  }
}
  
function showUnit() {
      
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("showUnit").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "/getunits" , true);
  xmlhttp.send();
}

function removeUnit(){
  $("#unit").remove();
}
// Ende der FrageKonfiguration
//////////////////////////////
