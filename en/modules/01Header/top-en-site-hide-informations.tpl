<script type="text/javascript">
   document.ondragstart = noselect;
   document.onselectstart = noselect;
   document.oncontextmenu = noselect;
   function noselect() {return false;}
</script>
<script type="text/javascript">
   document.onkeydown = function (e) {
       if (event.keyCode == 123) {
           return false;
       }
       if (e.ctrlKey && e.shiftKey && e.keyCode == "I".charCodeAt(0)) {
           return false;
       }
       if (e.ctrlKey && e.shiftKey && e.keyCode == "J".charCodeAt(0)) {
           return false;
       }
       if (e.ctrlKey && e.keyCode == "U".charCodeAt(0)) {
           return false;
       }
   };
</script>