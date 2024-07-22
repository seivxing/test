<style>
    .li-classone:hover {
        color: rgb(0, 0, 0);
        font-weight: bold;

    }

    .li-classtwo:hover {
        color: rgb(0, 0, 0);
        font-weight: bold;

    }

    .li-classthree:hover {
        color: rgb(0, 0, 0);
        font-weight: bold;

    }

    .li-classfour:hover {
        color: rgb(0, 0, 0);
        font-weight: bold;

    }

    .li-classfive:hover {
        color: rgb(0, 0, 0);
        font-weight: bold;

    }


    .li-classone {
        font-family: cursive;
        font-size: 20px
    }

    .li-classtwo {
        font-family: cursive;
        font-size: 20px
    }

    .li-classthree {
        font-family: cursive;
        font-size: 20px
    }

    .li-classfour {
        font-family: cursive;
        font-size: 20px
    }

    .li-classfive {
        font-family: cursive;
        font-size: 20px;
    }
</style>

<div class="footer-basic" style="background-color:transparent; margin-top:20px">
    <footer>
        <div class="social">
            <a style="color: aqua ;border:none" href="https://www.twitter.com/"><i class="icon-twitter"></i></a>
            <a style="color: orange;border:none" href="https://www.instagram.com/"><i class="icon-instagram"></i></a>
            <a style="color: rgb(43, 169, 248);border:none" href="https://www.facebook.com/BTBPCGAMES/"><i
                    class="icon-facebook"></i></a>
            <a style="color: lightgreen;border:none" href="#"><i class="icon-phone"></i></a>
        </div>
        <ul class="list-inline ">
            <li class="list-inline-item li-classone"><a href="#">Home</a></li>
            <li class="list-inline-item li-classtwo"><a href="#">Services</a></li>
            <li class="list-inline-item li-classthree"><a href="#">About</a></li>
            <li class="list-inline-item li-classfour"><a href="#">Terms</a></li>
            <li class="list-inline-item li-classfive"><a href="#">Privacy Policy</a></li>
        </ul>
        <p style="font-size: 15px" class="copyright">BTB PC © <span id="year"></span></p>
    </footer>
    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>
</div>
