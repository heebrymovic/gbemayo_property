  <div class="row clearfix">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body">
                            <p class="copyright mb-0">Copyright <?php echo date('Y') ?> &copy; All Rights Reserved. <a href="" target="_blank">Gbemayo Properties And Investment</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>




<!-- Jquery Core Js --> 
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="../assets/bundles/c3.bundle.js"></script>

<script src="../assets/plugins/YoutubePopUp/YouTubePopUp.min.js"></script>

<script src="../assets/bundles/mainscripts.bundle.js"></script>
<script src="../assets/bundles/index.js"></script>
<script src="../assets/bundles/datatablescripts.bundle.js"></script>




<script>
        
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(".youtubePopup").YouTubePopUp();
    
    $(document).ready(function() {
            $('#datatables').DataTable({});

    });

      var click = 0;

    copyData.addEventListener("click", copyToClipBoard);
    
    function copyToClipBoard(e) {

        var defaults = this.innerHTML;

        if (click == 1 ) return

        click++;

        let copyInput = document.querySelector("#copyInput");

        copyInput.style.display = 'block'
        
        copyInput.select();

         document.execCommand('copy');

         this.innerHTML = "Copied"

         copyInput.style.display = 'none'

         setTimeout(() => {
            this.innerHTML = defaults;
            click = 0;
         }, 1000)
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

   
</script>

</body>


</html>