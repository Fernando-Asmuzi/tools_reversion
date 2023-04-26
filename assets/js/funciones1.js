// para Pantalla de Login
function Desaparece(caja) {
  if(caja == 'login'){
    var l = document.getElementById('login');
    l.className = "d-block"
    var o = document.getElementById("olvido");
    o.className = "d-none"
    var c = document.getElementById("cuenta");
    c.className = "d-none"
    var e = document.getElementById("enviado");
    e.className = "d-none"
  }

  if(caja == 'olvido'){
    var l = document.getElementById('login');
    l.className = "d-none"
    var o = document.getElementById("olvido");
    o.className = "d-block"
    var c = document.getElementById("cuenta");
    c.className = "d-none"
    var e = document.getElementById("enviado");
    e.className = "d-none"
  }
    
  if(caja == 'cuenta'){
    var l = document.getElementById('login');
    l.className = "d-none"
    var o = document.getElementById("olvido");
    o.className = "d-none"
    var c = document.getElementById("cuenta");
    c.className = "d-block"
    var e = document.getElementById("enviado");
    e.className = "d-none"
  }

  if(caja == 'enviado'){
    // Obtengo valor del Email
    var valor_email = document.getElementById("email0").value;

    var l = document.getElementById('login');
    l.className = "d-none"
    var o = document.getElementById("olvido");
    o.className = "d-none"
    var c = document.getElementById("cuenta");
    c.className = "d-none"
    var e = document.getElementById("enviado");
    e.className = "d-block"
    // Muestro Email 
    document.getElementById("email1").innerHTML = valor_email;

  }
}
function clipboard(idelemento){
  var aux = document.createElement("div");
  aux.setAttribute("contentEditable", true);
  aux.innerHTML = document.getElementById(idelemento).innerHTML;
  aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
  document.body.appendChild(aux);
  aux.focus();
  document.execCommand("copy");
  document.body.removeChild(aux);
}
function limpiar_formulario(limpito){
  document.getElementById(limpito).reset();
  document.getElementById("text1").innerHTML = "";
}

$(document).ready(function() {
  const temp = [{
      "id": 1,
      "name": "Aguascalientes"
    },
    {
      "id": 2,
      "name": "Baja California"
    },
    {
      "id": 3,
      "name": "Baja California Sur"
    },
    {
      "id": 4,
      "name": "Campeche"
    },
    {
      "id": 5,
      "name": "Coahuila"
    },
    {
      "id": 6,
      "name": "Colima"
    },
    {
      "id": 7,
      "name": "Chiapas"
    },
    {
      "id": 8,
      "name": "Chihuahua"
    },
    {
      "id": 9,
      "name": "Distrito Federal"
    },
    {
      "id": 10,
      "name": "Durango"
    },
    {
      "id": 11,
      "name": "Guanajuato"
    },
    {
      "id": 12,
      "name": "Guerrero"
    },
    {
      "id": 13,
      "name": "Hidalgo"
    },
    {
      "id": 14,
      "name": "Jalisco"
    },
    {
      "id": 15,
      "name": "México"
    },
    {
      "id": 16,
      "name": "Michoacán"
    },
    {
      "id": 17,
      "name": "Morelos"
    },
    {
      "id": 18,
      "name": "Nayarit"
    },
    {
      "id": 19,
      "name": "Nuevo León"
    },
    {
      "id": 20,
      "name": "Oaxaca"
    },
    {
      "id": 21,
      "name": "Puebla"
    },
    {
      "id": 22,
      "name": "Querétaro"
    },
    {
      "id": 23,
      "name": "Quintana Roo"
    },
    {
      "id": 24,
      "name": "San Luis Potosí"
    },
    {
      "id": 25,
      "name": "Sinaloa"
    },
    {
      "id": 26,
      "name": "Sonora"
    },
    {
      "id": 27,
      "name": "Tabasco"
    },
    {
      "id": 28,
      "name": "Tamaulipas"
    },
    {
      "id": 29,
      "name": "Tlaxcala"
    },
    {
      "id": 30,
      "name": "Veracruz"
    },
    {
      "id": 31,
      "name": "Yucatán"
    },
    {
      "id": 32,
      "name": "Zacatecas"
    }
  ];
  var $select = $('#estados');

  //alert(options);
  $.each(temp, function(id, name) {
    $select.append('<option value=' + name.id + '>' + name.name + '</option>');
  });
});







  // Rutinas de Ejemplo
  // if (x.style.display === "none") {
  //     x.style.display = "block";
  // } else {
  //     x.style.display = "none";
  // }

  // $(document).ready(function(){
  //   $('.usuario').val("Hola ");
  // })
