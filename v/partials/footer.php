</div>
<footer class="footer">
    <div class="container">
        <div class="footer-links">
            <a href="<?php echo 'index.php?controller=Business&action=tos'; ?>">
              &copy; 2023 又来®
            </a>
            <a href="#" id="wechat-link">Wechat</a>
            <div id="myModal" class="modal">
              <span class="close">&times;</span>
              <img class="modal-content" id="img01">
              <div id="caption"></div>
            </div>
        </div>
    </div>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal
    var img = document.getElementById("wechat-link");
    var modalImg = document.getElementById("img01");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = 'http://ulike.vip/v/partials/wechat.png';
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }
</script>
</footer>
</body>
</html>