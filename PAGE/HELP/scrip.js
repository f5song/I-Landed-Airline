var div = document.getElementById("text-q1");
var div2 = document.getElementById("text-q2");
var div3 = document.getElementById("text-q3");
var div4 = document.getElementById("text-q4");
var div5 = document.getElementById("text-q5");

var display=1
var display2=1
var display3=1
var display4=1
var display5=1

function hideshow1(){
    if (display == 1){
        div.style.display = 'block' ;
        display = 0;
    }
    else{
        div.style.display = 'none' ;
        display = 1;
    }

}

function hideshow2(){
    if (display2 == 1){
        div2.style.display = 'block' ;
        display2 = 0;
    }
    else{
        div2.style.display = 'none' ;
        display2 = 1;
    }

}

function hideshow3(){
    if (display3 == 1){
        div3.style.display = 'block' ;
        display3 = 0;
    }
    else{
        div3.style.display = 'none' ;
        display3 = 1;
    }

}

function hideshow4(){
    if (display4 == 1){
        div4.style.display = 'block' ;
        display4 = 0;
    }
    else{
        div4.style.display = 'none' ;
        display4 = 1;
    }

}

function hideshow5(){
    if (display5 == 1){
        div5.style.display = 'block' ;
        display5 = 0;
    }
    else{
        div5.style.display = 'none' ;
        display5 = 1;
    }

}