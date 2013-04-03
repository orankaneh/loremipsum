function Angka(obj) {
        a = obj.value;
        b = a.replace(/[^\d]/g,'');
        c = '';
        lengthchar = b.length;
        j = 0;
        for (i = lengthchar; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                        c = b.substr(i-1,1) + '' + c;
                } else {
                        c = b.substr(i-1,1) + c;
                }
        }
        obj.value = c;
}
function Desimal(obj){
    a=obj.value;   
    var reg=new RegExp(/[0-9]+(?:\.[0-9]{0,2})?/g)
    b=a.match(reg,'');
    if(b==null){
        obj.value='';
    }else{
        obj.value=b[0];
    }
    
}
function Desimal2(obj){
    a=obj.value;   
    var reg=new RegExp(/[0-9]+(?:\.[0-9])?/g)
    b=a.match(reg,'');
    if(b==null){
        obj.value='';
    }else{
        obj.value=b[0];
    }
    
}