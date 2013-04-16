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
function formtype(type,url) {
	if(type=="fasilitas"){
	$('#reservasitgl').show();
	$('#eventjumlah').hide();
	}
	else{
	$('#reservasitgl').hide();
	$('#eventjumlah').show();
	}
	$.ajax({
	url: url+"form.php?type="+type,
	type:'GET',
	dataType:'html',
	success: function(msg){
    $('#ajaxdata').html(msg);
	$('#ajaxdata2').html("");
       }
	});
	
}
function package(type,url) {
	$.ajax({
	url: url+"form.php?type=package&id="+type,
	type:'GET',
	dataType:'html',
	success: function(msg){
    $('#ajaxdata2').html(msg);
       }
	});
}
function hargaevent(type,url) {
	$.ajax({
	url: url+"form.php?type=hargaevent&id="+type,
	type:'GET',
	dataType:'json',
	success: function(data){
							$('#jumlahevent').val("1");
							$('#total').val(data.harga);
							$('#hargaevents').val(data.harga);
							$('#hargangumpet').val(data.ngumpet);
							$('#hargadollar').val(data.paypall);
							$('#hargarupiah').val(data.rp);
							$('#totalrupiah').val(data.rp);
							$('#totaldolar').val(data.paypall);					  				
							
       }
	});
}
function tarif(id,url){
							$.ajax({
							url:  url+"form.php?type=harga&id="+$("#package1").val(),
							type:'GET',
							dataType: 'json',
							success: function(data){
							//alert(data.harga);
							$('#harga1').val(data.harga);
							$('#hargadolar1').val(data.paypall);
							$('#hargarupiah1').val(data.rp);
							$('#hargangumpet1').val(data.ngumpet);
							$('#jumlah1').val("1");
							$('#total').val(data.harga);
							$('#totalrupiah').val(data.rp);
							$('#totaldolar').val(data.paypall);
							hitunghasil();
							   }
							});
}


function titikKeKoma(obj){
    var a=obj.toString();
    var b='';
    if(a!=null){
        b=a.replace(/\./g,',');
    }
    return b;
}

function komaKeTitik(obj){
    var a=obj.toString();
    var b='';
    if(a!=null){
        b=a.replace(/\,/g,'.');
    }
    return b;
}

function numberToCurrency(a){
       if(a!=''&&a!=null){
       a=a.toString();       
        var b = a.replace(/[^\d\,]/g,'');
		var dump = b.split(',');
        var c = '';
        var lengthchar = dump[0].length;
        var j = 0;
        for (var i = lengthchar; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                        c = dump[0].substr(i-1,1) + '.' + c;
                } else {
                        c = dump[0].substr(i-1,1) + c;
                }
        }
		
		if(dump.length>1){
			if(dump[1].length>0){
				c += ','+dump[1];
			}else{
				c += ',';
			}
		}
    return c;}
    else{
        return '';
    }
}



function numberToCurrency2(a){
        if(a!=null&&!isNaN(a)){
        //var b=Math.ceil(parseFloat(a));
        var b=parseInt(a);
        var angka=b.toString();        
        var c = '';    
        var lengthchar = angka.length;
        var j = 0;
        for (var i = lengthchar; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                        c = angka.substr(i-1,1) + '.' + c;
                } else {
                        c = angka.substr(i-1,1) + c;
                }
        }        
        return c;
    }else{
        return '';
    }
}

function floatToCurrency(a){
    if(a!=''&&a!=null){
       a=a.toString();       
       var b = a.replace(/[^\d\.]/g,'');
       var temp=a.split('.');
       if(temp.length>1){
           return numberToCurrency2(temp[0])+','+temp[1];
       }else{
           return numberToCurrency2(b);
       }
       
    }else{
        return '';
    }    
}

function currencyToNumber(a){
    var b=a.toString();
    
    var c='';
    if(a!=null||a!=''){
        c=b.replace(/\.+/g, '');
    }
    
    return parseFloat(komaKeTitik(c));
}

function batasiAngka(angka,digit){
    return angka.toFixed(digit);
}

function rekber(){
	$.ajax({
	  url: "rekber.html",
	  cache: false,
	  success: function(html){
		 $("#element_to_pop_up").html(html);
	   $('#element_to_pop_up').bPopup({
            modalColor: '#000000',
			 speed: 450,
            transition: 'slideDown'
        });
	  }
	});
}
