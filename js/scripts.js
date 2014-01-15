jQuery(function ($) {
    /*
jQuery.fn.selText = function() {
        var doc = this[0];
        var element = this[0];
        console.log(element);
        var text = $(element).text();//doc.getElementById(element);
        var range, selection;
        
        selection = window.getSelection();        
        range = doc.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
        return this;
    }
    
*/

    /*
jQuery.fn.selectText = function(){
        console.log('ssss');
        var doc = document
            , element = this[0]
            , range, selection
        ;
        if (doc.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } else if (window.getSelection) {
            selection = window.getSelection();        
            range = document.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
        }
        return this;
    };
*/
    
    
    console.log('pewpew');
    
    /*********************
    * make "Pre" elements tab-able
    *********************/
    $('pre').attr('tabindex', 1);
    
    $('pre').focus(function(){
        //$(this).selectText();
        var selObj = window.getSelection();
        var elem = $(this);
        var something = selObj.selectAllChildren(elem);
        console.log(something);
    });
    
    
    
});

/*
function selectText(element) {
    var doc = document
        , text = doc.getElementById(element)
        , range, selection
    ;    
    if (doc.body.createTextRange) { //ms
        range = doc.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) { //all others
        selection = window.getSelection();        
        range = doc.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}
*/