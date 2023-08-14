const formulario = document.getElementById('form1');
const input = document.getElementById('#form1 input');



const validacion = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}

// para recibir erl name de cada campo
const Validarel_formulario = () => {
    
    switch ( e.target.name){
        // el case nos dice: en caso de que el name sea "usuario entonces"
        
            case "documento":
            // se pone un if para que nos valide el name con la la constante validaciones
            if (validacion.documento.test(e.target.value)){

                
            }else{

                document.getElementById('grupo_documento').classList.add('imput_completo-incorrecto')
            }


        // el break lo que hace es romper el array o la funcion del case 
        break;
 
        case "usu":



        // el break lo que hace es romper el array o la funcion del case 
        break;

        case "contra":



        // el break lo que hace es romper el array o la funcion del case 
        break;

    }
}
// un evventro que valide en todos los imputs con el foreach
input.forEach((input) =>  {
    input.addEventListener('keyup', Validarel_formulario );
    input.addEventListener('blur', Validarel_formulario );   
   
});



formulario.addEventListener('submit', (e)=>{
    e.preventDefault();
    // el prevent default es para evitar que los datos se envien si está validos
});







// video viejo

var documento = document.getElementById('doc');
var usuario = document.getElementById('usuario');
var contrase = document.getElementById('password');
var errores = document.getElementById('error');
errores.style.color = 'azul';


function ingresar() {
    console.log('Validando formulario')


    return false

}


var fomulario = document.getElementById('form1');
fomulario.addEventListener('submit', function(validar) {
    validar.preventDefault

    // variable o arreglo que va a mostrar el mensaje de error
    var meserror = [];
    if (documento.value == null || documento.value == '') {
        meserror.push('Digite su Documento')
    }

    if (usuario.value == null || documento.value == '') {
        meserror.push('Digite su Usuario')
    }

    if (contrase.value == null || documento.value == '') {
        meserror.push('Digite la Contraseña')
    }

    // comvertira la variable en cadena de Texto 
    errores.innerHTML = meserror.join(',');
    // aqui se va a usar el div con el id de errores para poder mostrarlo en pantalla

})