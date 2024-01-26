(function () {
    "use strict";
    
    var myElement = document.getElementById('sidebar-scroll');
    console.log(myElement);
    new SimpleBar(myElement, { autoHide: true });
    
})();