<footer>

        <div class="contact">
            <p><i class="fa-solid fa-circle-envelope"></i></p>
            <p>Nom de l'entreprise</p>
            <p>Benjamin Müller</p>
            <p>@ : Easy
                utarde@gmail.com</p>
        </div>
    </footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/app.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>

</html>

<?php
    if(isset($_POST['apanier'])){
        header("addpanier.php?id=<?= $produit->id; ?>");
        header("index.php");
    }
?>

