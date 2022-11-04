<?php
  //This file has to do with session start/resume
  //Including it in the header file will include it to all other pages
  require_once 'Includes/session.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendance - <?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="CSS/style_index.css">
    <link rel="stylesheet" href="CSS/style_login.css">
    <link rel="stylesheet" href="CSS/style_landing.css">
    <link rel="stylesheet" href="CSS/style_record.css">
    <link rel="stylesheet" href="CSS/style_header.css">
  </head>
  <header>
  <div class="navb h-nav-resp">
        <!-- <img src="Images/logo.jpg" height="50px" width="250px"> -->
        <svg width="235" height="49" viewBox="0 0 235 49" fill="none" xmlns="http://www.w3.org/2000/svg" id="upskl">
            <g filter="url(#filter0_d_5_4)">
                <path d="M18.8182 22.0795V9.18181H22.1705V31H18.8182V27.3068H18.5909C18.0795 28.4148 17.2841 29.357 16.2045 30.1335C15.125 30.9006 13.7614 31.2841 12.1136 31.2841C10.75 31.2841 9.53787 30.9858 8.47727 30.3892C7.41666 29.7831 6.58333 28.874 5.97727 27.6619C5.37121 26.4403 5.06818 24.9015 5.06818 23.0454V9.18181H8.42045V22.8182C8.42045 24.4091 8.86553 25.678 9.75568 26.625C10.6553 27.572 11.8011 28.0454 13.1932 28.0454C14.0265 28.0454 14.874 27.8324 15.7358 27.4062C16.607 26.9801 17.3362 26.3267 17.9233 25.446C18.5199 24.5653 18.8182 23.4432 18.8182 22.0795Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M28.3104 39.1818V9.18181H31.549V12.6477H31.9467C32.1929 12.2689 32.5338 11.786 32.9695 11.1989C33.4145 10.6023 34.049 10.072 34.8729 9.60794C35.7062 9.13446 36.8331 8.89772 38.2535 8.89772C40.0907 8.89772 41.71 9.357 43.1115 10.2756C44.513 11.1941 45.6068 12.4962 46.3928 14.1818C47.1787 15.8674 47.5717 17.856 47.5717 20.1477C47.5717 22.4583 47.1787 24.4612 46.3928 26.1562C45.6068 27.8418 44.5178 29.1487 43.1257 30.0767C41.7337 30.9953 40.1285 31.4545 38.3104 31.4545C36.9088 31.4545 35.7867 31.2225 34.9439 30.7585C34.1011 30.285 33.4524 29.75 32.9979 29.1534C32.5433 28.5473 32.1929 28.0454 31.9467 27.6477H31.6626V39.1818H28.3104ZM31.6058 20.0909C31.6058 21.7386 31.8473 23.1922 32.3302 24.4517C32.8132 25.7017 33.5187 26.6818 34.4467 27.392C35.3748 28.0928 36.5111 28.4432 37.8558 28.4432C39.2573 28.4432 40.4268 28.0739 41.3643 27.3352C42.3113 26.5871 43.0215 25.5833 43.495 24.3239C43.978 23.0549 44.2195 21.6439 44.2195 20.0909C44.2195 18.5568 43.9827 17.1742 43.5092 15.9432C43.0452 14.7026 42.3397 13.7225 41.3927 13.0028C40.4552 12.2737 39.2763 11.9091 37.8558 11.9091C36.4922 11.9091 35.3464 12.2547 34.4183 12.946C33.4903 13.6278 32.7895 14.5843 32.316 15.8153C31.8426 17.0369 31.6058 18.4621 31.6058 20.0909Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M69.049 9.18181C68.8785 7.74241 68.1873 6.62499 66.9751 5.82954C65.763 5.03408 64.2763 4.63635 62.5149 4.63635C61.227 4.63635 60.1001 4.84469 59.1342 5.26135C58.1778 5.67802 57.4297 6.25094 56.8899 6.9801C56.3596 7.70927 56.0945 8.53787 56.0945 9.4659C56.0945 10.2424 56.2791 10.91 56.6484 11.4687C57.0272 12.018 57.5102 12.4773 58.0973 12.8466C58.6844 13.2064 59.2999 13.5047 59.9439 13.7415C60.5878 13.9687 61.1797 14.1534 61.7195 14.2954L64.674 15.0909C65.4316 15.2898 66.2744 15.5644 67.2024 15.9148C68.1399 16.2651 69.0348 16.7434 69.8871 17.3494C70.7488 17.946 71.459 18.7131 72.0178 19.6506C72.5765 20.5881 72.8558 21.7386 72.8558 23.1023C72.8558 24.6742 72.4439 26.0947 71.62 27.3636C70.8056 28.6326 69.6124 29.6411 68.0405 30.3892C66.478 31.1373 64.5793 31.5114 62.3445 31.5114C60.2611 31.5114 58.4571 31.1752 56.9325 30.5028C55.4174 29.8305 54.2242 28.893 53.353 27.6903C52.4912 26.4877 52.0035 25.0909 51.8899 23.5H55.5263C55.621 24.5985 55.9903 25.5076 56.6342 26.2273C57.2876 26.9375 58.1115 27.4678 59.1058 27.8182C60.1096 28.1591 61.1892 28.3295 62.3445 28.3295C63.6892 28.3295 64.8965 28.1117 65.9666 27.6761C67.0367 27.2311 67.8842 26.6155 68.5092 25.8295C69.1342 25.0341 69.4467 24.1061 69.4467 23.0454C69.4467 22.0795 69.1768 21.2936 68.6371 20.6875C68.0973 20.0814 67.3871 19.589 66.5064 19.2102C65.6257 18.8314 64.674 18.5 63.6513 18.2159L60.0717 17.1932C57.799 16.5398 55.9998 15.607 54.674 14.3949C53.3482 13.1828 52.6854 11.5966 52.6854 9.63635C52.6854 8.00756 53.1257 6.58711 54.0064 5.37499C54.8965 4.1534 56.0897 3.20643 57.5859 2.53408C59.0916 1.85226 60.7725 1.51135 62.6285 1.51135C64.5035 1.51135 66.1702 1.84753 67.6285 2.51988C69.0869 3.18275 70.2422 4.09184 71.0945 5.24715C71.9562 6.40245 72.4107 7.714 72.4581 9.18181H69.049Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M78.6477 31V1.90908H82.1704V16.3409H82.5114L95.5795 1.90908H100.182L87.9659 15.0341L100.182 31H95.9204L85.8068 17.4773L82.1704 21.5682V31H78.6477Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M108.264 1.90908V31H104.741V1.90908H108.264Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M115.327 31V1.90908H118.85V27.875H132.373V31H115.327Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M137.827 31V1.90908H141.35V27.875H154.873V31H137.827Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M172.771 1.90908L181.407 26.3977H181.748L190.384 1.90908H194.077L183.396 31H179.759L169.077 1.90908H172.771Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M202.131 1.90908V31H198.609V1.90908H202.131Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
                <path d="M207.604 5.03408V1.90908H229.422V5.03408H220.274V31H216.751V5.03408H207.604Z" stroke="#C44673" stroke-width="2" shape-rendering="crispEdges" />
            </g>
            <defs>
                <filter id="filter0_d_5_4" x="0.0681763" y="0.511353" width="234.354" height="47.6705" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="2" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_5_4" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_5_4" result="shape" />
                </filter>
            </defs>
        </svg>
        <ul class="items v-class-resp">
            <!-- <li class="nav-item"><a href="login.html" class="nav-link">LogIn</a></li> -->
            <?php
            if(!isset($_SESSION['uid']))
            {
              echo "<li class='nav-item nav-link'><a href='index.php'>Home</a></li>";
            }
            ?>
            <li class="nav-item"><a href="https://vtop.vit.ac.in/vtop/login">Vtop Login</a></li>
            <li class="nav-item"><a href="about.php">About Us</a></li>
            <li class="nav-item"><a href="services.php">Services</a></li>
            <li >
            <div class="navbar-nav ml-auto h-nav-resp v-class-resp">
          <?php
              if(!isset($_SESSION['uid']))  //from the 'login.php' page
              { 
                ?>
                <a class="nav-item reg-login" href="login.php">Login</a>
                <?php 
              } 
              else
              { 
                ?>
                <a class="nav-item reg-login" href="logout.php" class="register-text">Logout: <span class="sr-only class="register-text""><?php echo $_SESSION['username'];?></span></a>
                <?php
              }
              ?>
          </div> 
            </li>
        </ul>
          <div class="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
          </div>
                  
    </div> 
    </header>
