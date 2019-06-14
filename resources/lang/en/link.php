<?php

return [

    'form' => [
        'placeholder' => 'Link to shorten',
        'tooltip' => 'Press Enter to short the link',
        'created' => 'Shorten link!',
        'deletelink' => 'Delete link : :mgmtlink',
        'error' => 'The link shortening has failed.'
    ],

    'report' => [
        'title' => config('app.name') . ' - Report a link',
        'link' => [
            'placeholder' => 'Short link'
        ],
        'reason' => [
            'placeholder' => 'Reason'
        ],
        'tooltip' => 'Press Enter to send your report',
        'created' => 'Thanks for your report!',
        'error' => 'The report cannot be sent, maybe the link is broken?'
    ]

];
