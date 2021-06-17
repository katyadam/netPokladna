// JavaScript Document
console.log("start")
var cena = 0;

document.addEventListener("DOMContentLoaded", function() {
    const show = document.getElementById("show");
    const inpCena = document.getElementById("showFinCena");
    const tlacitka = document.querySelectorAll("input[type=button]");
    const showCena = document.getElementById("docCena");
    tlacitka.forEach(function(tlacitko){
        tlacitko.addEventListener("click", kliknuti);
    })
    function kliknuti(event){
        var target = event.target.value;
        
        
        var targetSplit = target.split(" "); //0 -- cena, 1 -- nazev

        show.innerHTML += targetSplit[0] + "Kč" + "</br>"; //zapsani do html cena + kč + br
        cena += parseInt(targetSplit[0]); //pokus o to aby se ze stringu stal int
        console.log(inpCena);
        inpCena.value = cena; 
        showCena.innerHTML = cena;
    }
});
