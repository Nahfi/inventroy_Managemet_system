$(function(){
    'use strict';



    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });




});

let c=document.getElementById('xx');
let d=document.getElementById('y');
let ei=document.getElementById('x');
let f=document.getElementById('pass');
c.addEventListener('click' ,funu);
function funu(){

if(f.type==="password")
{
    f.type="text";
    d.style=" display: block";
    ei.style=" display: none"

    
}
else{
    f.type="password";
    
    d.style=" display:none";
    ei.style=" display: block"

}
    
 
}

