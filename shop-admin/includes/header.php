 <?php if (isset($_SESSION['adminid'])=='') {
    header("Location: login.php"); 
    exit();
 }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="icon" href="../img/favicon.png" type="image/x-icon">
<style>
    label{
        color: navy;
        font-size:20px;
    }
    body{
     background:lightblue;
    }
    thead{
        background:grey;
    }
    /*page loader css*/
 :root {
   --hue: 223;
   --bg: hsl(var(--hue), 10%, 90%);
   --fg: hsl(var(--hue), 10%, 10%);
   --primary:#76ABAE;
   --trans-dur: 0.3s;
}

.loader-div {
   background-color: var(--bg);
   color: var(--fg);
 
   height: 100vh;
   display: grid;
   place-items: center;
   transition: background-color var(--trans-dur), color var(--trans-dur);
}

.fullpage-loader .preloader {
   text-align: center;
   max-width: 20em;
   width: 100%;
}

.fullpage-loader .preloader__text {
   position: relative;
   height: 1.5em;
}

.fullpage-loader .preloader__msg {
   animation: msg 0.3s 13.7s linear forwards;
   position: absolute;
   width: 100%;
}

.fullpage-loader .preloader__msg--last {
   animation-direction: reverse;
   animation-delay: 14s;
   visibility: hidden;
}

.fullpage-loader .cart {
   display: block;
   margin: 0 auto 1.5em auto;
   width: 8em;
   height: 8em;
}

.fullpage-loader .cart__lines,
.fullpage-loader .cart__top,
.fullpage-loader .cart__wheel1,
.fullpage-loader .cart__wheel2,
.fullpage-loader .cart__wheel-stroke {
   animation: cartLines 2s ease-in-out infinite;
}

.fullpage-loader .cart__lines {
   stroke: var(--primary);
}

.fullpage-loader .cart__top {
   animation-name: cartTop;
}

.fullpage-loader .cart__wheel1 {
   animation-name: cartWheel1;
   transform: rotate(-0.25turn);
   transform-origin: 43px 111px;
}

.fullpage-loader .cart__wheel2 {
   animation-name: cartWheel2;
   transform: rotate(0.25turn);
   transform-origin: 102px 111px;
}

.fullpage-loader .cart__wheel-stroke {
   animation-name: cartWheelStroke;
}

.fullpage-loader .cart__track {
   stroke: hsla(var(--hue), 10%, 10%, 0.1);
   transition: stroke var(--trans-dur);
}

/* Dark theme */
@media (prefers-color-scheme: dark) {
   :root {
       --bg: hsl(var(--hue), 10%, 10%);
       --fg: hsl(var(--hue), 10%, 90%);
   }

   .fullpage-loader .cart__track {
       stroke: hsla(var(--hue), 10%, 90%, 0.1);
   }
}

/* Animations */
@keyframes msg {
   from {
       opacity: 1;
       visibility: visible;
   }

   99.9% {
       opacity: 0;
       visibility: visible;
   }

   to {
       opacity: 0;
       visibility: hidden;
   }
}

@keyframes cartLines {
   from,
   to {
       opacity: 0;
   }

   8%,
   92% {
       opacity: 1;
   }
}

@keyframes cartTop {
   from {
       stroke-dashoffset: -338;
   }

   50% {
       stroke-dashoffset: 0;
   }

   to {
       stroke-dashoffset: 338;
   }
}

@keyframes cartWheel1 {
   from {
       transform: rotate(-0.25turn);
   }

   to {
       transform: rotate(2.75turn);
   }
}

@keyframes cartWheel2 {
   from {
       transform: rotate(0.25turn);
   }

   to {
       transform: rotate(3.25turn);
   }
}

@keyframes cartWheelStroke {
   from,
   to {
       stroke-dashoffset: 81.68;
   }

   50% {
       stroke-dashoffset: 40.84;
   }
}

.fullpage-loader--invisible {
   opacity: 0;
   transition: opacity 0.5s ease-out;
}

.fullpage-loader {
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: rgb(255, 255, 255);
   display: flex;
   justify-content: center;
   align-items: center;
   z-index: 1000;
}
/*end page loader*/
</style>
    </head>
    <body class="sb-nav-fixed">
    <div class="loader-div fullpage-loader">
        <div class="preloader">
            <svg class="cart" role="img" aria-label="Shopping cart line animation" viewBox="0 0 128 128" width="128px"
                height="128px" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="8">
                    <g class="cart__track" stroke="hsla(0,10%,10%,0.1)">
                        <polyline points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" />
                        <circle cx="43" cy="111" r="13" />
                        <circle cx="102" cy="111" r="13" />
                    </g>
                    <g class="cart__lines" stroke="currentColor">
                        <polyline class="cart__top" points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80"
                            stroke-dasharray="338 338" stroke-dashoffset="-338" />
                        <g class="cart__wheel1" transform="rotate(-90,43,111)">
                            <circle class="cart__wheel-stroke" cx="43" cy="111" r="13" stroke-dasharray="81.68 81.68"
                                stroke-dashoffset="81.68" />
                        </g>
                        <g class="cart__wheel2" transform="rotate(90,102,111)">
                            <circle class="cart__wheel-stroke" cx="102" cy="111" r="13" stroke-dasharray="81.68 81.68"
                                stroke-dashoffset="81.68" />
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </div>
    <!-- Loader End -->
    <?php include ('includes/navbar-top.php'); ?>
    <div id="layoutSidenav">
    <?php include ('includes/sidebar.php'); ?>
    <div id="layoutSidenav_content">
                <main>
               