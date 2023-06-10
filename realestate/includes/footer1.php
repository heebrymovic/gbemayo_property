


<!-- Jquery Core Js --> 
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="../assets/bundles/c3.bundle.js"></script>

<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script src="../assets/bundles/index.js"></script>
<script src="../assets/bundles/datatablescripts.bundle.js"></script>

<script>

    copyData.addEventListener("click", copyToClipBoard);
    
    function copyToClipBoard(e) {

        var defaults = this.innerHTML;

        let copyInput = document.querySelector("#copyInput");

        console.log( copyInput)

        copyInput.style.display = 'block'
        
        copyInput.select();

         document.execCommand('copy');

         this.innerHTML = "Copied"

         copyInput.style.display = 'none'

         setTimeout(() => this.innerHTML = defaults, 1000)
    }

    function openFullscreen(elem) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
      }
    }
        
    $(document).ready(function() {
            $('#datatables').DataTable({});
            $('#datatables1').DataTable({});
    });
</script>

</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/realestate/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:24:58 GMT -->
</html>