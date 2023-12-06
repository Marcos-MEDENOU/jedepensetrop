<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
</head>

<body>
    <h2 class="text-gray-700 dark:text-gray-200">Bonjour {{ $data['name'][0] }},</h2>

    <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
        Vous recevez ce courriel car une demande de réinitialisation de mot de passe a été effectuée pour votre compte
        sur JePenseTrop.fr.
    </p>
    <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
        Si vous n'avez pas initié cette demande, veuillez ignorer ce message. Si vous avez fait cette demande
        intentionnellement, veuillez suivre les étapes ci-dessous pour réinitialiser votre mot de passe :
    <ol>
        <li>
            Cliquez sur le lien de réinitialisation ci-dessous (le lien expirera dans quelques minutes) :
            <a href="{{ route('password.reset', $data['token']) }}">réinitialisation du mot de passe</a>
        </li>
        <li>
            Suivez les instructions pour choisir un nouveau mot de passe sécurisé

        </li>
    </ol>
    </p>
    <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
        N'oubliez pas que votre mot de passe doit contenir au moins huit caractères, avec une combinaison de lettres
        majuscules et minuscules, de chiffres et de caractères spéciaux.
    </p>
    <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
        Si vous rencontrez des difficultés ou si vous n'avez pas demandé cette réinitialisation de mot de passe,
        veuillez contacter notre équipe de support à [adresse e-mail du support] pour obtenir de l'aide.
    </p>
    <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
        Merci de faire partie de la communauté JePenseTrop.fr.
    </p>
    <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
        Cordialement, <br>
        L'équipe JePenseTrop.fr
    </p>
</body>

</html>
