setTimeout((function(){let e=document.querySelectorAll(".alerta");for(let t=0;t<e.length;t++){const r=e[t];r.parentElement.removeChild(r)}}),1e4);const mobileMenuBtn=document.querySelector("#mobile-menu"),cerrarMenuBtn=document.querySelector("#cerrar-menu"),sidebar=document.querySelector(".sidebar");mobileMenuBtn&&mobileMenuBtn.addEventListener("click",(function(){sidebar.classList.add("mostrar")})),cerrarMenuBtn&&cerrarMenuBtn.addEventListener("click",(function(){sidebar.classList.add("ocultar"),setTimeout(()=>{sidebar.classList.remove("mostrar"),sidebar.classList.remove("ocultar")},1e3)})),window.addEventListener("resize",(function(){document.body.clientWidth>=768&&sidebar.classList.remove("mostrar")}));