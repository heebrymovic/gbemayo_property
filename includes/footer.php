

            <div class="row clearfix">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="body">
                            <p class="copyright mb-0">Copyright <?php echo date("Y") ?> © All Rights Reserved. <a href="https://gbemayoproperties.com" target="_blank">Gbemayo Properties</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/bundles/apexcharts.bundle.js"></script>
<script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/ecommerce.js"></script>
<script src="https://www.thememakker.com/templates/amaze/html/js/pages/charts/jquery-knob.min.js"></script>
<script src="assets/plugins/YoutubePopUp/YouTubePopUp.min.js"></script>

<script>
	
	 if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(".youtubePopup").YouTubePopUp();
    
    $(document).ready(function() {
            $('#datatables').DataTable({});

    });

    var click = 0;

 	copyData?.addEventListener("click", copyToClipBoard);
    
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

      
</script>
</body>

<!-- Mirrored from www.thememakker.com/templates/amaze/html/dist/ec-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Apr 2023 12:21:46 GMT -->
</html>