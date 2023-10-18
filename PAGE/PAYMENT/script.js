var div1 = document.getElementById("1.1");
var display1 = 1


function hideshow1(){
    if (display2 == 0){
        div2.style.display = 'none' ;
        display2 = 1;
    } else if (display3 == 0){
        div3.style.display = 'none' ;
        display3 = 1;
    }

    if (display1 == 1){
        div1.style.display = 'block' ;
        display1 = 0;
    }
    else{
        div1.style.display = 'none' ;
        display1 = 1;
    }

}


var div2 = document.getElementById("2.1");
var display2 = 1

function hideshow2(){
    if (display1 == 0){
        div1.style.display = 'none' ;
        display1 = 1;
    }else if (display3 == 0){
        div3.style.display = 'none' ;
        display3 = 1;
    }

    if (display2 == 1){
        div2.style.display = 'block' ;
        display2 = 0;
    }
    else{
        div2.style.display = 'none' ;
        display2 = 1;
    }

}

var div3 = document.getElementById("3.1");
var display3 = 1

function hideshow3(){
    if (display1 == 0){
        div1.style.display = 'none' ;
        display1 = 1;
    }else if (display2 == 0){
        div2.style.display = 'none' ;
        display2 = 1;
    }

    if (display3 == 1){
        div3.style.display = 'block' ;
        display3 = 0;
    }
    else{
        div3.style.display = 'none' ;
        display3 = 1;
    }

}

