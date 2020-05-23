
    
    
(function($, window) {
  $(function() {
    $('select[name="region"]').change(function(){
        var regionName = $('select[name="region"] option:selected').attr("class");
        //console.log(regionName);
        
        var count = $('select[name="prefecture"]').children().length;
        //console.log(count);
        
        for(var i = 0; i<count ;i++){
            var pref = $('select[name="prefecture"] option:eq('+ i + ')');
            
            if(pref.attr("class")===regionName){
                pref.show();
            }else{
                if(pref.attr("class")==="msg"){
                    pref.show();
                    pref.prop('selected',true);
                }else{
                    pref.hide();
                }
            }
        }
    });
});
})(jQuery, window);

