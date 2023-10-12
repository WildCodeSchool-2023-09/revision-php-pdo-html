<?php
require '../config/db.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Frais Daniel</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/css/uikit.min.css" />
</head>

<body>
    <?php
    if ($_POST) {
        $errors = [];
        if ($_POST['name'] === '') {
            $errors['name'] = 'Saisis ton nom man !!';
        }

        if (intval($_POST['amount']) === 0) {
            $errors['amount'] = 'Il faut un montant supérieur à 0 !!';
        }

        if (!$errors) {
            $pdo->exec('INSERT INTO notedefrais (name,amount) 
            VALUES ("' . $_POST['name'] . '","' . $_POST['amount'] . '")');
            echo '<div  class="uk-alert-success" uk-alert>
            <a href class="uk-alert-close" uk-close></a>
            Bravo !!!
            </div>';
        }
    }
    ?>

    <?php
    $requete = "SELECT * FROM notedefrais";
    $notedefrais = $pdo->query($requete)->fetchAll();

    ?>
    <div class="uk-container">
        <h1>App a DANI</h1>
        <div class="uk-flex" uk-grid>
            <div>
                <form method="POST">
                    <p class="uk-margin">
                        <input type="text" name="name" class="uk-input" />
                        <?php
                        if (isset($errors) && isset($errors['name']) && $errors['name'] !== '') {
                            echo '<p class="uk-text-danger">' . $errors['name'] . '</p>';
                        }
                        ?>
                    </p>
                    <p class="uk-margin">
                        <input type="number" name="amount" class="uk-input" />
                        <?php
                        if (isset($errors) && isset($errors['amount']) && $errors['amount'] !== '') {
                            echo '<p class="uk-text-danger">' . $errors['amount'] . '</p>';
                        }
                        ?>
                    </p>

                    <p class="uk-margin">
                        <button class="uk-button uk-button-primary">Ajouter la note de frais</button>
                    </p>
                </form>

                <ul>
                    <?php
                    foreach ($notedefrais as $note) {
                    ?>
                        <li>Merci <b><?php echo $note['name']; ?></b> à payé</li>
                    <?php
                    }
                    ?>

                    <?php
                    foreach ($notedefrais as $note) :
                    ?>
                        <li>Merci <b><?php echo $note['name']; ?></b> à payé</li>
                    <?php
                    endforeach;
                    ?>
                </ul>
                <?php
                foreach ($notedefrais as $note) :
                ?>

                    <div class="uk-card uk-card-default uk-width-1-2@m">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <div class="uk-width-auto">
                                    <img class="uk-border-circle" width="40" height="40" src="https://cdn.unitycms.io/images/DO94C2Rdajy8SqWyQ_5vY3.jpg" alt="Avatar">
                                </div>
                                <div class="uk-width-expand">
                                    <h3 class="uk-card-title uk-margin-remove-bottom"><?php echo $note['name']; ?></h3>
                                    <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">April 01, 2016</time></p>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p>Merci <b><?php echo $note['name']; ?></b> d'avoir payé <b><?php echo $note['amount']; ?> €</b></p>
                        </div>
                        <div class="uk-card-footer">
                            test
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-padding">
                    <table class="uk-table uk-table-hover uk-table-divider">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($notedefrais as $note) {
                            ?>
                                <tr>
                                    <td><?= $note['id']; ?></td>
                                    <td><?= $note['name']; ?></td>
                                    <td><?= $note['amount']; ?></td>
                                </tr>
                            <?php
                                $total = @$total + $note['amount'];
                            }

                            ?>

                            <tr>
                                <td class="uk-text-right" colspan="3"><?= $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.1/dist/js/uikit-icons.min.js"></script>

</body>

</html>