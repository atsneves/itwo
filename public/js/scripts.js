function verifica_extencao(obj) {
    var extensoesOk = ",.gif,.jpg,.bmp,.png,.jpeg";
    var extensao = "," + obj.val().substr( obj.val().length - 4 ).toLowerCase() + ",";

    if(extensoesOk.indexOf(extensao) == -1){
        if(',jpeg,' == extensao){
            return true;
        }else{
            return false;
        }
    }else{	
        return true;
    }
}