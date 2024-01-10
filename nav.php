<?php if (isset($_SESSION["login"])) { ?>
    <nav>
        <div class="bloc_nav_ordi">
            <div class="links">
                <a href="index.php">Accueil </a>

                <div class="dropdown">
                    <a class="drop-bt" href="">Études <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                            viewBox="0 0 9 6" fill="none">
                            <path d="M4.5 6L0.602887 0.749999L8.39711 0.75L4.5 6Z" fill="var(--blue)" />
                        </svg></a>
                    <div class="dropdown-content drop1">
                        <a href="edt.php">Agenda</a>
                        <a href="notes.php">Notes</a>
                        <a href="evals.php">Évaluations</a>
                        <a href="cours_todo_list.php">Cours</a>
                    </div>
                </div>

                <a href="mail.php">Mail</a>


                <div class="dropdown">
                    <a class="drop-bt" href="">Réservations <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                            viewBox="0 0 9 6" fill="none">
                            <path d="M4.5 6L0.602887 0.749999L8.39711 0.75L4.5 6Z" fill="var(--blue)" />
                        </svg></a>
                    <div class="dropdown-content drop2">
                        <a href="reservation_salle.php">Salles</a>
                        <a href="reservation_materiel.php">Matériel</a>
                    </div>
                </div>



                <div class="dropdown">
                    <a class="drop-bt" href="">Vie Universitaire <svg xmlns="http://www.w3.org/2000/svg" width="12"
                            height="10" viewBox="0 0 9 6" fill="none">
                            <path d="M4.5 6L0.602887 0.749999L8.39711 0.75L4.5 6Z" fill="var(--blue)" />
                        </svg></a>
                    <div class="dropdown-content drop3">
                        <a href="campus.php">Campus</a>
                        <a href="actualites.php">Actualité</a>
                        <a href="vie_etudiant.php">Vie étudiante</a>
                    </div>
                </div>


                <a href="application.php">Applis</a>
            </div>
            <div class="personne">
                <button id="theme">






                    <div class="drop-color">

                        <div><svg class="color-change-icone" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 400 400">
                                <g>
                                    <path id="path2"
                                        d="M42.770 20.379 C 34.220 22.395,26.397 28.909,22.402 37.343 L 19.922 42.578 19.712 141.602 L 19.502 240.625 130.064 240.625 L 240.625 240.625 240.625 130.078 L 240.625 19.531 143.164 19.610 C 89.561 19.653,44.383 19.999,42.770 20.379 M279.688 80.044 L 279.688 140.625 330.106 140.625 L 380.524 140.625 380.301 91.602 L 380.078 42.578 377.598 37.343 C 374.443 30.683,369.317 25.557,362.657 22.402 L 357.422 19.922 318.555 19.692 L 279.688 19.463 279.688 80.044 M279.688 280.078 L 279.688 380.469 315.977 380.469 C 363.661 380.469,369.331 378.997,376.628 364.723 C 380.539 357.073,380.450 359.359,380.459 266.602 L 380.469 179.688 330.078 179.688 L 279.688 179.688 279.688 280.078 M19.692 318.555 L 19.922 357.422 22.402 362.657 C 26.630 371.582,34.143 377.585,43.593 379.590 C 46.531 380.214,75.745 380.469,144.179 380.469 L 240.625 380.469 240.625 330.078 L 240.625 279.688 130.044 279.688 L 19.463 279.688 19.692 318.555 "
                                        stroke="none" fill="var(--violet)"></path>
                                </g>
                            </svg></div>
                        <div><svg class="color-change-icone" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 400 400">
                                <g>
                                    <path id="path3"
                                        d="M42.770 20.379 C 34.220 22.395,26.397 28.909,22.402 37.343 L 19.922 42.578 19.712 141.602 L 19.502 240.625 130.064 240.625 L 240.625 240.625 240.625 130.078 L 240.625 19.531 143.164 19.610 C 89.561 19.653,44.383 19.999,42.770 20.379 M279.688 80.044 L 279.688 140.625 330.106 140.625 L 380.524 140.625 380.301 91.602 L 380.078 42.578 377.598 37.343 C 374.443 30.683,369.317 25.557,362.657 22.402 L 357.422 19.922 318.555 19.692 L 279.688 19.463 279.688 80.044 M279.688 280.078 L 279.688 380.469 315.977 380.469 C 363.661 380.469,369.331 378.997,376.628 364.723 C 380.539 357.073,380.450 359.359,380.459 266.602 L 380.469 179.688 330.078 179.688 L 279.688 179.688 279.688 280.078 M19.692 318.555 L 19.922 357.422 22.402 362.657 C 26.630 371.582,34.143 377.585,43.593 379.590 C 46.531 380.214,75.745 380.469,144.179 380.469 L 240.625 380.469 240.625 330.078 L 240.625 279.688 130.044 279.688 L 19.463 279.688 19.692 318.555 "
                                        stroke="none" fill="var(--green)"></path>
                                </g>
                            </svg></div>
                        <div><svg class="color-change-icone" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 400 400">
                                <g>
                                    <path id="path4"
                                        d="M42.770 20.379 C 34.220 22.395,26.397 28.909,22.402 37.343 L 19.922 42.578 19.712 141.602 L 19.502 240.625 130.064 240.625 L 240.625 240.625 240.625 130.078 L 240.625 19.531 143.164 19.610 C 89.561 19.653,44.383 19.999,42.770 20.379 M279.688 80.044 L 279.688 140.625 330.106 140.625 L 380.524 140.625 380.301 91.602 L 380.078 42.578 377.598 37.343 C 374.443 30.683,369.317 25.557,362.657 22.402 L 357.422 19.922 318.555 19.692 L 279.688 19.463 279.688 80.044 M279.688 280.078 L 279.688 380.469 315.977 380.469 C 363.661 380.469,369.331 378.997,376.628 364.723 C 380.539 357.073,380.450 359.359,380.459 266.602 L 380.469 179.688 330.078 179.688 L 279.688 179.688 279.688 280.078 M19.692 318.555 L 19.922 357.422 22.402 362.657 C 26.630 371.582,34.143 377.585,43.593 379.590 C 46.531 380.214,75.745 380.469,144.179 380.469 L 240.625 380.469 240.625 330.078 L 240.625 279.688 130.044 279.688 L 19.463 279.688 19.692 318.555 "
                                        stroke="none" fill="var(--blue)"></path>
                                </g>
                            </svg></div>
                    </div>

                    <svg id="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                        height="100%" viewBox="0 0 400 400">
                        <g id="svgg">
                            <path id="path0"
                                d="M42.770 20.379 C 34.220 22.395,26.397 28.909,22.402 37.343 L 19.922 42.578 19.712 141.602 L 19.502 240.625 130.064 240.625 L 240.625 240.625 240.625 130.078 L 240.625 19.531 143.164 19.610 C 89.561 19.653,44.383 19.999,42.770 20.379 M279.688 80.044 L 279.688 140.625 330.106 140.625 L 380.524 140.625 380.301 91.602 L 380.078 42.578 377.598 37.343 C 374.443 30.683,369.317 25.557,362.657 22.402 L 357.422 19.922 318.555 19.692 L 279.688 19.463 279.688 80.044 M279.688 280.078 L 279.688 380.469 315.977 380.469 C 363.661 380.469,369.331 378.997,376.628 364.723 C 380.539 357.073,380.450 359.359,380.459 266.602 L 380.469 179.688 330.078 179.688 L 279.688 179.688 279.688 280.078 M19.692 318.555 L 19.922 357.422 22.402 362.657 C 26.630 371.582,34.143 377.585,43.593 379.590 C 46.531 380.214,75.745 380.469,144.179 380.469 L 240.625 380.469 240.625 330.078 L 240.625 279.688 130.044 279.688 L 19.463 279.688 19.692 318.555 "
                                stroke="none" fill="var(--yellow4)"></path>
                        </g>
                    </svg>
                </button>

                <?php

                include('connexion.php');
                $idUser = $_SESSION['id_user'];
                $requeteUser = "SELECT * FROM user WHERE id_user=:idUser";
                $stmtUser = $db->prepare($requeteUser);
                $stmtUser->bindParam(':idUser', $idUser, PDO::PARAM_INT);
                $stmtUser->execute();
                $resultsUser = $stmtUser->fetch(PDO::FETCH_ASSOC);

                ?>

                <button id="carte">Ta carte</button>






                <div class="student-card-wrapper" style="display: none;">

                    <div class="card">
                        <div class="deco-card">
                            <img src="./img/logo//logo-eiffel.png" alt="">
                            <p>carte étudiante</p>
                        </div>
                        <div class="info-card">
                            <img class="logo" src="./img/logo//logo-eiffel.png" alt="">
                            <p>Né(e) le :
                                <?= $resultsUser["user_naissance"] ?>
                            </p>
                            <p>N d'étudiant :
                                <?= $resultsUser["id_user"] ?>
                            </p>
                        </div>
                        <div class="photo-card">
                            <img src="./img/etudiants-card/<?= $resultsUser["user_photo"] ?>" alt="">
                            <p>
                                <?= ucwords($resultsUser["user_prenom"]) . " " . ucwords($resultsUser["user_nom"]) ?>
                            </p>
                        </div>
                    </div>

                    <div class="izly">
                        <img src="./img/izly/111111.jpg" alt="">
                    </div>

                </div>



                <button id="profile">
                    <svg id="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"
                        height="100%" viewBox="0 0 400 400">
                        <g>
                            <path id="path1"
                                d="M183.594 0.532 C 153.000 5.528,129.203 21.443,113.448 47.444 C 109.092 54.632,105.142 64.590,102.982 73.828 C 88.688 134.961,134.683 192.989,197.415 192.966 C 263.850 192.941,310.032 127.601,288.522 64.063 C 274.278 21.986,227.108 -6.574,183.594 0.532 M110.156 193.467 C 66.268 199.875,41.332 234.870,33.969 300.391 C 28.693 347.338,38.042 375.673,63.672 390.416 C 81.160 400.475,75.231 400.074,202.776 399.812 L 312.109 399.586 318.750 397.543 C 359.941 384.868,373.483 352.673,364.052 289.844 C 354.871 228.679,327.455 195.609,283.951 193.225 C 273.339 192.644,273.232 192.685,255.007 204.355 C 215.213 229.836,183.289 229.787,144.051 204.184 C 126.809 192.934,122.701 191.635,110.156 193.467 "
                                stroke="none" fill="var(--yellow4)" fill-rule="evenodd"></path>
                        </g>
                    </svg>
                </button>

                <?php
                $stmt = $db->query("SELECT * FROM user WHERE user_login = '" . $_SESSION['login'] . "'");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['id_user'] = $result['id_user'];

                //Récupérer les absences de l'utilisateur
                $id_user = $_SESSION['id_user'];

                $stmt2 = $db->query("SELECT * FROM absence WHERE ext_etudiant = '" . $id_user . "'");
                $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                $abs_justif = 0;
                $abs_non_justif = 0;
                foreach ($result2 as $row) {
                    //Si le champ "jusitifcation" n'est pas vide (que l'absence est justifiée)
                    if (isset($row['abs_justificatif'])) {
                        //Additionner toutes les absences
                        if (is_numeric($row['abs_duree'])) {
                            $abs_justif += $row['abs_duree'];
                        }
                    }
                    //Si le champ "jusitifcation" vaut "NULL" (que l'absence est NON justifiée)
                    else {
                        if (is_numeric($row['abs_duree'])) {
                            $abs_non_justif += $row['abs_duree'];
                        }
                    }
                }


                ?>

                <div class="profile-block-wrapper" style="display: none;">

                    <div class="img-profile">
                        <img src="./img/etudiants-card/<?= $resultsUser["user_photo"] ?>" alt="">
                    </div>

                    <div class="nav-profile">
                        <p class="name-profile">
                            <?= ucwords($resultsUser["user_prenom"]) . " " . ucwords($resultsUser["user_nom"]) ?>
                        </p>
                        <a class="document" href="retard.php"><img src="./img/nav/file-text.svg" alt="">Mes documents</a>
                        <a href="retard.php"><img src="./img/nav/clock.svg" alt=""> Retards :
                            <?php if ($result["user_retard"] !== NULL) {
                                echo $result['user_retard'];

                            } else {
                                echo 0;
                            } ?>
                            minutes
                        </a>
                        <a href="retard.php"><img src="./img/nav/user.svg" alt="">
                            Absences :
                            <?= $abs_non_justif ?> heures
                        </a>
                        <a href="notes.php"><img src="./img/nav/note.svg" alt="">Notes semestriel</a>
                        <form action="deconnexion.php"><button id="disconnect">Se déconnecter</button></form>
                    </div>
                </div>


            </div>


        </div>

        <!-- mobile -->

        <div class="bloc_nav_mobile">

            <div class="menu_personnage">
                <div><img class="menu" src="./img/nav/menu.png" alt="menu"></div>
                <div class="personne">
                    <button id="theme">

                        <div class="drop-color">

                            <div><svg class="color-change-icone" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%"
                                    viewBox="0 0 400 400">
                                    <g>
                                        <path id="path2"
                                            d="M42.770 20.379 C 34.220 22.395,26.397 28.909,22.402 37.343 L 19.922 42.578 19.712 141.602 L 19.502 240.625 130.064 240.625 L 240.625 240.625 240.625 130.078 L 240.625 19.531 143.164 19.610 C 89.561 19.653,44.383 19.999,42.770 20.379 M279.688 80.044 L 279.688 140.625 330.106 140.625 L 380.524 140.625 380.301 91.602 L 380.078 42.578 377.598 37.343 C 374.443 30.683,369.317 25.557,362.657 22.402 L 357.422 19.922 318.555 19.692 L 279.688 19.463 279.688 80.044 M279.688 280.078 L 279.688 380.469 315.977 380.469 C 363.661 380.469,369.331 378.997,376.628 364.723 C 380.539 357.073,380.450 359.359,380.459 266.602 L 380.469 179.688 330.078 179.688 L 279.688 179.688 279.688 280.078 M19.692 318.555 L 19.922 357.422 22.402 362.657 C 26.630 371.582,34.143 377.585,43.593 379.590 C 46.531 380.214,75.745 380.469,144.179 380.469 L 240.625 380.469 240.625 330.078 L 240.625 279.688 130.044 279.688 L 19.463 279.688 19.692 318.555 "
                                            stroke="none" fill="var(--violet)"></path>
                                    </g>
                                </svg></div>
                            <div><svg class="color-change-icone" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%"
                                    viewBox="0 0 400 400">
                                    <g>
                                        <path id="path3"
                                            d="M42.770 20.379 C 34.220 22.395,26.397 28.909,22.402 37.343 L 19.922 42.578 19.712 141.602 L 19.502 240.625 130.064 240.625 L 240.625 240.625 240.625 130.078 L 240.625 19.531 143.164 19.610 C 89.561 19.653,44.383 19.999,42.770 20.379 M279.688 80.044 L 279.688 140.625 330.106 140.625 L 380.524 140.625 380.301 91.602 L 380.078 42.578 377.598 37.343 C 374.443 30.683,369.317 25.557,362.657 22.402 L 357.422 19.922 318.555 19.692 L 279.688 19.463 279.688 80.044 M279.688 280.078 L 279.688 380.469 315.977 380.469 C 363.661 380.469,369.331 378.997,376.628 364.723 C 380.539 357.073,380.450 359.359,380.459 266.602 L 380.469 179.688 330.078 179.688 L 279.688 179.688 279.688 280.078 M19.692 318.555 L 19.922 357.422 22.402 362.657 C 26.630 371.582,34.143 377.585,43.593 379.590 C 46.531 380.214,75.745 380.469,144.179 380.469 L 240.625 380.469 240.625 330.078 L 240.625 279.688 130.044 279.688 L 19.463 279.688 19.692 318.555 "
                                            stroke="none" fill="var(--green)"></path>
                                    </g>
                                </svg></div>
                            <div><svg class="color-change-icone" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%"
                                    viewBox="0 0 400 400">
                                    <g>
                                        <path id="path4"
                                            d="M42.770 20.379 C 34.220 22.395,26.397 28.909,22.402 37.343 L 19.922 42.578 19.712 141.602 L 19.502 240.625 130.064 240.625 L 240.625 240.625 240.625 130.078 L 240.625 19.531 143.164 19.610 C 89.561 19.653,44.383 19.999,42.770 20.379 M279.688 80.044 L 279.688 140.625 330.106 140.625 L 380.524 140.625 380.301 91.602 L 380.078 42.578 377.598 37.343 C 374.443 30.683,369.317 25.557,362.657 22.402 L 357.422 19.922 318.555 19.692 L 279.688 19.463 279.688 80.044 M279.688 280.078 L 279.688 380.469 315.977 380.469 C 363.661 380.469,369.331 378.997,376.628 364.723 C 380.539 357.073,380.450 359.359,380.459 266.602 L 380.469 179.688 330.078 179.688 L 279.688 179.688 279.688 280.078 M19.692 318.555 L 19.922 357.422 22.402 362.657 C 26.630 371.582,34.143 377.585,43.593 379.590 C 46.531 380.214,75.745 380.469,144.179 380.469 L 240.625 380.469 240.625 330.078 L 240.625 279.688 130.044 279.688 L 19.463 279.688 19.692 318.555 "
                                            stroke="none" fill="var(--blue)"></path>
                                    </g>
                                </svg></div>
                        </div>

                        <svg id="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="100%" height="100%" viewBox="0 0 400 400">
                            <g id="svgg">
                                <path id="path0"
                                    d="M42.770 20.379 C 34.220 22.395,26.397 28.909,22.402 37.343 L 19.922 42.578 19.712 141.602 L 19.502 240.625 130.064 240.625 L 240.625 240.625 240.625 130.078 L 240.625 19.531 143.164 19.610 C 89.561 19.653,44.383 19.999,42.770 20.379 M279.688 80.044 L 279.688 140.625 330.106 140.625 L 380.524 140.625 380.301 91.602 L 380.078 42.578 377.598 37.343 C 374.443 30.683,369.317 25.557,362.657 22.402 L 357.422 19.922 318.555 19.692 L 279.688 19.463 279.688 80.044 M279.688 280.078 L 279.688 380.469 315.977 380.469 C 363.661 380.469,369.331 378.997,376.628 364.723 C 380.539 357.073,380.450 359.359,380.459 266.602 L 380.469 179.688 330.078 179.688 L 279.688 179.688 279.688 280.078 M19.692 318.555 L 19.922 357.422 22.402 362.657 C 26.630 371.582,34.143 377.585,43.593 379.590 C 46.531 380.214,75.745 380.469,144.179 380.469 L 240.625 380.469 240.625 330.078 L 240.625 279.688 130.044 279.688 L 19.463 279.688 19.692 318.555 "
                                    stroke="none" fill="var(--yellow4)"></path>
                            </g>
                        </svg>
                    </button>



                    <button id="carte">Ta carte</button>






                    <div class="student-card-wrapper" style="display: none;">

                        <div class="card">
                            <div class="deco-card">
                                <img src="./img/logo//logo-eiffel.png" alt="">
                                <p>carte étudiante</p>
                            </div>
                            <div class="info-card">
                                <img class="logo" src="./img/logo//logo-eiffel.png" alt="">
                                <p>Né(e) le : 01/01/2022</p>
                                <p>N d'étudiant</p>
                            </div>
                            <div class="photo-card">
                                <img class="photo-student" src="./img/etudiants-card/111111.jpg" alt="">
                                <p>Thomas DUPONT</p>
                            </div>
                        </div>

                        <div class="izly">
                            <img src="./img/izly/111111.jpg" alt="">
                        </div>

                    </div>



                    <button id="profile">
                        <svg id="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="100%" height="100%" viewBox="0 0 400 400">
                            <g>
                                <path id="path1"
                                    d="M183.594 0.532 C 153.000 5.528,129.203 21.443,113.448 47.444 C 109.092 54.632,105.142 64.590,102.982 73.828 C 88.688 134.961,134.683 192.989,197.415 192.966 C 263.850 192.941,310.032 127.601,288.522 64.063 C 274.278 21.986,227.108 -6.574,183.594 0.532 M110.156 193.467 C 66.268 199.875,41.332 234.870,33.969 300.391 C 28.693 347.338,38.042 375.673,63.672 390.416 C 81.160 400.475,75.231 400.074,202.776 399.812 L 312.109 399.586 318.750 397.543 C 359.941 384.868,373.483 352.673,364.052 289.844 C 354.871 228.679,327.455 195.609,283.951 193.225 C 273.339 192.644,273.232 192.685,255.007 204.355 C 215.213 229.836,183.289 229.787,144.051 204.184 C 126.809 192.934,122.701 191.635,110.156 193.467 "
                                    stroke="none" fill="var(--yellow4)" fill-rule="evenodd"></path>
                            </g>
                        </svg>
                    </button>



                    <div class="profile-block-wrapper" style="display: none;">

                        <div class="img-profile">
                            <img src="./img/etudiants-card/111111.jpg" alt="">
                        </div>

                        <div class="nav-profile">
                            <p class="name-profile">Name SURNAME</p>
                            <a href="#">Mes documents</a>
                            <a href="">Retards 0 h </a>
                            <a href="">Absents 13 h</a>
                            <a href="#">Notes semestriel</a>
                            <button id="disconnect">Se déconnecter</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ici -->
            <div class="links" id="contactBloc">
                <div class="mobile_centrer_lien">
                    <a href="index.php">Accueil </a>

                    <div class="dropdown">
                        <a class="drop-bt" href="">Études <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                                viewBox="0 0 9 6" fill="none">
                                <path d="M4.5 6L0.602887 0.749999L8.39711 0.75L4.5 6Z" fill="var(--blue)" />
                            </svg></a>
                        <div class="dropdown-content drop1">
                            <a href="edt.php">Agenda</a>
                            <a href="notes.php">Notes</a>
                            <a href="evals.php">Évaluations</a>
                            <a href="cours_todo_list.php">Cours</a>
                        </div>
                    </div>

                    <a href="mail.php">Mail</a>


                    <div class="dropdown">
                        <a class="drop-bt" href="">Réservations <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                height="10" viewBox="0 0 9 6" fill="none">
                                <path d="M4.5 6L0.602887 0.749999L8.39711 0.75L4.5 6Z" fill="var(--blue)" />
                            </svg></a>
                        <div class="dropdown-content drop2">
                            <a href="#reservation_salle.php">Salles</a>
                            <a href="reservation_materiel.php">Matériel</a>
                        </div>
                    </div>



                    <div class="dropdown">
                        <a class="drop-bt" href="">Vie Universitaire <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                height="10" viewBox="0 0 9 6" fill="none">
                                <path d="M4.5 6L0.602887 0.749999L8.39711 0.75L4.5 6Z" fill="var(--blue)" />
                            </svg></a>
                        <div class="dropdown-content drop3">
                            <a href="campus.php">Campus</a>
                            <a href="actualites.php">Actualité</a>
                            <a href="vie_etudiant.php">Vie étudiante</a>

                        </div>
                    </div>


                    <a href="application.php">Applis</a>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var contactImage = document.querySelector('.menu');
                    var contactBloc = document.getElementById('contactBloc');

                    var isOpen = false; // Ajout d'une variable pour suivre l'état du pop-up

                    contactImage.addEventListener('click', function () {
                        if (isOpen) {
                            contactBloc.style.display = 'none';
                        } else {
                            contactBloc.style.display = 'block';
                        }

                        isOpen = !isOpen;
                    });
                });
            </script>

    </nav>
<?php }else{
    header("Location: login.php?errConnexion");
} ?>

<script>


    document.addEventListener("DOMContentLoaded", function () {
        var blockColors = document.querySelector(".drop-color");
        var themeButton = document.getElementById("theme");

        themeButton.addEventListener("click", function () {
            if (blockColors.style.display === "block") {
                blockColors.style.display = "none";
            } else {
                blockColors.style.display = "block";
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        var cardButton = document.querySelector('#carte');
        var card = document.querySelector('.student-card-wrapper');

        function openCard() {
            if (card.style.display === 'none') {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        }

        cardButton.addEventListener('click', openCard);





        // profile pop-up

        var profile = document.querySelector('.profile-block-wrapper');
        var profileButton = document.querySelector('#profile');

        function openProfile() {
            if (profile.style.display === 'none') {
                profile.style.display = 'block';
            } else {
                profile.style.display = 'none';
            }
        }

        profileButton.addEventListener('click', openProfile);

    });
</script>