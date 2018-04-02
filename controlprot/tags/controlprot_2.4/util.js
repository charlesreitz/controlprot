//########## MASCARA PARA DATAS ###########
function DigitaData(campo) {


var data = new String( campo.value );
var wData = '';
var cont = 0;

for (i=0; i<data.length ; i++) {
        if (i <= 1) {
            if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
                wData += data.charAt(i);
                }else{
                    cont++;
                    }
        }

        if (i == 2) {
            if ( data.charAt(i) == '/' ) {
                wData += data.charAt(i);
                }else {
                    if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
                        wData += '/';
                        wData += data.charAt(i);
                        cont ++;
                        }else {
                            wData += '/';
                            cont ++;
                            } 
                }
         }

        if (i > 2 && i <= 4) {
            if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
                wData += data.charAt(i);
                }else{
                    cont++;
                    }
        }

        if (i == 5) {
            if ( data.charAt(i) == '/' ) {
                wData += data.charAt(i);
                }else {
                     if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
                     wData += '/';
                     wData += data.charAt(i);
                     cont++;
                     }else {
                        wData += '/';
                        cont++;
                        }
                }
         }

        if (i > 5 && i <= 9) {
            if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
            wData += data.charAt(i);
            }else{
                cont++;
                }
        }

        if (i > 9 ){
            cont++;
            }
}//fim do for

if ( cont > 0 ){
    // Atualiza o campo
    campo.value = wData;
    }
}

//__________________________________________________________



//*********FUNCÇÃO PARA APARECER E DESAPARECER DIV ADM************
function trocar(tipo){
		var Layer = document.getElementById("central");

        if (tipo == 1){
			Layer.style.visibility = 'visible';
		} else {
			Layer.style.visibility = 'hidden';
		}
}
//_____________________________________________________________

