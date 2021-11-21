

// let c=document.getElementById('xx');
// let d=document.getElementById('y');
// let ei=document.getElementById('x');
// let f=document.getElementById('pass');
// c.addEventListener('click' ,funu);
// function funu(){

// if(f.type==="password")
// {
//     f.type="text";
//     d.style=" display: block";
//     ei.style=" display: none"

    
// }
// else{
//     f.type="password";
    
//     d.style=" display:none";
//     ei.style=" display: block"

// }
// }

document.getElementById('sub').addEventListener("click", check);
let name= document.getElementById("uname");
name.addEventListener('change',cng);
function cng(e){
    $.ajax({

  url:"dup.php",
  method:'POST',
  data:{
    "username":this.value
  },
  async:false,


    }).done(c=>{

    c=  JSON.parse(c);
 
        if(c['suc']==true){
            let x= document.createElement("div");
            x.classList.add("samle");
            x.appendChild(document.createTextNode("not available"));
            let con =document.getElementById('ff');
            let par=document.getElementsByClassName('frm')[0];
            par.insertBefore(x,con);
      
          setTimeout(() => {
              x.remove();
          }, 3000);
        }
        else{
            let x= document.createElement("div");
            x.classList.add("samle");
            x.appendChild(document.createTextNode("availabe"));
            let con =document.getElementById('ff');
            let par=document.getElementsByClassName('frm')[0];
            par.insertBefore(x,con);
      
          setTimeout(() => {
              x.remove();
          }, 3000);
        }

    });
}
function check(e){
    


     if(name.value==""){
      let x= document.createElement("div");
      x.classList.add("samle");
      x.appendChild(document.createTextNode("value de"));
      let con =document.getElementById('ff');
      let par=document.getElementsByClassName('frm')[0];
      par.insertBefore(x,con);

    setTimeout(() => {
        x.remove();
    }, 3000);

         
     }
    e.preventDefault();
}
    
 


