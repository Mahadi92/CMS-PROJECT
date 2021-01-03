//Tineymce script

tinymce.init({
        selector: 'textarea'
      });

// Script for select all Check Box

$(document). ready(function(){
   
    $('#selectAllBoxes').click(function(event){
       
        if(this.checked){
            
            $('.checkBoxes').each(function(){
                
               this.checked = true;
                
                
            });
            
        }else{
            
            $('.checkBoxes').each(function(){
                
               this.checked = false;
                
                
                
            });
            
        }
        
    });
    

// LODING GIF ADDING SCRIPT
    
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    
    $("body").prepend(div_box);
    
    
    $('#load-screen').delay(700).fadeOut(600, function(){
        $(this).remove(); 
    });
    
    
    
});

// User Online count
//
//function loadUsersOnline() {
//
//
//	$.get("functions.php?onlineusers=result", function(data){
//
//		$(".usersonline").text(data);
//
//
//	});
//    
//}
//
//
//setInterval(function(){
//
//	loadUsersOnline();
//
//
//},500);


























   

    
    