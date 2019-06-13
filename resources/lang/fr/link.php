<?php

return [

    'form' => [
        'placeholder' => 'Lien à raccourcir',
        'tooltip' => 'Appuyez sur Entrée pour raccourcir le lien',
        'created' => 'Lien raccourci !',
        'deletelink' => 'Lien de suppression : :mgmtlink',
        'error' => 'La création du lien a échouée'
    ],

    'report' => [
        'title' => config('app.name') . ' - Signaler un lien',
        'link' => [
            'placeholder' => 'Lien à signaler'
        ],
        'reason' => [
            'placeholder' => 'Raison'
        ],
        'tooltip' => 'Appuyez sur Entrée pour envoyer votre signalement',
        'created' => 'Merci de votre signalement !',
        'error' => 'L\'envoi du signalement a échoué, peut-être que le lien n\'existe plus.'
    ]

];
